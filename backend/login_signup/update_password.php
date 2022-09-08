<?php 
  include('../config.php');
    if ($_POST["email"] && $_POST["new_password"]) {
        $pass=$_POST['new_password'];
        $stmt="UPDATE `users` SET password=? WHERE email=(?) AND deleted_at IS NULL";
        $sql=mysqli_prepare($conn, $stmt);

        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"ss",$pass,$_POST['email']);

        $result=mysqli_stmt_execute($sql);
        if ($result) {
            echo "<script>alert('Successfully password changed.');
                        window.location.href='../../frontend/login.php';
                        </script>";
        } 
        else {
        echo mysqli_error($conn);

        echo "<script>alert('Sorry!! Email id not registered.');
        window.location.href='../../frontend/login.php';
        </script>";
        }
    } 
    else {
        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/login.php"
        <script>';
    }
    

?>