<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include('../config.php');
    session_start();
   

    $stmt="UPDATE `applications_by_agents` SET status=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);
 

    // $file_lo="admin/".$fileNameNew;
    mysqli_stmt_bind_param($sql,"ii",$_POST['status'],$_POST['application_id']);

    $result=mysqli_stmt_execute($sql);
    mysqli_stmt_close($sql);
    if ($result) {
        
        if ($_POST['status']!=$_POST['old_status']) {
            
            $stmt="SELECT status_name FROM status_assumptions 
            WHERE status_number=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['status']);
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
            if ($data22->num_rows>0) {
                 $status_row=mysqli_fetch_array($data22);
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);

                echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/gleam_admin/dashboard.php";
                       <script>';
            }

            $stmt="SELECT users.name AS user_name12,users.email AS user_email,applications_by_agents.name,
            applications_by_agents.email,applications_by_agents.university_name,applications_by_agents.course_name FROM applications_by_agents INNER JOIN users 
            ON users.id=applications_by_agents.agent_id 
            WHERE applications_by_agents.id=? AND users.deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['application_id']);
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
           
            if ($data22->num_rows>0) {
                 $application_row=mysqli_fetch_array($data22);
                 mysqli_stmt_close($sql123);
         
                $emailto=$application_row["user_email"];
                $name=$application_row["user_name12"];
                $mail_subject="Application Status Update #".$_POST['application_id'];
                $mail_message="<div class='conatiner-fluid'><p class='p-0'>The application of the below student which you have submitted has 
                been updated with following Status.</p></div>".
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
                        <th>New Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><p>'.$_POST['application_id'].'</p></td>
                        <td><p>'.$application_row['name'].'</p></td>
                        <td><p>'.$application_row['university_name'].'</p></td>
                        <td><p>'.$application_row['course_name'].'</p></td>
                        <td><p>'.$status_row['status_name'].'</p></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
    
                <p>You can login to your portal for further action.</p>';
                require("../mailer_code/sendmail.php");
            }
        }

        echo '<script>
        alert("Successfully!! Updated the details.");
        window.location.href="../../frontend/gleam_admin/dashboard.php";
        </script>';

    } 
    else {
        echo "Hello";
        echo mysqli_error($conn);
        
        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon.")
        window.location.href="../../frontend/gleam_admin/dashboard.php";
        <script>';
    }

}
else{
    echo 'hello';
}

?>