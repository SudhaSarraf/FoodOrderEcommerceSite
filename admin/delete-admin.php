<?php

    include('../config/constants.php'); 

    //1. get the ID of admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn,$sql);
    
    //check whether the query is executed or not
    if($res==TRUE)
    {
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. Redirect to Manage Admin page with message(sucess/error)
?>