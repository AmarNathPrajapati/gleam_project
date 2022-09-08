<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up api</title>
   
</head>
<body>
<!-- <div id="loader" class="center"></div> -->
    
<?php

    include('../config.php');
    session_start();

    if ($_POST['email'] && $_POST['phone'] && $_POST['password']) {
        $stmt="SELECT id FROM `users` WHERE email=(?) and deleted_at IS NULL";
        $sql=mysqli_prepare($conn, $stmt);

        //binding the parameters to prepard statement
    
        mysqli_stmt_bind_param($sql,"s",$_POST["email"]);
        $result=mysqli_stmt_execute($sql);
        $data= mysqli_stmt_store_result($sql);
        $no_of_row=mysqli_stmt_num_rows($sql);
		
        if ($no_of_row>0){
        //   echo $no_of_row;
            mysqli_stmt_close($sql);
            echo "<script>alert('Sorry email already registered.');
            window.location.href='../../frontend/login.php';
            </script>";
        }
        else{
            mysqli_stmt_close($sql);
            $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);
            $digits=4;
            $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
            $stmt="INSERT INTO `users` (name,email,phone,password,verification_code) VALUES (?,?,?,?,?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"ssiss",$_POST['name'],$_POST['email'],$_POST['phone'],$pass,$code);
        
            $result=mysqli_stmt_execute($sql);
            if ($result) {
                // $code=uniqid('',true);
                
        
                mysqli_stmt_close($sql);
                $stmt="SELECT id,email FROM `users` WHERE email=(?) LIMIT 1";
                $sql=mysqli_prepare($conn, $stmt);
        
                //binding the parameters to prepard statement
                mysqli_stmt_bind_param($sql,"s",$_POST['email']);
        
                $result=mysqli_stmt_execute($sql);

                if ($result) {
                    $data= mysqli_stmt_get_result($sql);
                    while ($row= mysqli_fetch_array($data)) {
                    $_SESSION["student_id"]=$row["id"];
                    $_SESSION["student_email"]=$row["email"];
                    }
                    // setcookie("verification_code", $code, time() + (3600), "/");
                    $emailto=$_SESSION["student_email"];
                    $name="User";
                    $mail_subject="Successfully Account Created.";
                    $mail_message="Welcome to the family. Please Verify your email code: ".$code."  .It valid for 1 hour only.";
                    require("../mailer_code/sendmail.php");
            
                    echo "<script>
                                window.location.href='./verify_account.php';
                        </script>";
                }
                else {
                    echo mysqli_error($conn);
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                    window.location.href="../../frontend/login.php"
                    <script>';
                }
        
            } 
            
            else {
                echo mysqli_error($conn);
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="../../frontend/login.php"
                <script>';
            }
        }
    
        
    } 
    else {
        echo '<script>
        alert("Something went wrong... Please fill all the inputs.")
        windows.location.href="../../frontend/login.php"
        <script>';
    }

?>

</body>
</html>