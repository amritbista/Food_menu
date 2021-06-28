<?php
    //Include constants file here
    include('config/constants.php');

    
    // 1. Get the ID of admin to be deleted
    $id= $_GET['id'];
    //echo $id;

    //2. Create SQL Query to delete admin
    $sql= "DELETE FROM tbl_admin WHERE id=$id";

    //Execute query
    $res= mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if($res==TRUE){
        //Query executed sucessfully and admin deleted
        //echo "Admin Deleted";
        //Create session variale to Display message
        $_SESSION['delete']="<div class='sucess'>Admin deleted sucessfully</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to delete admin
        //echo "Failed to delete admin";
        $_SESSION['delete']="<div class='error'>Admin not deleted</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //"3. Redirect to Manage admin page with message (success/error)

?>