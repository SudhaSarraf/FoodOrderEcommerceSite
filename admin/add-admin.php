<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br /><br/>

        <?php 
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display the session message if set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>


        <form action="#" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>UserName : </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    //process the value from form and save it on database

    //check whether the submit botton is clicked or not

    if(isset($_POST['submit'])){
        //bottton clicked
        // echo "clicked";

        //1. Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        //2. SQL Query to save the data into database
        $sql = " INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        

        //3. Executing Query and Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check Whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Create a session variable to Display Message
            $_SESSION['add'] = "Admin Added sucessfully";
            //Redirect Page to manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['add'] = "Failed to add Admin";
            //Redirect Page to manage Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
   
?>