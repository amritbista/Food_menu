<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>

        <?php
            $id=$_GET['id'];

            
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="current_password" placeholder="Current Password">
                </tr>
                <tr>
                    <td>New Password</td>
                     <td><input type="password" name="new_password" placeholder="New Password"> </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"> </td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value=<?php echo $id; ?> > </td>
                    <td><input type="submit" name="submit" value="confirm_password" class="btn-secondary"> </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
    //Check whether the submit button is entered
    if(isset($_POST['submit'])){
        
        //1. Get data from the form
        $id= $_POST['id'];
        $current_password= md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2. Check whether the user with current username and password exists or not
        //Seclect from databasae
        $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";

        //Execute the query
        $res= mysqli_query($conn, $sql);

        if($res==TRUE){
            $count= mysqli_num_rows($res);
            if($count==1){
                //echo "user found";
                //Check whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //echo "Password match";
                    //Update password
                    $sql2= "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                    ";
                    //Execute the query
                    $res2= mysqli_query($conn,$sql2);

                    //Check the query
                    if($res2==TRUE)
                    {
                        //Display success message
                        $_SESSION['change-pwd']="<div class='sucess'>Password change successful</div>";
                        header('location:'.SITEURL.'admin\manage-admin.php');
                    }
                    else
                    {
                        //Display error message
                        $_SESSION['change-pwd']="<div class='error'>Password not changed</div>";
                        header('location:'.SITEURL.'admin\manage-admin.php');
                    }

                }
                else{
                    //Redirect to manage-admin page with error message
                    $_SESSION['pwd-not-match']="<div class='error'>Password not matched</div>";
                    header('location:'.SITEURL.'admin\manage-admin.php');
                }
            }
            else{
                //User not exist
                $_SESSION['user-not-found']="<div class='error'>User not Found </div>";
                //redirect to manage-admin page
                header('location:'.SITEURL.'admin\manage-admin.php');
            }
        }

        
    }

?>

<?php include('partials/footer.php'); ?>