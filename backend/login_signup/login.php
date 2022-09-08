<?php

include("../config.php");
session_start();
if ($_POST["email"]) {
    
            // $stmt="SELECT id,name,email,password,verified FROM `users` WHERE email=(?) AND is_admin=(?) LIMIT 1";
            $stmt="SELECT id,name,email,password,verified,is_admin FROM `users` WHERE email=(?) AND user_block=(?) AND deleted_at IS NULL LIMIT 1";
            $sql=mysqli_prepare($conn, $stmt);

            //binding the parameters to prepard statement
            $pass=$_POST["password"];
            $is_admin=0;
            $user_block=0;
            // mysqli_stmt_bind_param($sql,"si",$_POST["email"],$is_admin);
            mysqli_stmt_bind_param($sql,"si",$_POST["email"],$user_block);
            $result=mysqli_stmt_execute($sql);
            $data= mysqli_stmt_get_result($sql);
            $row=mysqli_fetch_array($data);
            if (!empty($row['id'])){
                
                // $data= mysqli_stmt_store_result($sql);
                
                        if (password_verify($pass, $row['password'])) 
                        {
                            
                            $logged=true;
                            
                           if ($row["verified"]==0) {
                                $_SESSION["student_id"]=$row["id"];
                                $_SESSION["student_email"]=$_POST['email'];
                                $_SESSION["verified"]=$row["verified"];
                                $digits=4;
                                $code=rand(pow(10, $digits-1), pow(10, $digits)-1);

                                $stmt2="SELECT created_at,updated_at FROM `users` WHERE id=(?) AND verification_code IS NOT NULL";

                                $sql2=mysqli_prepare($conn, $stmt2);
                        
                                //binding the parameters to prepard statement
                                mysqli_stmt_bind_param($sql2,"i",$row['id']);
                        
                                $result2=mysqli_stmt_execute($sql2);
                                if (!$result2) {
                                    mysqli_stmt_close($sql2);
                                    echo "<script>alert('Sorry Something Went Wrong. Please try to login.');
                                                window.location.href='../../frontend/login.php';
                                        ";
                                }
                                else{
                                    $data=mysqli_stmt_get_result($sql2);
                                    if($data->num_rows>0){
                                        while($row2=mysqli_fetch_array($data)){
                                            // $time_difference=strtotime(new DateTime()) -strtotime;
                                            if ($row2['updated_at']==null) {
                                                $time1=strtotime($row2['created_at']);
                                                $time2=strtotime(date("Y-m-d H:i:s"));
                                            } else {
                                                
                                                $time1=strtotime($row2['updated_at']);
                                                $time2=strtotime(date("Y-m-d H:i:s"));
                                            }
                                            

                                            if($time2 < $time1) {
                                                $time2 += 24 * 60 * 60;
                                            }


                                            $time_difference= $time2-$time1;
                                            $time_difference_in_hour=$time_difference/(60*60);

                                            if ($time_difference_in_hour>1) {
                                                    mysqli_stmt_close($sql2);
                                                    $stmt2="UPDATE `users` SET verification_code=? WHERE id=(?)"; //updating verification code in data base
                                                    $sql2=mysqli_prepare($conn, $stmt2);
                                            
                                                    //binding the parameters to prepard statement
                                                    mysqli_stmt_bind_param($sql2,"si",$code,$row['id']);
                                            
                                                    $result2=mysqli_stmt_execute($sql2);
                                                    if (!$result2) {
                                                        mysqli_stmt_close($sql2);
                                                        echo "<script>alert('Sorry Something Went Wrong. Please try to login.');
                                                                    window.location.href='../../frontend/login.php';
                                                            ";
                                                    }
                                                        
                                                   else{
                                                    $emailto=$_POST["email"]; 
                                                    $name="User";
                                                    $mail_subject="Please Verify your email.";
                                                    $mail_message="Please Verify Your Mail. code: ".$code." . It valid for 1 hour only.";
                                                    require("../mailer_code/sendmail.php");  // mailing to user
                    
                                                    mysqli_stmt_close($sql2);
                                                    mysqli_close($conn);
                                                    echo "<script>
                                                    window.location.href='./verify_account.php';
                                                    </script>";
                                                   }
                                            } 
                                            else {
                                                    mysqli_stmt_close($sql2);
                                                    mysqli_close($conn);
                                                    echo "<script>
                                                    alert('A code has been already shared to you please use that to verify your account');
                                                    window.location.href='./verify_account.php';
                                                    </script>";
                                            }
                                        }
                                    }
                                    else{
                                    
                                            $stmt2="UPDATE `users` SET verification_code=? WHERE id=(?)"; //updating verification code in data base
                                            $sql2=mysqli_prepare($conn, $stmt2);
                                    
                                            //binding the parameters to prepard statement
                                            mysqli_stmt_bind_param($sql2,"si",$code,$row['id']);
                                    
                                            $result2=mysqli_stmt_execute($sql2);
                                            if (!$result2) {
                                                mysqli_stmt_close($sql2);
                                                echo "<script>alert('Sorry Something Went Wrong. Please try to login.');
                                                            window.location.href='../../frontend/login.php';
                                                    ";
                                            }
                                            $emailto=$_POST["email"]; 
                                            $name="User";
                                            $mail_subject="Please Verify your email.";
                                            $mail_message="Please Verify Your Mail. code: ".$code." . It valid for 1 hour only.";
                                            require("../mailer_code/sendmail.php");  // mailing to user
            
                                            mysqli_stmt_close($sql);
                                            mysqli_close($conn);
                                            echo "<script>
                                            window.location.href='./verify_account.php';
                                            </script>";
                                     
                                    }
                                    
                                }
                               
                           } 
                           else {
                            mysqli_stmt_close($sql);
                            mysqli_close($conn);
                           
                            if ($row['is_admin']==0) { // if student
                                $_SESSION["loggedin"]=$logged;
                                $_SESSION["student_id"]=$row["id"];
                                $_SESSION["student_email"]=$row["email"];
                                $_SESSION["verified"]=$row["verified"];
                                $_SESSION["user_email"]=$_POST["email"];
                                echo "<script>
                                window.location.href='../../frontend/dashboard.php';
                                </script>";
                            } 
                            elseif ($row['is_admin']==1) { // if super admin
                                
                                $_SESSION["is_admin"]="yes";
                                $_SESSION['admin_id']=$row['id'];
                                echo "<script>alert('Successfully logged in.');
                                window.location.href='../../frontend/admin/dashboard.php';
                                </script>";
                            }
                            elseif ($row['is_admin']==2) { // if agent
                                
                                $_SESSION["is_agent"]="yes";
                                $_SESSION['agent_id']=$row['id'];
                                echo "<script>
                                  window.location.href='../../frontend/agent/dashboard.php';
                                </script>";
                            }
                            elseif ($row['is_admin']==3) { // if gleam admin

                                $_SESSION["is_gleam_admin"]="yes";
                                $_SESSION['gleam_admin_id']=$row['id'];
                                echo "<script>
                                       window.location.href='../../frontend/gleam_admin/dashboard.php';
                                 </script>";
                            } 
                            else {
                                
                                $_SESSION["loggedin"]=$logged;
                                $_SESSION["student_id"]=$row["id"];
                                $_SESSION["student_email"]=$row["email"];
                                $_SESSION["verified"]=$row["verified"];
                                $_SESSION["user_email"]=$_POST["email"];
                                echo "<script>
                                window.location.href='../../frontend/dashboard.php';
                                </script>";
                            }
                            
                                // echo "<script>
                                // window.location.href='../../frontend/dashboard.php';
                                // </script>";
                           }
                           
                        }
                        else{
                          
                            echo "<script>alert('Invalid password.');
                            window.location.href='../../frontend/login.php';
                            </script>";
                        }
            }
            else {
                
                echo "<script>alert('Sorry Email Id Not Registered.');
                window.location.href='../../frontend/login.php';
                </script>";
            }
                
} 
else {
    mysqli_close($conn);
    echo "<script>alert('Sorry something went wrong');
                    window.location.href='../../frontend/login.php';
          </script>";
}

?>