<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitshark Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <link rel="stylesheet" href="assets/css/viewcategory.css">
    <link rel="stylesheet" href="assets/css/viewproduct.css">
</head>
<script src="admin/assets/js/viewproduct.js"></script>

<body>
    <div class="sidebar">
        <img src="login-sign-up.webp" alt="Sidebar Logo">
        <div class="sidebar-cnt">
            <a href="index.php">
                <i class="fa fa-home"></i>Dashboard</a>
            <a href="#" onclick="managecustomer()"><i class="fa fa-users"></i>Manage Customer</a>
            <a href="#" onclick=viewcategory()> <i class="fa fa-th-large"></i>Manage Category</a>
            <a href="#" onclick="manageorders()">Manage Orders</a>
            <a href="#" onclick=viewProduct()><svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <style>
                        svg {
                            fill: grey;
                        }
                    </style>
                    <path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z" />
                </svg>Manage Products</a>
        </div>
    </div>

    <div class="content" id="content">

    </div>

    <script src="assets/js/viewproduct.js"></script>
    <script src="assets/js/viewcategory.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const contentDiv = document.getElementById("content");

        function loadContent(page) {
            fetch(page)
                .then(response => response.text())
                .then(data => {
                    contentDiv.innerHTML = data;
                })
                .catch(error => {
                    console.error(`Error loading ${page}: ${error}`);
                });
        }

        // Initial load of 'initial.php'
        loadContent("assets/dashboard.php");


        function managecustomer(pageName) {
            fetch("assets/manage_customer.php")
                .then((response) => response.text())
                .then((content) => {
                    document.querySelector(".content").innerHTML = content;
                })
                .catch((error) => {
                    console.error("Error loading content:", error);
                });
        }

        function manageorders(pageName) {
            fetch("assets/manage_orders.php")
                .then((response) => response.text())
                .then((content) => {
                    document.querySelector(".content").innerHTML = content;
                })
                .catch((error) => {
                    console.error("Error loading content:", error);
                });
        }
    </script>
</body>

</html>