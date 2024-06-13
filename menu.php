<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .btn-menu::before {
            content: '\2630';
        }

        .btn-menu {
            display: none;
        }
        .navigation-card {
            width: fit-content;
            height: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            background-color: rgb(255, 255, 255);
            padding: 10px 15px;
            border-radius: 50px;
        }
        .tab {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            overflow: hidden;
            background-color: rgb(252, 252, 252);
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        .tab:hover {
            background-color: rgb(223, 223, 223);
        }
        body.menu-active .container-menu {
            display: block;
        }
        body.menu-active .btn-menu::before {
            content: '\2715';
        }

        .container-menu {
            position: sticky;
            top: 0;
            background: white;
            z-index: 1000;
            display: flex;
            justify-content: space-around;
        }

        .container_wrapper {
            background: white;
            z-index: 1000;
        }

        .menu {
            display: flex;
            justify-content: space-around;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navigation-card {
            display: none;
        }

        @media screen and (max-width: 1040px) {
            .container-menu {
                display: none;
            }
            .btn-menu {
                display: inline;
                position: sticky;
                top: 20px;
                right: 50px;
                cursor: pointer;
                font-size: 30px;
                z-index: 1001;
                margin-left: 90vw;
            }
            .container-menu .menu_link {
                font-size: 18px;
                padding: 15px;
            }
            .container-menu .menu {
                display: inline;
            }
            .container_wrapper {
                display: inline;
            }
            .navigation-card {
                display: flex;
                position: fixed;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                width: fit-content;
                height: fit-content;
                align-items: center;
                justify-content: center;
                gap: 30px;
                background-color: rgb(255, 255, 255);
                padding: 10px 15px;
                border-radius: 50px;
                z-index: 1002;
            }
            .menu_child-list {
                display: none;
            }
            .menu_item i {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="btn-menu"></div>
    <section class="container-menu">
        <div class="container_wrapper">
            <ul class="menu">
                <li class="menu_item"><a href="./index.php" class="menu_link">HOME</a></li>
                <li class="menu_item"><a href="./all-product.php" class="menu_link">All PRODUCT</a></li>
                <li class="menu_item"><a href="./Lazy.php" class="menu_link">LAZY THINK COLLECTION</a></li>
                <li class="menu_item"><a href="" class="menu_link">LEVENTS®</a></li>
                <li class="menu_item">
                    <a href="" class="menu_link">SHOP</a><i class='bx bxs-down-arrow'></i>
                    <div class="menu_child">
                        <ul class="menu_child-list">
                            <li><a href=""><button class="cssbuttons-io"><span>BEST SELLER</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>ALL ITEM</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>T-SHIRT</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>SHIRT</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>OUTERWEAR</span></button></a></li>
                        </ul>
                    </div>
                </li>
                <li class="menu_item">
                    <a href="" class="menu_link">COLLECTION</a><i class='bx bxs-down-arrow'></i>
                    <div class="menu_child">
                        <ul class="menu_child-list">
                            <li><a href=""><button class="cssbuttons-io"><span>FREEFALL</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>REMAKE</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>BASIC</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>LUCKY</span></button></a></li>
                            <li><a href=""><button class="cssbuttons-io"><span>STEPOUT</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="menu_item" style="font-size: 25px;" id="cart_icon"><i class='bx bx-cart-alt'></i></li>
            </ul>
        </div>
    </section>
    <div class="navigation-card">
        <a href="./index.php" class="tab">
            <svg class="svgIcon" viewBox="0 0 104 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100.5 40.75V96.5H66V68.5V65H62.5H43H39.5V68.5V96.5H3.5V40.75L52 4.375L100.5 40.75Z" stroke="black" stroke-width="7"></path>
            </svg>
        </a>
        <a href="./login.php" class="tab">
            <svg width="104" height="100" viewBox="0 0 104 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="21.5" y="3.5" width="60" height="60" rx="30" stroke="black" stroke-width="7"></rect>
                <g clip-path="url(#clip0_41_27)">
                    <mask id="mask0_41_27" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="61" width="104" height="52">
                        <path d="M0 113C0 84.2812 23.4071 61 52.1259 61C80.706 61 104 84.4199 104 113H0Z" fill="white"></path>
                    </mask>
                    <g mask="url(#mask0_41_27)">
                        <path d="M-7 113C-7 80.4152 19.4152 54 52 54H52.2512C84.6973 54 111 80.3027 111 112.749H97C97 88.0347 76.9653 68 52.2512 68H52C27.1472 68 7 88.1472 7 113H-7ZM-7 113C-7 80.4152 19.4152 54 52 54V68C27.1472 68 7 88.1472 7 113H-7ZM52.2512 54C84.6973 54 111 80.3027 111 112.749V113H97V112.749C97 88.0347 76.9653 68 52.2512 68V54Z" fill="black"></path>
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_41_27">
                        <rect width="104" height="39" fill="white" transform="translate(0 61)"></rect>
                    </clipPath>
                </defs>
            </svg>
        </a>
        <a href="./cart.php" class="tab">
            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 902.86 902.86" xml:space="preserve">
                <g>
                    <g>
                        <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
                        <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742S619.162,694.432,619.162,716.897z"/>
                    </g>
                </g>
            </svg>
            <circle cx="46.1726" cy="46.1727" r="29.5497" transform="rotate(36.0692 46.1726 46.1727)" stroke="black" stroke-width="7"></circle>
            <line x1="61.7089" y1="67.7837" x2="97.7088" y2="111.784" stroke="black" stroke-width="7"></line>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menuBtn = document.querySelector('.btn-menu');
            var body = document.querySelector('body');

            menuBtn.addEventListener('click', function() {
                body.classList.toggle('menu-active');
            });
        });

        document.getElementById('cart_icon').addEventListener('click', function() {
            window.location.href = 'cart.php';
        });

        function openModal() {
            document.getElementById("productModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("productModal").style.display = "none";
        }

        function searchProducts() {
            var keyword = document.getElementById("searchKeyword").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("searchResults").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "search.php?keyword=" + keyword, true);
            xhttp.send();
        }
    </script>
</body>
</html>
