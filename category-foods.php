<?php include('partials-front/menu.php'); ?>

<?php
    //Check whether id is passed or no
    if(isset($_GET['category_id']))
    {
        //Category id is set and get the id
        $category_id= $_GET['category_id'];
        $title= $_GET['title'];
    }
    else{
        //Category id not set and redirect to homepage
        header('location:'.SITEURL);
    }
    
    //echo $image_name;
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //echo $category_id.'<br>';
                $sql= "SELECT * FROM tbl_food WHERE category_id='$category_id' ";

                $res= mysqli_query($conn,$sql);

                $count= mysqli_num_rows($res);
                //echo $count;

                while($row=mysqli_fetch_assoc($res))
                {
                    //Display food
                    $id= $row['id'];
                    $title= $row['title'];
                    $description= $row['description'];
                    $price= $row['price'];
                    $image_name= $row['image_name'];
            ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Check if the image is available or not
                                if($image_name!="")
                                {
                                    //Image is available
                            ?>
                                    <img src="<?php echo SITEURL.'images/food/'.$image_name; ?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                                }
                                else{
                                    echo "<div class='error'>Image not found</div>";
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Nrs <?php echo round($price,0); ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
            <?php

                }
            ?>

            
            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>