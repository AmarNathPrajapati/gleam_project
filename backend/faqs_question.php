<?php
include('./config.php');
    if(isset($_POST['email_faq']))
    {
        $email_=$_POST['email_faq'];
        $name_=$_POST['name_faq'];
        $phone_=$_POST['contact_faq'];
        $message_=$_POST['message_faq'];
        $flag_=1;
        // echo $email_;
        // echo $name_;
        // echo $message_;
        // echo $phone_;
        // echo $flag_;
        $stmt="INSERT INTO `contact_us` (email,name,phone,message,flag) VALUES (?,?,?,?,?)";
        $sql = mysqli_prepare($conn, $stmt);
        mysqli_stmt_bind_param($sql, 'ssisi', $email_, $name_, $phone_,$message_,$flag_);
        $result=mysqli_stmt_execute($sql);
        if($result)
        {
            mysqli_stmt_close($sql); 
            $stmt="SELECT name,email FROM `users` WHERE is_admin=(?)";
            $sql=mysqli_prepare($conn, $stmt);
            mysqli_stmt_bind_param($sql,"i",$is_admin);
            $is_admin=1;
    
                $result=mysqli_stmt_execute($sql);
                if ($result) {
                    $data= mysqli_stmt_get_result($sql);
                    while ($row= mysqli_fetch_array($data)) {
                        $emailto=$row["email"];
                        $name=$row['name']==null?"Admin":$row['name'];
                        $mail_subject="New Contact Request";
                        $mail_message="A question came from a 
                        student. <br>Student details are following: <br>Name: ".$name_." , 
                        <br>Email: ".$email_." , 
                        <br>Phone: ".$phone_." , <br>Question: ".$message_;
                        require("./mailer_code/sendmail.php");

                        // $emailto=$email_;
                        // $name=$name_;
                        // $mail_subject="Gleam Education FAQ";
                        // $mail_message="Thank you for choosing us. <br>Your question will be answered within 24 hours.";
                        // require("./mailer_code/sendmail.php");
                    }
                }
                else {
                        mysqli_close($conn);
                        echo "<script>
                            alert('Sorry some technical issue');
                            window.location.href='../../frontend/login.php';
                        </script>";
                }
            
            ?>
            <script>alert('We will get back to you within 24 working hours');
                    window.location.href='../services.php';
                    
            </script>
        <?php } 
        else
        {
            mysqli_stmt_close($sql);
            ?>
            <script>alert('Sorry Something Went Wrong. Please try again.');
               window.location.href='../services.php';
            </script>
            <?php
        }
    }
?>