<?php include('partials/menu.php'); ?>

<!-- Main content starts here */ -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br><br>
        <?php
            if(isset($_SESSION['food-entry']))
            {                        
                //Message if data inserted successfully
                echo $_SESSION['food-entry'];
                unset($_SESSION['food-entry']);            
            }
            if(isset($_SESSION['delete-food']))
            {                        
                //Message if data inserted successfully
                echo $_SESSION['delete-food'];
                unset($_SESSION['delete-food']);            
            }
            if(isset($_SESSION['food-remove-failed']))
            {                        
                //Food image remove failed
                echo $_SESSION['food-remove-failed'];
                unset($_SESSION['food-remove-failed']);            
            }
            if(isset($_SESSION['failed-update']))
            {                        
                //Message if the image is not removed while updating new one
                echo $_SESSION['failed-update'];
                unset($_SESSION['failed-update']);            
            }
            if(isset($_SESSION['food-update']))
            {                        
                //Message if data update is successful
                echo $_SESSION['food-update'];
                unset($_SESSION['food-update']);            
            }
        ?>
        </br>
            </br>
            <!-- Botton to add food -->
            <a href="<?php echo SITEURL.'admin/add-food.php'; ?> " class="btn-primary">Add Food</a>
            </br>
            </br>
            <table class="tbl-full">
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Get all the data from Database
                    $sql= "SELECT * FROM tbl_food";

                    $res=mysqli_query($conn,$sql);

                    //Count the number of rows
                    $count= mysqli_num_rows($res);

                    if($count>0)
                    {
                        //Data found
                        $sn=1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //While loop to get all data from Databae

                            //Get all the individual data
                            $id=$row['id'];
                            $title= $row['title'];
                            $description= $row['description'];
                            $price= $row['price'];
                            $image_name= $row['image_name'];
                            $category= $row['category_id'];
                            $featured= $row['featured'];
                            $active= $row['active'];
                    ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo "Nrs ".$price; ?></td>
                                <td>
                                <?php
                                    //Check if image is available or not
                                    if($image_name!= "")
                                    {
                                        //Display image
                                ?>
                                        <img src="<?php echo SITEURL.'images/food/'.$image_name; ?> " width="100px">
                                <?php
                                    }
                                    else{
                                        echo "<div class='error'>Image not found</div>";
                                    }
                                ?>
                                </td>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL.'admin/update-food.php?id='.$id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo SITEURL.'admin/delete-food.php?id='.$id.'&image_name='.$image_name; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>
                    <?php
                            
                        }
                    }
                ?>

                

               
            </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>