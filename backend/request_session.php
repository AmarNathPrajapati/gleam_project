<?php
    include("./config.php");
    session_start();
if($_POST['email_req_session'] && $_POST['name_req_session'] && $_POST['contact_req_session'])    
{
        $email=$_POST['email_req_session'];
        // echo $email;
        $name=$_POST['name_req_session'];
        // echo $name;
        $phone=$_POST['contact_req_session'];
        // echo $phone;
        // $email="shashikant";
        // $name="shashikant1";
        // $phone=23;
        // $stmt="INSERT INTO `callback_requests` (email) "        
        $stmt="INSERT INTO `callback_request` (email,name,contact) VALUES (?,?,?)";
        $sql = mysqli_prepare($conn, $stmt);
        mysqli_stmt_bind_param($sql, 'ssi', $email, $name, $phone);
        $result=mysqli_stmt_execute($sql);
        $student_name=$name;
        if($result)
        {
            mysqli_stmt_close($sql); 

            $stmt="SELECT name,email FROM `users` WHERE is_admin=(?)";
            $sql=mysqli_prepare($conn, $stmt);
    
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"i",$is_admin);

            $is_admin=1;
    
            $result=mysqli_stmt_execute($sql);
            if ($result) {
                $data= mysqli_stmt_get_result($sql);
                while ($row= mysqli_fetch_array($data)) {

                    $emailto=$row["email"];
                    $name=$row['name']==null?"Admin":$row['name'];
                    $mail_subject="New Session Request";
                    $mail_message="A new Session request came from a 
                    student. <br>Student details are following: <br>Name: ".$student_name." , <br>Email: ".$email." , <br>Phone: ".$phone;
                    require("./mailer_code/sendmail.php");
                }
            }
            else {
                    mysqli_close($conn);
                    echo "<script>alert('Sorry some technical issue');
                    window.location.href='../../frontend/login.php';
                    </script>";
            }
            
            ?>
            <script>alert('We will get back to you within 24 working hours');
                window.location.href='../index.php';
            </script>
        <?php } 
        else
        {
            mysqli_stmt_close($sql);
            echo mysqli_error($conn);
            ?>
            
            <script>alert('Sorry Something Went Wrong. Please try again.');
               window.location.href='../index.php';
            </script>
            <?php
        }
        
    }else{
        ?>
         <script>alert('Kindly fill all the mandatory fields.');
                    window.location.href='../index.php';
            </script>
        <?php
    }

?>