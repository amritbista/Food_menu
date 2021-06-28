<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>
            <?php
                if(isset($_SESSION['food-entry']))
                {
                    
                    //Message if data insertion failed
                    echo $_SESSION['food-entry'];
                    unset($_SESSION['food-entry']);
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Enter title"> </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea> </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"> </td>
                    </tr>
                    <tr>
                        <td>Image: </td>
                        <td><input type="file" name="image"> </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                
                                    //Create PHP code to display category from database
                                    //1. Run SQL query to get all active category from database
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res= mysqli_query($conn, $sql);

                                    //Count rows to check no of rows
                                    $count= mysqli_num_rows($res);

                                    echo $count;

                                    //If count is greater than zero we have categories else we dont have categories
                                    if($count>0)
                                    {
                                        //Display categoreis
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $id=$row["id"];
                                            $title=$row['title'];
                                ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?> </option>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                        //No categories
                                ?>
                                        <option value="0">No Category Found</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Add food" class="btn-secondary" ></td>
                    </tr>
                </table>
            
            </form>

            <?php
                //Get the data from the form
                if(isset($_POST['submit']))
                {
                    
                    //echo "clicked";
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price= $_POST['price'];
                    $category= $_POST['category'];
                                        

                    if(isset($_POST['featured']))
                    {
                        $featured= $_POST['featured'];
                    }
                    else
                    {
                        //Set default value
                        $featured="No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active= $_POST['active'];
                    }
                    else
                    {
                        //Set default value
                        $active="No";
                    }
                    //2. Upload the image if selected
                    //Whether the submit image is clicked or not

                    

                    if(isset($_FILES['image']['name']))
                    {
                        
                        $image_name=$_FILES['image']['name'];
                                                
                        if($image_name!= "")
                        {
                            //echo "image found";
                            //Image is selected
                            //A. REname the image
                            //Get the extension of the image
                            $ext= explode('.',$image_name);
                            $end_ext=end($ext);

                            //echo $ext;

                            $image_name= "Food_name_".rand(000,999).'.'.$end_ext;
                            //B. Upload the image
                            $source_path= $_FILES['image']['tmp_name'];

                            $destination_path= "../images/food/".$image_name;

                            $upload= move_uploaded_file($source_path,$destination_path);
                            if($upload== FALSE)
                            {
                                //Failed to upload image
                                $_SESSION['upload-failed']="<div class='error'>Image upload failed</div>";
                                //Redirect to Add food page with error message
                                header('location:'.SITEURL.'admin/add-food.php');
                                //End the process
                                die();
                            }
                            
                        }
                            
                    }
                    else{
                        //Image not selected
                        
                        echo "Image not found";
                    }

                    
                    //Create sql query to insert data into database
                    $sql1= "INSERT INTO tbl_food SET
                    title='$title',
                    description= '$description',
                    price='$price',
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'
                    ";

                    $res1=mysqli_query($conn,$sql1);

                    if($res==TRUE)
                    {
                        //Data inserted successfully
                        $_SESSION['food-entry']="<div class='success'>Data inserted successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else{
                        //Data insertion failed
                        $_SESSION['food-entry']="<div class='error'>Data insertion failed</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                    }   
                    
                }
                
               
            ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>