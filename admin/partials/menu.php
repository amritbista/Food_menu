<?php //include('../config/constants.php'); ?>
<?php include('C:\xampp\htdocs\Food_menu\admin\config\constants.php'); ?>
<?php include('login-check.php'); ?>

<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href=<?php echo SITEURL."css/admin.css"; ?> >
</head> 
<body>
    
    <!-- Menu Section starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin Manager</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="../admin/logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->


    
