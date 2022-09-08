<?php

       if ($_POST['from_user']) {
        include('../config.php');

       
        $stmt="INSERT INTO `chat_table` (from_user,to_user,application_id,message) VALUES (?,?,?,?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"iiis",$_POST['from_user'],$_POST['to_user'],$_POST['application_id'],$_POST['message']);
        // $is_admin=2;
    
        $result=mysqli_stmt_execute($sql);

        if ($result) {
            $stmt="SELECT name,university_name,course_name FROM applications_by_agents WHERE id=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['application_id']);
           
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                while($student_row=mysqli_fetch_array($data22)){
                    $student_name=$student_row['name'];
                    $university_name=$student_row['university_name'];
                    $course_name=$student_row['course_name'];

                 }
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }

           if (isset($_POST['is_this_agent'])) {
            // agent details
            $stmt="SELECT name,email FROM users WHERE id=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['from_user']);
           
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                while($user_row=mysqli_fetch_array($data22)){
                    $agent_name=$user_row['name'];
                    $agent_email=$user_row['email'];
                 }
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }
            // admin details
            $stmt="SELECT name,email FROM users WHERE is_admin=? AND deleted_at IS NULL";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$is_admin);
            $is_admin=1;
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                while($user_row=mysqli_fetch_array($data22)){
                    $emailto=$user_row["email"];
                    $name=$user_row["name"];
                    $mail_subject="You got a new message regarding application id #".$_POST['application_id'];
                    $mail_message="<div class='conatiner-fluid'><p class='p-0'>New message from agent ".$agent_name.".</p></div>".
                    "<br>".
                    "<br>".
                    '<div class="conatiner-fluid">
                        <div class="row">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>CAMS ID</th>
                            <th>Student Name</th>
                            <th>University Name</th>
                            <th>Course Name</th>
                            <th>New Message</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><p>'.$_POST['application_id'].'</p></td>
                            <td><p>'.$student_name.'</p></td>
                            <td><p>'.$university_name.'</p></td>
                            <td><p>'.$course_name.'</p></td>
                            <td><p>'.$_POST['message'].'</p></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>'
                    . "<p>
                    <a class='reply-btn' href='http://www.gleamrecruits.com/frontend/admin/chat.php?application_id=".$_POST['application_id']."'>
                    <b>Reply</b></a></p>";
                    // $mail_message="New Message from ".$agent_name
                    // ."<br>".
                    // "  message: ".$_POST['message']
                    // ."<br>".
                    // "<br>".
                    // "<br>".
                    // "<a class='reply-btn' href='http://www.gleamrecruits.com/frontend/admin/chat.php?application_id=".$_POST['application_id']."'><b>Reply</b></a>";
                    require("../mailer_code/sendmail.php");
                 }
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }
            // gleam admin details
            $stmt="SELECT name,email FROM users WHERE is_admin=? AND deleted_at IS NULL";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$is_admin);
            $is_admin=3;
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                 while($user_row=mysqli_fetch_array($data22)){
                    $emailto=$user_row["email"];
                    $name=$user_row["name"];
                    $mail_subject="You got a new message regarding application id #".$_POST['application_id'];
                    $mail_message="<div class='conatiner-fluid'><p class='p-0'>New message from agent ".$agent_name.".</p></div>".
                    "<br>".
                    "<br>".
                    '<div class="conatiner-fluid">
                        <div class="row">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>CAMS ID</th>
                            <th>Student Name</th>
                            <th>University Name</th>
                            <th>Course Name</th>
                            <th>New Message</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><p>'.$_POST['application_id'].'</p></td>
                            <td><p>'.$student_name.'</p></td>
                            <td><p>'.$university_name.'</p></td>
                            <td><p>'.$course_name.'</p></td>
                            <td><p>'.$_POST['message'].'</p></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>'
                    . "<p>
                    <a class='reply-btn' href='http://www.gleamrecruits.com/frontend/gleam_admin/chat.php?application_id=".$_POST['application_id']."'>
                    <b>Reply</b></a></p>";


                    // $mail_subject="New message from Agent";
                    // $mail_message="New Message from ".$agent_name
                    // ."<br>".
                    // "  message: ".$_POST['message']
                    // ."<br>".
                    // "<br>".
                    // "<br>".
                    // "<a style='background-color: blue; color:white; padding:8px; margin-top:10px'
                    //  href='http://www.gleamrecruits.com/frontend/gleam_admin/chat.php?application_id=".$_POST['application_id']."'><b>Reply</b></a>";


                    require("../mailer_code/sendmail.php");
                 }
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }


            http_response_code(200);
            $response = array(
                "message" => "Success",
            );
            echo json_encode($response);

           }
           else{

            $stmt="SELECT name,email FROM users WHERE id=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['to_user']);
           
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                while($user_row=mysqli_fetch_array($data22)){
                    $agent_name=$user_row['name'];
                    $agent_email=$user_row['email'];
                 }
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }
            $emailto=$agent_email;
            $name=$agent_name;
            $mail_subject="New message from Gleam Team";
            $mail_message="New Message Gleam Team"
            ."<br>".
            "  message: ".$_POST['message']
            ."<br>".
            "<br>".
            "<br>".
            "<a style='background-color: blue; color:white; padding:8px; margin-top:10px' 
            href='http://www.gleamrecruits.com/frontend/agent/chat.php?application_id=".$_POST['application_id']."'><b>Reply</b></a>";

            $mail_subject="You got a new message regarding application id #".$_POST['application_id'];
            $mail_message="<div class='conatiner-fluid'><p class='p-0'>New message from Gleam Team.</p></div>".
            "<br>".
            "<br>".
            '<div class="conatiner-fluid">
                <div class="row">
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>CAMS ID</th>
                    <th>Student Name</th>
                    <th>University Name</th>
                    <th>Course Name</th>
                    <th>New Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><p>'.$_POST['application_id'].'</p></td>
                    <td><p>'.$student_name.'</p></td>
                    <td><p>'.$university_name.'</p></td>
                    <td><p>'.$course_name.'</p></td>
                    <td><p>'.$_POST['message'].'</p></td>
                  </tr>
                </tbody>
              </table>
            </div>'
            . "<p>
            <a class='reply-btn' href='http://www.gleamrecruits.com/frontend/agent/chat.php?application_id=".$_POST['application_id']."'>
            <b>Reply</b></a></p>";
            require("../mailer_code/sendmail.php");

            http_response_code(200);
            $response = array(
                "message" => "Success",
            );
            echo json_encode($response);

           } 
    
        } 
        
        else {
            
            http_response_code(500);
            $response = array(
                "message" =>mysqli_error($conn),
            );
            echo json_encode($response);
        }
       } 
       else{
        http_response_code(500);
        $response = array(
            "message" =>mysqli_error($conn),
        );
        echo json_encode($response);
       }


?>