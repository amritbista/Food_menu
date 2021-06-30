<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            $search= $_POST['search'];
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Get the search keywoard
                
                //echo $search;

                //SQL query to get foods based on search keyword
                $sql= "SELECT * FROM tbl_food WHERE title LIKE '%$search$' OR description LIKE '%$search%'";

                $res= mysqli_query($conn,$sql);
                $count= mysqli_num_rows($res);
                //echo "Count=".$count;
                if($count>0)
                {
                    //Data found
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id= $row['id'];
                        $title= $row['title'];
                        //echo $title.'<br>';
                        $price= $row['price'];
                        $description= $row['description'];
                        $image_name= $row['image_name'];

            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php
                                    if($image_name!="")
                                    {
                                        //Image is available
                                ?>
                                         <img src="<?php echo SITEURL.'images/food/'.$image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                                    }
                                    else
                                    {
                                        echo "<div class='error'>Image no available</div>";
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

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

            <?php
                    }
                }
                else{
                    //Data not found
                    echo "<div class='error'>".$search." Food not Found</div>";
                }
            ?>
                                             


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>