<?php include('partials/menu.php'); ?>

<!-- Main content starts here */ -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>
        <?php
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['delete-category']))
            {
                echo $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
            }
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['no-cateogry-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if(isset($_SESSION['failed-update-category']))
            {
                echo $_SESSION['failed-update-category'];
                unset($_SESSION['failed-update-category']);
            }
            if(isset($_SESSION['data-update']))
            {
                echo $_SESSION['data-update'];
                unset($_SESSION['data-update']);
            }
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>

        </br>
            </br>
            <!-- Botton to add Category -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            </br>
            </br>
            <table class="tbl-full">
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Query to get all Categories from Database
                    $sql= "SELECT * FROM tbl_category";

                    //Execute query
                    $res=mysqli_query($conn,$sql);

                    if($res==TRUE)
                    {
                        //Count rows
                        $count= mysqli_num_rows($res);

                        if($count>0)
                        {
                            //We have data in database
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Get individual data
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $image_name=$rows['image_name'];
                                $featured=$rows['featured'];
                                $active=$rows['active'];
                    ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                            //Check whether image name is available or not
                                            if($image_name!="")
                                            {
                                                //Display image
                                        ?>
                                            <img src="<?php echo SITEURL.'images/category/'.$image_name ?>" alt="" width="100px" >
                                        <?php
                                            }
                                            else
                                            {
                                                echo "<div class='error'>Image not added";
                                            }
                                        ?>
                                        
                                </td>
                                    
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL.'admin/update-category.php?id='.$id; ?> " class="btn-secondary">Update Category </a>
                                        <a href="<?php echo SITEURL.'admin/delete-category.php?id='.$id.'&image_name='.$image_name; ?>" class="btn-danger">Delete Category </a>
                                    </td>
                                </tr>
                    <?php

                            }
                        }
                        else{
                            //We dont have data in Database
                        }
                    }
                ?>

                

                
            </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>