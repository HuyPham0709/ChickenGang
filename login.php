<?php
require_once "db.php";
session_start();

$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn == false) {
    die("Connection error: " . mysqli_connect_error());
}

$login_error = '';
$registration_errors = array(
    'username' => '',
    'password' => '',
    'repeat_password' => '',
    'general' => ''
);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $role = $row["role"];
            $login_id = $row["id_Login"];
        
            $customer_query = "SELECT id_User FROM customer WHERE login_id = ?";
            $stmt = mysqli_prepare($conn, $customer_query);
            mysqli_stmt_bind_param($stmt, "i", $login_id);
            mysqli_stmt_execute($stmt);
            $customer_result = mysqli_stmt_get_result($stmt);
        
            if(mysqli_num_rows($customer_result) > 0) {
                $customer_row = mysqli_fetch_array($customer_result);
                $user_id = $customer_row["id_User"];
        
                if($role == "user") {
                    $_SESSION["role"] = "user";
                    $_SESSION["username"] = $username;
                    $_SESSION["user_id"] = $user_id;
                    header("location: index.php");
                    exit();
                } elseif($role == "admin") {
                    $_SESSION["role"] = "admin";
                    $_SESSION["username"] = $username;
                    header("location: adminhome.php");
                    exit();
                } else {
                    $login_error = "Username or password incorrect";
                }
            } else {
                $login_error = "User not found";
            }
        } else {
            $login_error = "Username or password incorrect";
        }
    } elseif(isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $errors = array();

        if (empty($username)) {
            $registration_errors['username'] = "Username is required.";
        }

        if (empty($password)) {
            $registration_errors['password'] = "Password is required.";
        }

        if ($password !== $passwordRepeat) {
            $registration_errors['repeat_password'] = "Password incorrect.";
        }

        $sql = "SELECT username FROM login WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $registration_errors['username'] = "Username already exists.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $registration_errors['general'] = "Error: Could not prepare SQL statement.";
        }

        if(empty(array_filter($registration_errors))) {
            $sql_login = "INSERT INTO login (username, password) VALUES (?, ?)";
            $stmt_login = mysqli_prepare($conn, $sql_login);
            mysqli_stmt_bind_param($stmt_login, "ss", $username, $password);
            mysqli_stmt_execute($stmt_login);
            
            $login_id = mysqli_insert_id($conn);

            $sql_customer = "INSERT INTO customer (username, password, login_id) VALUES (?, ?, ?)";
            $stmt_customer = mysqli_prepare($conn, $sql_customer);
            mysqli_stmt_bind_param($stmt_customer, "ssi", $username, $password, $login_id);
            mysqli_stmt_execute($stmt_customer);
            
            $success_message = "<div class='alert alert-success'>You have successfully registered.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
    <style>
        .input-field-login {
            position: relative;
            margin-bottom: 20px;
        }
        .error-message {
            position: absolute;
            top: 140%;
            left: 5%;
            transform: translateY(-50%);
            color: red;
            font-size: 0.9em;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container-login">
        <div class="forms-container-login">
            <div class="signin-signup-login">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="sign-in-form-login" method="POST">
                    <h2 class="title-login">Sign in</h2>
                    <div class="input-field-login">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                        <?php if($login_error): ?>
                            <div class='error-message'><?php echo $login_error; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="input-field-login">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn-login solid-login" />
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="sign-up-form-login" method="POST">
                    <h2 class="title-login">Sign up</h2>
                    <div class="input-field-login">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required/>
                        <?php if($registration_errors['username']): ?>
                            <div class='error-message'><?php echo $registration_errors['username']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="input-field-login">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required/>
                        <?php if($registration_errors['password']): ?>
                            <div class='error-message'><?php echo $registration_errors['password']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="input-field-login">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="repeat_password" placeholder="Confirm Password" required>        
                        <?php if($registration_errors['repeat_password']): ?>
                            <div class='error-message'><?php echo $registration_errors['repeat_password']; ?></div>
                        <?php endif; ?>
                    </div>
                    <?php if($registration_errors['general']): ?>
                        <div class='error-message'><?php echo $registration_errors['general']; ?></div>
                    <?php endif; ?>
                    <input type="submit" class="btn-login" value="Sign up" name="submit"/>
                    <!-- Hiển thị thông báo thành công nếu tồn tại -->
                    <?php echo isset($success_message) ? $success_message : ''; ?>
                </form>
            </div>
        </div>

        <div class="panels-container-login">
            <div class="panel-login left-panel-login">
                <div class="content-login">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn-login transparent-login" id="sign-up-btn-login">Sign up</button>
                </div>
                <img src="img/log.svg" class="image-login" alt="" />
            </div>
            <div class="panel-login right-panel-login">
                <div class="content-login">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn-login transparent-login" id="sign-in-btn-login">Sign in</button>
                </div>
                <img src="img/register.svg" class="image-login" alt="" />
            </div>
        </div>
    </div>

    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn-login");
        const sign_up_btn = document.querySelector("#sign-up-btn-login");
        const container = document.querySelector(".container-login");

        sign_up_btn.addEventListener("click", () => {
          container.classList.add("sign-up-mode-login");
        });

        sign_in_btn.addEventListener("click", () => {
          container.classList.remove("sign-up-mode-login");
        });
    </script>
</body>
</html>
