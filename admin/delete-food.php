<?php
    include('config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {

        //echo "Entered";
        $id=$_GET['id'];
        echo $image_name=$_GET['image_name'];

        //Remove the physical image
        if($image_name!= "")
        {
            $path='../images/food/'.$image_name;
            //echo $path;

            $remove= unlink($path);

            if($remove==FALSE)
            {
                //Image not removed
                $_SESSION['food-remove-failed']="<div class='error'>Image remove failed</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

                //STOP the process
                die();
            }
        }

        $sql= "DELETE FROM tbl_food WHERE id='$id'";

        $res= mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            //Data deleted successfully
            $_SESSION['delete-food']="<div class='success'>Data deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //Data no deleted
            $_SESSION['delete-food']="<div class='error'>Data not deleted</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            
        }
    }
    else{
        //Redirect to manage-food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>