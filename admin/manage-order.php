<?php include('partials/menu.php'); ?>

<!-- Main content starts here */ -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        </br>
            </br>
            
            <table class="tbl-full" id="menu_order">
                <tr>
                    <th>S.No.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Customer Email</th>
                    <th>Customer Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql="SELECT * FROM tbl_order";

                    $res= mysqli_query($conn,$sql);
                    $count= mysqli_num_rows($res);
                    //echo $count;
                    if($count>0)
                    {
                        //Data available
                        $sn= 1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id= $row['id'];
                            $food= $row['food'];
                            $price= round($row['price'],0);
                            $qty= $row['qty'];
                            $total= round($row['total'],0);
                            $order_date= $row['order_date'];
                            $status= $row['status'];
                            $customer_name= $row['customer_name'];
                            $customer_contact= $row['customer_contact'];
                            $customer_email= $row['customer_email'];
                            $customer_address= $row['customer_address'];
                ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update</a>
                                    <a href="#" class="btn-danger">Delete</a>
                                </td>
                            </tr>
                <?php
                        }
                    }
                    else{
                        echo "No Data Found";
                    }
                ?>

                

                
            </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>