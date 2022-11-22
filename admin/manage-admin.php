<?php include('partials/menu.php'); ?>

        <!-- Main Content section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];//adding session variable
                        unset($_SESSION['add']);//removing session variable
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];//adding session variable
                        unset($_SESSION['delete']);//removing session variable
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];//adding session variable
                        unset($_SESSION['update']);//removing session variable
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];//adding session variable
                        unset($_SESSION['user-not-found']);//removing session variable
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];//adding session variable
                        unset($_SESSION['pwd-not-match']);//removing session variable
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];//adding session variable
                        unset($_SESSION['change-pwd']);//removing session variable
                    }

                    // if(isset($_SESSION['change-not-pwd']))
                    // {
                    //     echo $_SESSION['change-not-pwd'];//adding session variable
                    //     unset($_SESSION['change-not-pwd']);//removing session variable
                    // }
                ?>
                <br /><br /><br />

                <!-- Button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                        //Query to Get all Admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is Executed or not
                        if($res==TRUE)
                        {
                            //Count Rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res);

                            $sn=1; //Create a variable and assign its value

                            //check the num of rows
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Get indivisual data from database
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    //Display the value in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">UPDATE</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">DELETE</a>
                                        </td>
                                    </tr>

                                    <?php
                                }

                            }
                            else
                            {
                                //We do not have Data in Dataaseb
                            }
                        }
                    ?>    


                </table>
            </div>
        </div>
        <!-- Main Content section Ends -->

<?php include('partials/footer.php'); ?>        