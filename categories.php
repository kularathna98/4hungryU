<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                //display all the categories that are active
                $sql = "SELECT * FROM category WHERE active='Yes'";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //count rows
                $count = mysqli_num_rows($res);
                //check whether the categories available or not
                if($count>0)
                {
                    while ($row = mysqli_fetch_assoc($res)) {
                        # code...
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                         <a href="category-foods.html">
                        <div class="box-3 float-container">
                            <?php
                                if ($image_name=="") {
                                    # code...
                                    echo "<div class='error'>Image not found.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve";
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not found.</div>";
                }
            ?>
           
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-front/footer.php'); ?>