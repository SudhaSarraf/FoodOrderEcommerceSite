<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login- Food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- login form starts here -->
            <form action="" method="post" class="text-center">
                Username :
                <input type="text" name="username" placeholder="Enter Username">
                <br><br>
                Password :
                <input type="password" name="password" placeholder="Enter Password">
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>

            <!-- Login form ends here -->

            <p class="text-center">Created By <a href="www.sudhasarraf.com">Sudha Sarraf</a></p>
        </div>
    </body>
</html>

<?php 

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //1. get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        //2. sql to check whether the user exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. count rows to check whether the user exist or not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $_SESSION['login'] = "<div class='sucsess text-center'>Login Success</div>";
            $_SESSION['user'] = $username; //to check whether user is login or not
            //redirect to dashboard
            header('location: '.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Login Failed, Username or Password not matched</div>";
            header('location: '.SITEURL.'admin/login.php');
        }
    }
?>

