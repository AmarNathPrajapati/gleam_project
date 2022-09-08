<?php
if (isset($_POST["email"])) {
    include('../config.php');
    $stmt="SELECT id FROM `users` WHERE email=(?) AND deleted_at IS NULL";
            $sql=mysqli_prepare($conn, $stmt);

            //binding the parameters to prepard statement

            mysqli_stmt_bind_param($sql,"s",$_POST["email"]);

            $result=mysqli_stmt_execute($sql);

            if ($result) {
                mysqli_stmt_store_result($sql);
                if (mysqli_stmt_num_rows($sql)==0) {
                    mysqli_stmt_close($sql); 
                    mysqli_close($conn);
                    echo "<script>alert('Sorry!! Email id not registered.');
                    window.location.href='../../frontend/login.php';
                    </script>";
                    
                } 
                // already exist
                else {
                    $digits=4;
                    $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
                    $stmt="UPDATE `users` SET forgot_token=? WHERE email=(?)";
                    $sql=mysqli_prepare($conn, $stmt);

                    //binding the parameters to prepard statement
                    mysqli_stmt_bind_param($sql,"ss",$code,$_POST["email"]);

                    $result=mysqli_stmt_execute($sql);
                    if ($result) {
                        $emailto=$_POST["email"];
                        $name="User";
                        $mail_subject="Password Reset";
                        $mail_message="Please use this code to reset your password. code: ".$code;
                        require("../mailer_code/sendmail.php");

                        mysqli_stmt_close($sql);
                        mysqli_close($conn);
                        echo "<script>alert('A code is sended on your email.');
                        window.location.href='../../frontend/check_token.php';
                        </script>";
                       

                    }
                    else{

                        mysqli_stmt_close($sql);
                        mysqli_close($conn);
                        echo "<script>alert('Sorry!! Some technical issue.');
                        window.location.href='../../frontend/enter_mail.php';
                        </script>";
                    }
                }
                
            }
} else {
    # code...
}


?>
