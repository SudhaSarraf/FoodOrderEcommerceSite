<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //1.get the id of selected admin
            $id = $_GET['id'];

            //2.Create SQL query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id = $id";

            //Execute the query
            $res=mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if($res==true)
            {
                //check whether the data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1){
                    //get the user details
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>UserName : </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="UPDATE" class="btn-secondary">
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
        //get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //create a SQL Query to update admmin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
        ";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        //check whether the query is executed or not
        if($res == true)
        {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>