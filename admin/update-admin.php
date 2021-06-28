<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            //1. Get ID to select admin
            $id=$_GET['id'];

            //2. Create SQL query to get details
            $sql= "SELECT * FROM tbl_admin WHERE id=$id";

            //3. Execute the query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==TRUE){
                //Check whether the data is available or not
                $count=mysqli_num_rows($res);
                if($count>=1){
                    //Get the details
                    //echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];
                }
                else{
                    //Redirect to manage-admin page
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>User Name</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>

                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value= "<?php echo $id; ?>">    
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //Check whether the update button is clicked or not
    if(isset($_POST['submit']))
    {
        //Submit button clicked

        //1. Get data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $id=$_POST['id'];

        //2. SQL query to update data into database
        $sql = "UPDATE tbl_admin SET
            full_name='$full_name',
            username='$username' 
            WHERE id=$id
        ";

        //Execute the query
        $res=mysqli_query($conn, $sql);

        //Check whether the query executed or not
        if($res==TRUE){
            //Qhery executed
            $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //Data update failed
            $_SESSION['update']="<div class='error'>Admin update failed</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

    }
?>

<?php include("partials/footer.php"); ?>