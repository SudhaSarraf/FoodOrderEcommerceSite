<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //1.Get the Data from form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2.Check whether the user with current id and current password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";
        
        //Execute the query
        $res = mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            //check whether data is avilable or not
            $count=mysqli_num_rows($res);
            
            if($count==1)
            {
                //user exist and password can be changed
                //Check whether the new and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id = $id
                    ";
                    $res2=mysqli_query($conn,$sql2);
                    //check whether the query is executed or not
                    if($res2==true)
                    {
                        //display success
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        
                        $_SESSION['change-not-pwd'] = "<div class='error'>Failed to change Password .</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else{
                //user does not exis
                $_SESSION['user-not-found'] = "<div class='error'>User not Found.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        //3. 

        //4.change password if all above is true

    }
?>

<?php include('partials/footer.php'); ?>
