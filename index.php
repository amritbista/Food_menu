<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL.'food-search.php'; ?>" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
    //Display message if food order successful or failed
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //echo "Database";
                //Run sql to get data from Database
                $sql= "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3";

                $res= mysqli_query($conn,$sql);
                
                //Count the number of reows
                $count= mysqli_num_rows($res);
                //echo $count;

                if($count>0)
                {
                    //Display categories useing while loop
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $image_name= $row['image_name'];
                        $title= $row['title']
                        //echo $image_name."<br>";
            ?>
                    <a href="<?php echo SITEURL.'category-foods.php?category_id='.$id.'&title='.$title ; ?>">
                    <div class="box-3 float-container">

                        <?php
                            if($image_name != "")
                            {
                                //Category Image is available
                        ?>
                                <img src="<?php echo SITEURL.'images/category/'.$image_name ;?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                
                        <?php
                            }
                            else{
                                //Category Image not available
                                echo "<div class='error'>Category Image not available</div>"; 
                            }
                        ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>
            <?php
                    }
                }
                
            ?>
            
            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql1= "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6" ;

                $res1= mysqli_query($conn, $sql1);

                $count1= mysqli_num_rows($res1);
                
                //echo $count;
                if($count1>0)
                {
                    //Data found
                    while($row=mysqli_fetch_assoc($res1))
                    {
                        //Get all data from database
                        $id= $row['id'];
                        $title= $row['title'];
                        $image_name= $row['image_name'];
                        $price= $row['price'];
                        $description= $row['description'];

            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //Check if image is available or not
                                    if($image_name!="")
                                    {
                                        //Image is available and dislpay it
                                ?>
                                        <img src="<?php echo SITEURL.'images/food/'.$image_name ; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                                    }
                                    else{
                                        //Image not available and dislpay error message
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                ?>

                                
                            </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Nrs <?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                    <br>

                    <a href="<?php echo SITEURL.'order.php?food_id='.$id;?>" class="btn btn-primary">Order Now</a>
                </div>
                        </div>
            <?php
                    }
                }
                else{

                    echo "<div class='error'>No food items found</div>";
                }
            ?>

            

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>