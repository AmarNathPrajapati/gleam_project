<?php

include('../config.php');


        $stmt="INSERT INTO `application_assign` (gleam_admin_id,application_id) VALUES (?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"ii",$_POST['gleam_admin_id'],$_POST['application_id']);
       
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            // $code=uniqid('',true);
            
            mysqli_stmt_close($sql);
            $stmt="SELECT id,email,name FROM `users` WHERE id=(?) LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);
    
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"i",$_POST['gleam_admin_id']);
    
            $result=mysqli_stmt_execute($sql);

            if ($result) {
                $data= mysqli_stmt_get_result($sql);
                $row= mysqli_fetch_array($data);

                // setcookie("verification_code", $code, time() + (3600), "/");
                $emailto=$row["email"];
                $name=$row["name"];
                $mail_subject="New Application Assigned";
                $mail_message="New application has assigned to you.";
                require("../mailer_code/sendmail.php");
        
                echo '<script>
                             window.location.href="../../frontend/admin/'.$_POST['from_location'].'"
                    </script>';
			}
            else {
                echo mysqli_error($conn);
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
                 window.location.href="../../frontend/admin/'.$_POST['from_location'].'"
                <script>';
            }
    
        } 
        
        else {
            echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. ")
             window.location.href="../../frontend/admin/'.$_POST['from_location'].'"
            <script>';
        }
    


?>