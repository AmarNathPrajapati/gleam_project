<?php

include('../config.php');

if (isset($_POST["agent_name"]) && isset($_POST["agent_email"]) && isset($_POST["agent_phone"])) {
    $stmt="SELECT id FROM `users` WHERE email=(?) AND deleted_at IS NULL";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement

    mysqli_stmt_bind_param($sql,"s",$_POST["agent_email"]);
    $result=mysqli_stmt_execute($sql);
    $data= mysqli_stmt_store_result($sql);
    $no_of_row=mysqli_stmt_num_rows($sql);

    if ($no_of_row>0){
        //   echo $no_of_row;
        mysqli_stmt_close($sql);
        echo "<script>alert('Sorry email already exists.');
        window.location.href='../../frontend/admin/new_gleam_admin.php';
        </script>";
    }
    else{
        mysqli_stmt_close($sql);
        $digits=4;
        $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
        $characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $string = '';
        for ($i = 0; $i < 6; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    
        $random_password=$string."@".$code;
        $pass=password_hash($random_password, PASSWORD_DEFAULT);
        $stmt="INSERT INTO `users` (name,email,phone,password,is_admin,verified) VALUES (?,?,?,?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"ssisii",$_POST['agent_name'],$_POST['agent_email'],$_POST['agent_phone'],$pass,$is_admin,$verified);
        $is_admin=3;
        $verified=1;
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            // $code=uniqid('',true);
            
            mysqli_stmt_close($sql);
            $stmt="SELECT id,email FROM `users` WHERE email=(?) LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);
    
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"s",$_POST['agent_email']);
    
            $result=mysqli_stmt_execute($sql);

            if ($result) {
                $data= mysqli_stmt_get_result($sql);
                while ($row= mysqli_fetch_array($data)) {
                $_SESSION["gleam_admin_id"]=$row["id"];
                $_SESSION["gleam_admin_email"]=$row["email"];
                }
                // setcookie("verification_code", $code, time() + (3600), "/");
                $emailto=$_SESSION["gleam_admin_email"];
                $name=$_POST["agent_name"];
                $mail_subject="New Invitation";
                $mail_message="Congratulations!!! Your application for gleam admin at gleam education is accepted. 
                <br>
                Please use following credentials for login into Gleam Admin Portal: <br>
                Email: ".$_POST["agent_email"]."
                <br>
                Password: ".$random_password."
                <br><br>
                <a href=''http://www.gleamrecruits.com/frontend/login.php' style='color:black;'>
                <b>Click here</b>
                </a>
                to login.
                <br>
                Note: We suggest you to reset your password after login. ";
                require("../mailer_code/sendmail.php");
        
                echo "<script>
                        window.location.href='../../frontend/admin/manage_gleam_admin.php';
                    </script>";
            }
            else {
                echo mysqli_error($conn);
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="../../frontend/aadmin/new_gleam_admin.php"
                <script>';
            }
    
        } 
        
        else {
        echo mysqli_error($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
            window.location.href="../../frontend/admin/new_gleam_admin.php"
            <script>';
        }
    }  
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/admin/new_agent.php";
    </script>';   
}

?>