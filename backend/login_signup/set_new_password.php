<?php
if (isset($_POST["user_id"])) {
    include('../config.php');
   
                  
                    $stmt="UPDATE `users` SET password=? WHERE id=(?) AND deleted_at IS NULL";
                    $sql=mysqli_prepare($conn, $stmt);

                    $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);
                    //binding the parameters to prepard statement
                    mysqli_stmt_bind_param($sql,"ss",$pass,$_POST["user_id"]);

                    $result=mysqli_stmt_execute($sql);
                    if ($result) {
                      

                        mysqli_stmt_close($sql);
                        mysqli_close($conn);
                        echo "<script>alert('Successfully password updated.');
                        window.location.href='../../frontend/login.php';
                        </script>";
                       

                    }
                    else{

                        mysqli_stmt_close($sql);
                        mysqli_close($conn);
                        echo "<script>alert('Sorry!! Some technical issue.');
                        window.location.href='../../frontend/enter_mail.php';
                        </script>";
                    }
                
                
            
} else {
    echo "<script>alert('Sorry!! Some technical issue.');
    window.location.href='../../frontend/enter_mail.php';
    </script>";
}


?>
