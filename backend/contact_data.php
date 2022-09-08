<?php
    include('./config.php');
    if($_POST['email'] && $_POST['phone'] && $_POST['name'] && $_POST['country'] 
     && $_POST['course_name'] && $_POST['message'])
    {
        $email_=$_POST['email'];
        $name_=$_POST['name'];
        $phone_=$_POST['phone'];
        $country_=$_POST['country'];
        $course_name_=$_POST['course_name'];
        $message_=$_POST['message'];
        $stmt="INSERT INTO `contact_us` (email,name,phone,dream_country,dream_course_name,message) VALUES (?,?,?,?,?,?)";
        $sql = mysqli_prepare($conn, $stmt);
        mysqli_stmt_bind_param($sql, 'ssisss', $email_, $name_, $phone_,$country_,$course_name_,$message_);
        $result=mysqli_stmt_execute($sql);
        if($result)
        {
            mysqli_stmt_close($sql); 

            $stmt="SELECT name,email FROM `users` WHERE is_admin=(?)";
            $sql=mysqli_prepare($conn, $stmt);
    
            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"i",$is_admin);

            $is_admin=1;
    
              /*  $result=mysqli_stmt_execute($sql);
                if ($result) {
                    $data= mysqli_stmt_get_result($sql);
                    while ($row= mysqli_fetch_array($data)) {

                        $emailto=$row["email"];
                        $name=$row['name']==null?"Admin":$row['name'];
                        $mail_subject="New Contact Request";
                        $mail_message="A new contact request came from a 
                        student. <br>Student details are following: <br>Name: ".$name_." , 
                        <br>Email: ".$email_." , 
                        <br>Phone: ".$phone_." , <br>Dream Country: ".$country_." , <br>Dream Course Name: ".$course_name_." ,
                        <br>Message: ".$message_;
                        require("./mailer_code/sendmail.php");
                    }
                    $emailto=$email_;
                    $name=$name_==null?"User":$name_;
                    $mail_subject="Thank you for your request";
                    $mail_message="Thank you for your request. We will get back to you within 24 hours.";
                    require("./mailer_code/sendmail.php");
                }
                else {
                        mysqli_close($conn);
                        echo "<script>
                            alert('Sorry some technical issue');
                            window.location.href='../../frontend/login.php';
                        </script>";
                }*/
            
            ?>
            <script>alert('We will get back to you within 24 working hours');
                    window.location.href='../contact.php';
                    
            </script>
        <?php } 
        else
        {
            mysqli_stmt_close($sql);
            ?>
            <script>alert('Sorry Something Went Wrong. Please try again.');
               window.location.href='../contact.php';
            </script>
            <?php
        }
    }
    else{
        ?>
         <script>alert('Kindly fill all the mandatory fields.');
                    window.location.href='../contact.php';
            </script>
        <?php
    }
?>