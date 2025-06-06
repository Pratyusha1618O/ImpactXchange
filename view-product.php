<?php
session_start();
include("./server/config.php");

if (isset($_SESSION['email'])) {
    include("user_logged_in_nav.php");
    $email = $_SESSION['email'];

    if (isset($_POST['add_to_cart'])) {
        if (isset($email)) {
            $product_id = $_POST['product_id'];

            $uid = "SELECT user_id FROM user where user_email = '$email' ";
            $query = mysqli_query($dbcon, $uid);
            $row = mysqli_fetch_array($query);
            $user_id = $row['user_id'];

            $cartSQL = "INSERT INTO cart (user_id, product_id) VALUES('$user_id', '$product_id')";
            $cart = mysqli_query($dbcon, $cartSQL);

            // header("Location: userDashboard-saved-items.php");
            // exit();
        } else {
            echo "<script>
        alert('User not found. Please register first.');
        window.location.href = 'user-registration.php';
    </script>";
            exit();
        }


    }
} else if (isset($_SESSION["ngo-email"])) {
    include("ngo_loggedin_nav.php");
    $email = $_SESSION['ngo-email'];

    if (isset($_POST['add_to_cart'])) {
        if (isset($email)) {
            $product_id = $_POST['product_id'];

            $uid = "SELECT ngo_id FROM ngo where ngo_email = '$email' ";
            $query = mysqli_query($dbcon, $uid);
            $row = mysqli_fetch_array($query);
            $ngo_id = $row['ngo_id'];

            $cartSQL = "INSERT INTO ngo_cart (ngo_id, product_id) VALUES('$ngo_id', '$product_id')";
            $cart = mysqli_query($dbcon, $cartSQL);

            // header("Location: ngo-cart.php");
            // exit();
        } else {
            echo "<script>
        alert('ngo not found. Please register first.');
        window.location.href = 'user-registration.php';
    </script>";
            exit();
        }


    }
} else if (isset($_SESSION["admin-email"])) {
    include("admin_loggedin_nav.php");
    $email = $_SESSION['admin-email'];
} else {
    include("header.php");
}

$sql = "SELECT * FROM product WHERE admin_status = 'approved'";
$result = mysqli_query($dbcon, $sql);

// if (isset($_POST['add_to_cart'])) {
//     if (isset($email)) {
//         $product_id = $_POST['product_id'];

//         $uid = "SELECT user_id FROM user where user_email = '$email' ";
//         $query = mysqli_query($dbcon, $uid);
//         $row = mysqli_fetch_array($query);
//         $user_id = $row['user_id'];

//         $cartSQL = "INSERT INTO cart (user_id, product_id) VALUES('$user_id', '$product_id')";
//         $cart = mysqli_query($dbcon, $cartSQL);

//         header("Location: userDashboard-saved-items.php");
//         exit();
//     }
//     else {
//     echo "<script>
//         alert('User not found. Please register first.');
//         window.location.href = 'user-registration.php';
//     </script>";
//     exit();
//     }


// }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/63ce28b4a6.js" crossorigin="anonymous"></script>
    <title>ImpactXchange</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin-top: 4rem;
            padding: 0;
            box-sizing: border-box;
        }

        h1,
        h2,
        h3,
        h4 {
            margin: 0;
        }

        p {
            margin: 0;
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f97316;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 36px;
        }

        .hero-section p {
            margin-top: 10px;
            font-size: 18px;
        }

        /* Filter Section */
        .filter-section {
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .filter-section select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Category Section */
        .category-section {
            padding: 20px;
            text-align: center;
        }

        .category-section h2 {
            margin-bottom: 20px;
        }

        .categories {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .category {
            width: 150px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .category i {
            font-size: 36px;
            color: #f97316;
        }

        .category p {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        /* Image Slider */
        .slider {
            position: relative;
            margin: 20px auto;
            width: 90%;
            max-width: 900px;
            /* height: 60%; */
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slides img {
            width: 100%;
            flex-shrink: 0;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Product Section */
        .product-section {
            padding: 20px;
            text-align: center;
        }

        .product-section h2 {
            margin-bottom: 20px;
        }

        .product-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
            background-color: #f9f8f8;
            padding: 1rem 0;
            border-radius: 10px;
        }

        .product-card {
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 55vh;

        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .product-card h3 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .product-card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .details {
            height: 45vh;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f9f9f9;
            margin-top: 5px;
        }

        .product-actions button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .add-to-cart {
            background-color: #f97316;
            color: white;
        }

        .add-to-cart:hover {
            background-color: #ff2d6c;
        }

        .view-details {
            background-color: #ddd;
            color: #333;
            border-radius: 5px;
            padding: 7px 12px;
        }

        .view-details:hover {
            background-color: #bbb;
        }

        .section5 {
            background-color: var(--second-bg-color);
        }

        /* heading */
        .section5 h1 {
            text-align: center;
            font-size: 2rem;
            padding-top: 5rem;
        }

        /* category container */
        .section5-categories {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            padding: 3rem;
        }

        /* category boxes */
        .categories-box {
            text-align: center;
            background-color: var(--bg-color);
            box-shadow: 1px 2px 3px var(--shadow);
            height: 18vh;
            width: 14vw;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 1.5rem;
            border-radius: 10px;
            transition: 0.1s ease;
        }

        .categories-box:hover {
            box-shadow: 2px 3px 5px var(--hover-shadow);
        }

        /* donation count */
        .donation-count {
            text-align: center;
            color: var(--violet);
            font-weight: 500;
            font-size: 20px;
            padding-bottom: 3rem;
        }

        .product-card:target {
            border: 1px solid #d3d3d3;
            box-shadow: 0 0 8px #1f42f0;
        }

        .disabled-btn {
            background: #ccc !important;
            color: #666 !important;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <!-- Filter Section -->
    <div class="filter-section">
        <label for="filter">Filter by Category:</label>
        <select id="filter">
            <option value="all">All</option>
            <option value="electronics">Electronics</option>
            <option value="furniture">Furniture</option>
            <option value="clothes">Clothes</option>
            <option value="food">Food</option>
            <option value="education">Education</option>
            <option value="health">Health & Hygiene</option>
        </select>
    </div>

    <!-- Category Section -->
    <div class="section5">
        <h1>Donation Categories</h1>
        <div class="section5-categories">
            <div class="categories-box">
                <svg width="65px" height="65px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path clip-rule="evenodd"
                            d="M17 11C17 9.89543 17.8954 9 19 9H21V4H16.8569C16.4834 5.6291 15.4009 7.03561 13.8672 7.80248L12.8944 8.28885C12.3314 8.57038 11.6686 8.57038 11.1056 8.28885L10.1328 7.80248C8.59908 7.03561 7.51661 5.6291 7.14314 4H3V9H5C6.10457 9 7 9.89543 7 11V20H17V11ZM12 6.5L11.0272 6.01362C9.78482 5.39241 9 4.12255 9 2.73347C9 2.32838 8.67162 2 8.26653 2H3C1.89543 2 1 2.89543 1 4V10C1 10.5523 1.44772 11 2 11H5V20C5 21.1046 5.89543 22 7 22H17C18.1046 22 19 21.1046 19 20V11H22C22.5523 11 23 10.5523 23 10V4C23 2.89543 22.1046 2 21 2H15.7335C15.3284 2 15 2.32838 15 2.73347C15 4.12255 14.2152 5.39241 12.9728 6.01362L12 6.5Z"
                            fill="#9B87F5" fill-rule="evenodd"></path>
                    </g>
                </svg>
                <p>Clothes</p>
            </div>
            <div class="categories-box">
                <svg width="64px" height="64px" viewBox="-40.96 -40.96 1105.92 1105.92"
                    xmlns="http://www.w3.org/2000/svg" fill="#9B87F5" stroke="#9B87F5"
                    stroke-width="26.624000000000002">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"
                        stroke-width="2.048"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="#9B87F5"
                            d="M599.872 203.776a189.44 189.44 0 0 1 64.384-4.672l2.624.128c31.168 1.024 51.2 4.096 79.488 16.32 37.632 16.128 74.496 45.056 111.488 89.344 96.384 115.264 82.752 372.8-34.752 521.728-7.68 9.728-32 41.6-30.72 39.936a426.624 426.624 0 0 1-30.08 35.776c-31.232 32.576-65.28 49.216-110.08 50.048-31.36.64-53.568-5.312-84.288-18.752l-6.528-2.88c-20.992-9.216-30.592-11.904-47.296-11.904-18.112 0-28.608 2.88-51.136 12.672l-6.464 2.816c-28.416 12.224-48.32 18.048-76.16 19.2-74.112 2.752-116.928-38.08-180.672-132.16-96.64-142.08-132.608-349.312-55.04-486.4 46.272-81.92 129.92-133.632 220.672-135.04 32.832-.576 60.288 6.848 99.648 22.72 27.136 10.88 34.752 13.76 37.376 14.272 16.256-20.16 27.776-36.992 34.56-50.24 13.568-26.304 27.2-59.968 40.704-100.8a32 32 0 1 1 60.8 20.224c-12.608 37.888-25.408 70.4-38.528 97.664zm-51.52 78.08c-14.528 17.792-31.808 37.376-51.904 58.816a32 32 0 1 1-46.72-43.776l12.288-13.248c-28.032-11.2-61.248-26.688-95.68-26.112-70.4 1.088-135.296 41.6-171.648 105.792C121.6 492.608 176 684.16 247.296 788.992c34.816 51.328 76.352 108.992 130.944 106.944 52.48-2.112 72.32-34.688 135.872-34.688 63.552 0 81.28 34.688 136.96 33.536 56.448-1.088 75.776-39.04 126.848-103.872 107.904-136.768 107.904-362.752 35.776-449.088-72.192-86.272-124.672-84.096-151.68-85.12-41.472-4.288-81.6 12.544-113.664 25.152z">
                        </path>
                    </g>
                </svg>

                <p>Food</p>
            </div>
            <div class="categories-box">
                <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M12 18H12.01M9.2 21H14.8C15.9201 21 16.4802 21 16.908 20.782C17.2843 20.5903 17.5903 20.2843 17.782 19.908C18 19.4802 18 18.9201 18 17.8V6.2C18 5.0799 18 4.51984 17.782 4.09202C17.5903 3.71569 17.2843 3.40973 16.908 3.21799C16.4802 3 15.9201 3 14.8 3H9.2C8.0799 3 7.51984 3 7.09202 3.21799C6.71569 3.40973 6.40973 3.71569 6.21799 4.09202C6 4.51984 6 5.07989 6 6.2V17.8C6 18.9201 6 19.4802 6.21799 19.908C6.40973 20.2843 6.71569 20.5903 7.09202 20.782C7.51984 21 8.07989 21 9.2 21Z"
                            stroke="#9B87F5" stroke-width="1.608" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>

                <p>Electronics</p>
            </div>
            <div class="categories-box">
                <svg height="64px" width="64px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#9B87F5"
                    stroke="#9B87F5" stroke-width="8.704">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                            .st0 {
                                fill: #9B87F5;
                            }
                        </style>
                        <g>
                            <path class="st0"
                                d="M474.828,156.693H460.18v-25.402c0-36.184-29.321-65.505-65.518-65.512h-277.33 C81.14,65.786,51.82,95.107,51.82,131.291v25.402H37.169C16.637,156.7,0.004,173.33,0,193.873v165.6 c0.004,20.536,16.637,37.158,37.169,37.172h17.398l3.989,49.576h54.651l3.985-49.576h277.624l3.986,49.576h54.65l3.979-49.576 h17.398c20.53-0.014,37.16-16.636,37.172-37.172v-165.6C511.993,173.33,495.357,156.7,474.828,156.693z M73.584,131.291 c0.006-12.116,4.88-22.986,12.815-30.93c7.951-7.931,18.823-12.811,30.934-12.811h277.33c12.117,0,22.992,4.88,30.937,12.811 c7.938,7.944,12.811,18.814,12.818,30.93v30.99c-10.362,6.483-17.264,17.945-17.278,31.07v108.8H90.858v-108.8 c-0.007-13.125-6.909-24.587-17.274-31.07V131.291z M93.118,424.45H78.644l-2.237-27.805h3.565h15.385L93.118,424.45z M433.356,424.45h-14.474l-2.229-27.805h15.368h3.578L433.356,424.45z M490.23,359.473c-0.007,4.286-1.703,8.064-4.514,10.895 c-2.824,2.804-6.602,4.5-10.889,4.506h-42.806H79.972H37.169c-4.286-0.007-8.065-1.702-10.889-4.506 c-2.804-2.831-4.503-6.609-4.509-10.895v-165.6c0.006-4.293,1.706-8.078,4.509-10.902c2.817-2.798,6.602-4.5,10.889-4.506H54.2 c4.152,0.007,7.797,1.649,10.534,4.36c2.707,2.737,4.35,6.382,4.356,10.528v130.564h373.82V193.351 c0.007-4.146,1.649-7.79,4.359-10.528c2.73-2.711,6.382-4.353,10.528-4.36h17.03c4.286,0.007,8.065,1.709,10.889,4.513 c2.81,2.824,4.507,6.602,4.514,10.895V359.473z">
                            </path>
                        </g>
                    </g>
                </svg>

                <p>Furniture</p>
            </div>
            <div class="categories-box">
                <svg width="64px" height="64px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#9B87F5">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>Health</title>
                        <rect width="24" height="24" fill="none" stroke="#9B87F5" stroke-width="0" opacity="0.01">
                        </rect>
                        <path d="M17.5,13.5h-4v4h-3v-4h-4v-3h4v-4h3v4h4ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Z"
                            transform="translate(0 0)"></path>
                    </g>
                </svg>

                <p>Health n Hygiene</p>
            </div>
            <div class="categories-box">
                <svg width="60px" height="64px" viewBox="0 0 48 48" id="Layer_1" version="1.1" xml:space="preserve"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#9B87F5">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                            .st0 {
                                fill: #9B87F5;
                            }
                        </style>
                        <path class="st0"
                            d="M8.278,35.973c0,3.048,2.48,5.527,5.528,5.527h22.488c0.276,0,0.5-0.224,0.5-0.5v-1.53 c0-0.104-0.039-0.195-0.093-0.274c-0.006-0.009-0.004-0.021-0.01-0.03c-0.705-0.92-1.078-2.024-1.078-3.193s0.373-2.273,1.078-3.194 c0.006-0.008,0.004-0.02,0.01-0.029c0.054-0.08,0.093-0.171,0.093-0.275v-1.03h2.237c0.276,0,0.5-0.224,0.5-0.5v-1.53 c0-0.104-0.039-0.195-0.093-0.275c-0.006-0.009-0.003-0.021-0.01-0.029c-0.705-0.921-1.077-2.025-1.077-3.194 s0.373-2.273,1.077-3.194c0.006-0.008,0.004-0.02,0.01-0.029c0.054-0.08,0.093-0.171,0.093-0.275v-1.53c0-0.276-0.224-0.5-0.5-0.5 h-5.227v-4.659l3.947-1.862v3.428c-0.563,0.206-0.969,0.742-0.969,1.376c0,0.81,0.659,1.469,1.469,1.469 c0.811,0,1.47-0.659,1.47-1.469c0-0.634-0.406-1.17-0.97-1.376V13.08c0-0.088-0.029-0.166-0.068-0.238 c-0.01-0.019-0.022-0.034-0.035-0.051c-0.043-0.059-0.095-0.107-0.159-0.142c-0.008-0.005-0.012-0.015-0.021-0.019L25.854,6.55 c-0.138-0.066-0.297-0.066-0.435,0l-12.615,6.08c-0.173,0.083-0.284,0.26-0.283,0.452c0.001,0.193,0.112,0.368,0.287,0.45 l4.661,2.198v4.659h-0.926c-1.48,0-2.87,0.574-3.912,1.616c-1.042,1.042-1.615,2.431-1.615,3.912c0,1.894,0.958,3.567,2.415,4.564 c-1.337,0.09-2.585,0.627-3.536,1.579C8.852,33.102,8.278,34.491,8.278,35.973z M34.652,35.473H13.15c-0.276,0-0.5,0.224-0.5,0.5 s0.224,0.5,0.5,0.5h21.502c0.069,0.884,0.314,1.729,0.735,2.497H13.972c-1.653,0-2.998-1.344-2.998-2.997 c0-0.803,0.312-1.556,0.874-2.119c0.575-0.567,1.329-0.879,2.124-0.879h21.416C34.966,33.744,34.722,34.588,34.652,35.473z M37.39,25.417H15.887c-0.276,0-0.5,0.224-0.5,0.5s0.224,0.5,0.5,0.5H37.39c0.069,0.885,0.314,1.729,0.735,2.498H16.709 c-1.653,0-2.998-1.345-2.998-2.998c0-0.802,0.312-1.556,0.874-2.119c0.575-0.567,1.329-0.879,2.124-0.879h21.415 C37.703,23.688,37.459,24.533,37.39,25.417z M38.252,19.142c-0.259,0-0.469-0.21-0.469-0.469s0.21-0.469,0.469-0.469 s0.47,0.21,0.47,0.469S38.511,19.142,38.252,19.142z M14.184,13.075l11.454-5.52l11.453,5.52l-3.286,1.55v-1.448 c0-0.065-0.014-0.127-0.037-0.185c-0.008-0.021-0.022-0.037-0.033-0.057c-0.019-0.034-0.038-0.068-0.065-0.096 c-0.017-0.018-0.038-0.032-0.057-0.048c-0.028-0.022-0.056-0.044-0.089-0.06c-0.024-0.012-0.05-0.019-0.076-0.027 c-0.022-0.007-0.041-0.019-0.064-0.022l-1.819-0.291c-3.933-0.632-7.921-0.633-11.854,0l-1.82,0.291 c-0.023,0.004-0.042,0.016-0.064,0.022c-0.026,0.008-0.052,0.015-0.076,0.027c-0.033,0.016-0.06,0.037-0.089,0.06 c-0.02,0.016-0.04,0.029-0.057,0.048c-0.027,0.029-0.046,0.062-0.065,0.096c-0.011,0.019-0.025,0.036-0.033,0.057 c-0.023,0.058-0.037,0.119-0.037,0.185v1.448L14.184,13.075z M18.469,15.414v-1.81l1.4-0.224c3.827-0.615,7.708-0.615,11.537,0 l1.398,0.223v1.811v4.976H18.469V15.414z M12.016,25.917c0-1.214,0.47-2.353,1.322-3.205c0.854-0.853,1.992-1.323,3.205-1.323h1.426 h15.335h5.227v0.53H16.709c-1.059,0-2.063,0.415-2.828,1.169c-0.754,0.755-1.169,1.759-1.169,2.828c0,2.204,1.793,3.998,3.998,3.998 h21.822v0.53h-2.237H16.543C14.046,30.445,12.016,28.414,12.016,25.917z M13.806,31.445h2.737h19.251v0.53H13.972 c-1.059,0-2.062,0.415-2.828,1.169c-0.754,0.754-1.169,1.758-1.169,2.828c0,2.204,1.793,3.997,3.998,3.997h21.822v0.53H13.806 c-2.497,0-4.528-2.031-4.528-4.527c0-1.214,0.47-2.353,1.323-3.205C11.454,31.915,12.592,31.445,13.806,31.445z">
                        </path>
                    </g>
                </svg>

                <p>Books</p>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <div class="product-section">
        <h2>Our Products</h2>
        <div class="product-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $productId = $row['product_id'];
                    $priceText = ($row['product_price'] == 0) ? 'Free' : '₹' . $row['product_price'];
                    $disableButtons = ($row['status'] === 'sold') ? 'style="pointer-events: none; opacity: 0.6;"' : '';

                    echo <<<HTML
                            <div class="product-card" data-category="{$row['product_type']}" id="{$row['product_id']}">
                                <div class="details">    
                                    <img src="./product_images/{$row['product_img']}" alt="Product Image">
                                    <h3>{$row['product_name']}</h3>
                                    <p style="color: #37a8fe">{$row['status']}</p>
                                    <p><strong style="color:rgb(35, 187, 1)">Price: {$priceText}</strong></p>
                                    <p>Category: {$row['product_type']}</p>
                                    <p>{$row['product_details']}</p>
                                </div>
                                
                                <div class="product-actions" {$disableButtons}>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="product_id" class="pid" id="{$row['product_id']}" value="{$row['product_id']}">
                                        <button type="submit" name="add_to_cart" class="add-to-cart">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
                                        
                                    </form>
                            
                                    <a href="buy-now.php?product_id={$row['product_id']}" class="view-details" style="text-decoration:none; color: black">Buy Now</a>
                                    
                                </div>

                            </div>
                        HTML;
                }
            }
            ?>

        </div>
    </div>

    <script>
        // Filter functionality
        const filter = document.getElementById('filter');
        const productCards = document.querySelectorAll('.product-card');

        filter.addEventListener('change', () => {
            const selectedCategory = filter.value;
            productCards.forEach(card => {
                if (selectedCategory === 'all' || card.dataset.category === selectedCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Image Slider functionality
        let currentSlide = 0;

        function moveSlide(direction) {
            const slides = document.querySelector('.slides');
            const totalSlides = slides.children.length;

            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    </script>
</body>

</html>

<?php
include("footer.php");
?>