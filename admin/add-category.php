<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>
            <?php
                //Display messsage if image upload failed
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['add-category']))
                {
                    echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                }
            ?>

            <br><br>
            
            
            <!-- Add category form starts here-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-less">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" placeholder="Enter title"> </td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td><input type="file" name="image"> </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes 
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes 
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" class="btn-secondary" value="Add Category"> </td>
                    </tr>
                </table>

            </form>
            <!-- Add category form ends here-->
            <?php
                if(isset($_POST['submit']))
                {
                    
                    //Submit button set
                    //Get data from form
                    $title=$_POST['title'];
                    
                    if(isset($_POST['featured']))
                    {
                        //Get value from form
                        $featured=$_POST['featured'];
                    }
                    else{
                        //SET default value
                        $featured="No";
                    }
                    
                    if(isset($_POST['active']))
                    {
                        //Get value from form
                        $active=$_POST['active'];
                    }
                    else{
                        //SET default value
                        $active="No";
                    }
                    
                                
                    //Check whether image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //Upload the image
                        //To upload image we need image name, source path and destination path
                        $image_name=$_FILES['image']['name'];

                        //Upload image only if image is selected
                        if($image_name!="")
                        {

                            //Auto rename our image
                            //Get the extention of the image (jpg png gif etc) eg food1.jpg
                            $ext = end(explode('.',$image_name));

                            //Rename the image
                            $image_name = "Food_Category_".rand(000,999).'.'.$ext; //eg Food_Category_135.jpg

                            $source_path= $_FILES['image']['tmp_name'];
                            
                            $destination_path= "../images/category/".$image_name;

                            //Finally upload the image
                            $upload= move_uploaded_file($source_path,$destination_path);

                            //Check whether the image is uploaded or not
                            //And if the image is not uploaded then we will stop the process and redirect with error message
                            if($upload==false)
                            {
                                //Set session message
                                $_SESSION['upload']= "<div class='error'>Image upload failed</div> ";

                                //Redirect to add-category page
                                header('location:'.SITEURL.'admin/add-category.php');

                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        //Dont upload image and set the image name value as blank
                        $image_name="";
                    }

                    if(isset($_POST['image']))
                    {
                        //Image selected
                    }
                    else{
                        //Image not selected
                    }

                    //Create sql query to insert data into database
                    $sql= "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    $res=mysqli_query($conn,$sql) or die(mysqli_error());

                    if($res==TRUE)
                    {
                        //Data entry successful
                        //Create a session variable to dislpay message
                        $_SESSION['add-category']="<div class='success'>Category added sucessfully </div>";
                        //Redirect to manage-category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Data entry failed
                        //Create a session variable to dislpay message
                        $_SESSION['add-category']="<div class='error'>Category added failed </div>";
                        //Redirect to manage-category page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                    
                }
            ?>

        </div>

    </div>

            
<?php include('partials/footer.php');?>