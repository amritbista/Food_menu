<?php
    //Include constants file her
    include('config/constants.php');

    //Get id from manage-category
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id= $_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical image file
        if($image_name!= "")
        {
            echo "Image is available so remove it";
            $path= "../images/category/".$image_name ;
            //Remove the image
            $remove= unlink($path);

            //If failed to remove image
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove']="<div class='error'>Image not removed</div> ";
                //Redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //Stop the process
                die();
            }
        }

        //Sql to delete data from database
        $sql= "DELETE FROM tbl_category WHERE id=$id";

        //Execute query
        $res=mysqli_query($conn,$sql);

        //Check whether category deleted or not
        if($res==TRUE)
        {
            //Category deleted successfully
            $_SESSION['delete-category']= "<div class='success'>Category deleted successfully </div>";
            //Redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
            //Category not deleted 
            $_SESSION['delete-category']= "<div class='error'>Category not deleted </div>";
            //Redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //Redirect to manage-category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>