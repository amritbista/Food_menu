<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql= "SELECT * FROM tbl_category WHERE active='Yes' ";

                $res= mysqli_query($conn,$sql);

                $count= mysqli_num_rows($res);
                
                if($count>0)
                {
                    //Display categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id= $row['id'];
                            
                        $image_name=$row['image_name'];
                            $title= $row['title'];

            ?>
                        <a href="<?php echo SITEURL.'category-foods.php?category_id='.$id.'&title='.$title; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name!="")
                                {

                            ?>
                                <img src="<?php echo SITEURL.'images/category/'.$image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                                    //Image is available and dislpay it
                                }
                                else{
                                    echo "</div class='error'>Image not available</div>";
                                }
                            ?>
                            
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>
            <?php
                    }
                }
                else{
                    echo "<div class='error'>No categories</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>