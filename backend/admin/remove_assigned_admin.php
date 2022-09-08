<?php
  include('../config.php');
  if (isset($_POST['id'])) {
    $stmt="UPDATE `application_assign` SET deleted_at=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    $timestamp=date("Y-m-d H:i:s");
    mysqli_stmt_bind_param($sql,"si",$timestamp,$_POST['id']);



    $result=mysqli_stmt_execute($sql);
    if ($result) {
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Successfully removed.');
                    window.location.href='../../frontend/admin/".$_POST['from_location']."';
                    </script>";
        
    } 
    else {
        echo mysqli_error($conn);
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Sorry!! something went wrong.".mysqli_error($conn)."');
        window.location.href='../../frontend/admin/".$_POST['from_location']."';
        </script>";
    }
  } 
  else {
    
   if (isset($_POST['gleam_admin_id'])) {
      $stmt="UPDATE `application_assign` SET deleted_at=? WHERE gleam_admin_id=(?) AND application_id=(?)";
      $sql=mysqli_prepare($conn, $stmt);
    
      //binding the parameters to prepard statement
      $timestamp=date("Y-m-d H:i:s");
      mysqli_stmt_bind_param($sql,"sii",$timestamp,$_POST['gleam_admin_id'],$_POST['application_id']);
  
  
  
      $result=mysqli_stmt_execute($sql);
      if ($result) {
          mysqli_stmt_close($sql);
          mysqli_close($conn);
          echo "<script>alert('Successfully removed.');
                      window.location.href='../../frontend/admin/".$_POST['from_location']."';
                      </script>";
          
      } 
      else {
          echo mysqli_error($conn);
          mysqli_stmt_close($sql);
          mysqli_close($conn);
          echo "<script>alert('Sorry!! something went wrong.".mysqli_error($conn)."');
          window.location.href='../../frontend/admin/".$_POST['from_location']."';
          </script>";
      }
   }
   else {
    echo "<script>alert('Sorry!! something went wrong.');
    window.location.href='../../frontend/admin/".$_POST['from_location']."';
    </script>";
   }
   
  }
  


?>