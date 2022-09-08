<?php 
  include('../config.php');
  if ($_POST["agent_id"]) {
    $stmt="UPDATE `users` SET name=?,phone=? WHERE id=(?) AND is_admin=?";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    $is_admin=2;
    mysqli_stmt_bind_param($sql,"siii",$_POST['name'],$_POST['phone'],$_POST['agent_id'],$is_admin);

    $result=mysqli_stmt_execute($sql);
        if ($result) {
            mysqli_stmt_close($sql);
            mysqli_close($conn);
            echo "<script>alert('Successfully Updated Profile.');
                        window.location.href='../../frontend/agent/profile.php';
                        </script>";
        } else {
        echo mysqli_error($conn);
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Sorry!! Email id not registered.');
        window.location.href='../../frontend/agent/profile.php';
        </script>";
        }
    } 
    else {

        mysqli_close($conn);
        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/agent/profile.php"
        <script>';
    }
    
?>