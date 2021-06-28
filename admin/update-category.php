<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>
            <?php
                if(isset($_SESSION['update-category']))
                {
                        echo $_SESSION['update-category'];
                        unset($_SESSION['update-category']);
                }
                if(isset($_SESSION['data-update']))
                {
                    echo $_SESSION['data-update'];
                    unset($_SESSION['data-update']);
                }

            ?>
            <?php
                if(isset($_GET['id']))
                {
                    //Get the id and all other data
                                       
                    $id=$_GET['id'];

                    $sql="SELECT * FROM tbl_category WHERE id=$id";

                    $res=mysqli_query($conn,$sql);

                    //Count the rows whether id is valid or not
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        //Category found
                        $row=mysqli_fetch_assoc($res);
                        
                        $title=$row['title'];
                        $current_image=$row['image_name'];
                        $featured=$row['featured'];
                        $active= $row['active'];

                    }
                    else{
                        //Redirect to manage-category with error message
                        $_SESSION['no-category-found']="<div class='error'>No category found</div> ";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
                else
                {
                    //Redirect to manage-category with error message
                    $_SESSION['failed-update-category']="<div class='error'>Failed to update category</div> "; 
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"> </td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                        <?php
                            if($current_image !="")
                            {
                                //Display image
                        ?>
                            <img src="<?php echo SITEURL.'images/category/'.$current_image; ?>" width="100px"> 
                        <?php
                            }
                            else{
                                //Display error message
                                echo "<div class='error'>Image not found";
                            }
                        ?>
                        
                        
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td><input type="file" name="image"> </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No"){echo "checked"; } ?> type="radio" name="featured" value="No"> No 
                        </td>
                    </tr>
                    <tr> 
                        <td>Active</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No"){echo "checked"; } ?> type="radio" name="active" value="No"> No 
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary" >
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                
                $title=$_POST['title'];
                $id=$_POST['id'];
                $current_image=$_POST['current_image'];
                
                $featured= $_POST['featured'];
                $active= $_POST['active'];
                    
                

                //Check if image is uploaded or not
                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //To upload image we need image name, source path and destination path
                    $image_name=$_FILES['image']['name'];
                    
                    //Check whethe image is available or not
                    if($image_name!= "")
                    {
                        //Upload new image


                        //Auto rename the image, get the extention jpg, gif, png
                        $ext= end(explode('.',$image_name));
                        //echo $ext;

                        //Rename the image
                        $image_name='Food_Category_'.rand(000,999).'.'.$ext;

                        $source_path= $_FILES['image']['tmp_name'];

                        $destination_path = '../images/category/'.$image_name;

                        //Finally upload the image
                        $upload= move_uploaded_file($source_path,$destination_path);

                        //echo "upload=".$upload;
                        //Check whether the image is uploaded or not
                        //And if image is not uploaded we will stop the process and redirect with error message
                        if($upload==FALSE)
                        {
                            $_SESSION['update-category']="<div class='error'>Image update failed</div> ";
                            header('location:'.SITEURL.'admin/update-category.php');

                            //stop the process
                            die();
                        }
                        
                        //Remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove= unlink ($remove_path);

                            //Check whether the current image is removed or not
                            //If failed to remove the image then display message and end the process
                            if($remove==FALSE)
                            {
                                //Image remove failed
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove image</div> ";
                                header('location:'.SITEURL.'admin/manage-category.php');

                                die();
                            }
                        }
                    }


                }
                else
                {
                    //Dont upload the image and set the image name as null
                    $image_name="";
                }
                
                
                //Update the database
                $sql2= "UPDATE tbl_category SET
                        title= '$title',
                        featured= '$featured',
                        active= '$active',
                        image_name='$image_name'
                        WHERE id=$id
                ";

                $res2= mysqli_query($conn,$sql2);
                //echo $res2;
                
                if($res2==TRUE)
                {
                    //Data update successfull
                    $_SESSION['data-update']="<div class='success'>Data Update successful</div> ";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //Data update failed
                    $_SESSION['data-update']="<div class='erro'>Data Update Failed</div> ";
                    header('location:'.SITEURL.'admin/update-category.php');
                }
                 
            }
            
    ?>
        </div>

    </div>

    

<?php include('partials/footer.php'); ?>