<?php    include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food Category</h1>
        <?php
            if(isset($_SESSION['foot-not-updated']))
            {
                echo $_SESSION['food-not-updated'];
                unset($_SESSION['food-not-updated']);
            }
            if(isset($_SESSION['food-update']))
            {                        
                //message if update failed
                echo $_SESSION['food-update'];
                unset($_SESSION['food-update']);            
            }
        ?>
        <br><br>
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];

                //Run sql to get data from Database
                $sql= "SELECT * FROM tbl_food WHERE id=$id";

                $res= mysqli_query($conn,$sql);

                //Count the number of rows
                $count=mysqli_num_rows($res);
                
                //echo $count;

                if($count==1)
                {
                    //Get individual data
                    $row= mysqli_fetch_assoc($res);

                    $title= $row['title'];
                    $description= $row['description'];
                    $price= $row['price'];
                    $current_image = $row['image_name'];
                    $category= $row['category_id'];
                    $featured= $row['featured'];
                    $active= $row['active'];
                    
                }
            }
        ?>

        <!--Update form starts here-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"> </td>
                    
                </tr>
                <tr>
                    <td>Desription: </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea> </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" ></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                    <?php
                        if($current_image!= "")
                        {
                            //Display image
                    ?>
                        <img src="<?php echo SITEURL.'images/food/'.$current_image ;?>" width="100px">
                    <?php
                        }
                        else{
                            echo "<div class='error'>Image not found</div>";
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                        <td>New Image: </td>
                        <td><input type="file" name="new_image"> </td>
                </tr>
                <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                    //Select category from tbl_category Database
                                    $sql2="SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res2= mysqli_query($conn, $sql2);

                                    $count2= mysqli_num_rows($res2);

                                    if($count2>0)
                                    {
                                        //Display categories
                                        while($row2=mysqli_fetch_assoc($res2))
                                        {
                                            $id2=$row2['id'];
                                            $title2= $row2['title'];
                                ?>
                                        <option value="<?php echo $id2; ?> >"><?php echo $title2; ?> </option>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                        //No categories
                                ?>
                                        <option value="0">No categories Found</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                        
                </tr>
                <tr>
                        <td>Featured: </td>
                        <td><input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes" > Yes
                        <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No" > No</td>
                </tr>
                <tr>
                        <td>Active: </td>
                        <td><input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes" > Yes
                        <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No" > No</td>
                </tr>
                <tr>
                        <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary"> 
                        </td>
                </tr>
                
                
            </table>
        </form>
        <!--Update form ends here-->

        <?php
            //Update the data into database
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                $id= $_POST['id'];
                $current_image= $_POST['current_image'];
                $title= $_POST['title'];
                //echo "After submit: ".$title;

                $description= $_POST['description'];
                $price= $_POST['price'];
                //echo $new_image = $_POST['new_image'];
                $category= $_POST['category'];
                $featured= $_POST['featured'];
                $active= $_POST['active'];

                //Check if the image is upload or not
                
                if(isset($_FILES['new_image']['name']))
                {
                    $new_image=$_FILES['new_image']['name'];
                    if($new_image != "")
                    {
                        //echo "upload image";

                        $ext= explode('.',$new_image);
                        $end_ext= end($ext);

                        //Rename the image name
                        $new_image= "Food_item_".rand(000,999).'.'.$end_ext;

                        $source_path= $_FILES['new_image']['tmp_name'];

                        $destination_path= "../images/food/".$new_image;

                        $upload= move_uploaded_file($source_path,$destination_path);

                        if($upload==FALSE)
                        {
                            //Image not updated
                            $_SESSION['food-not-updated']="<div class='error'>Image not updated</div>";

                            header('location:'.SITEURL.'admin/update-food.php');
                        }
                        //Remove the current image
                        if($current_image!= "")
                        {
                            //Remove
                            echo $current_image;
                            $path= "../images/food/".$current_image;

                            $remove= unlink($path);

                            //Check whether the current image is removed or not
                            if($remove==FALSE)
                            {
                                //Image remove failed
                                $_SESSION['failed-update']="<div class='error'>Failed to remove image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                            }
                        }
                    }
                }

                //echo "Before update, title=".$title;

                //Update data into Database
                
                $sql3= "UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price='$price',
                    image_name='$new_image',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id 
                ";
                $res3= mysqli_query($conn,$sql3);

                if($res3==TRUE)
                {
                    //Data update successful
                    $_SESSION['food-update']="<div class='success'>Data Update successful</div";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //Data update  failed
                    $_SESSION['food-update']="<div class='error'>Data Update Failed</div";
                    header('location:'.SITEURL.'admin/update-food.php');
                }
                
            }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>