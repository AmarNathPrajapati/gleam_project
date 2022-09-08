<?php 
    function makeUrltoLink($string) {
    // The Regular Expression filter
    $reg_pattern = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";

    // make the urls to hyperlinks
    return preg_replace($reg_pattern, '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $string);
}
?><?php 
    include("../../backend/config.php");
    session_start();
    if (!isset($_SESSION["is_agent"])) {
        header("location: ../login.php");
    }
    else{
        $stmt="SELECT status_assumptions.status_name,status_assumptions.status_number,countries.country_name ,applications_by_agents.* FROM applications_by_agents 
         INNER JOIN countries ON applications_by_agents.country_id=countries.id 
         INNER JOIN status_assumptions ON status_assumptions.status_number=applications_by_agents.status
          WHERE applications_by_agents.id=(?) AND applications_by_agents.deleted_at IS NULL LIMIT 1";
        $sql=mysqli_prepare($conn, $stmt);

        //binding the parameters to prepard statement

        $is_admin=1;
        
        mysqli_stmt_bind_param($sql,"i",$_GET["application_id"]);
        $result=mysqli_stmt_execute($sql);

        if ($result){
            $data= mysqli_stmt_get_result($sql);
           
            if ($data->num_rows>0) {
                # code...
               $row=mysqli_fetch_array($data);
               mysqli_stmt_close($sql);
               $application_id123=$row['id'];
               $agent_id123=$row['agent_id'];
               
               $stmt="SELECT id,country_name FROM countries WHERE deleted_at IS NULL";
               $sql=mysqli_prepare($conn, $stmt);
        
               $result=mysqli_stmt_execute($sql);
               $data= mysqli_stmt_get_result($sql);
       
               if (!$result){
                  
                 echo '<script>
                    alert("Sorry something went wrong.");
                    window.location.href = "./dashboard.php";
                </script>';
               }
            //    else{
            //        $countries=mysqli_fetch_array($data);
            //    }
            }
            
        }
        else{

?>
<script>
    alert("Sorry something went wrong.");
    window.location.href = "./dashboard.php";
</script>
<?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./agent_components/header_links.php'); ?>

    <title>View Application</title>


    <style>
        .view_box {
            max-width: 100%;
            min-height: 100px;
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px;
            background-color: #fcfcfe;
            background-image: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5)), url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='260' height='260' viewBox='0 0 260 260'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23dddddd' fill-opacity='0.4'%3E%3Cpath d='M24.37 16c.2.65.39 1.32.54 2H21.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06A5 5 0 0 1-17.45 28v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H-20a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1L.9 19.22a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0L2.26 23h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM-13.82 27l16.37 4.91L18.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H-13.1z'/%3E%3Cpath id='path6_fill-copy' d='M284.37 16c.2.65.39 1.32.54 2H281.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06a5 5 0 0 1-2.24-8.94v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H240a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM246.18 27l16.37 4.91L278.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H246.9z'/%3E%3Cpath d='M159.5 21.02A9 9 0 0 0 151 15h-42a9 9 0 0 0-8.5 6.02 6 6 0 0 0 .02 11.96A8.99 8.99 0 0 0 109 45h42a9 9 0 0 0 8.48-12.02 6 6 0 0 0 .02-11.96zM151 17h-42a7 7 0 0 0-6.33 4h54.66a7 7 0 0 0-6.33-4zm-9.34 26a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-7a7 7 0 1 1 0-14h42a7 7 0 1 1 0 14h-9.34zM109 27a9 9 0 0 0-7.48 4H101a4 4 0 1 1 0-8h58a4 4 0 0 1 0 8h-.52a9 9 0 0 0-7.48-4h-42z'/%3E%3Cpath d='M39 115a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm6-8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-3-29v-2h8v-6H40a4 4 0 0 0-4 4v10H22l-1.33 4-.67 2h2.19L26 130h26l3.81-40H58l-.67-2L56 84H42v-6zm-4-4v10h2V74h8v-2h-8a2 2 0 0 0-2 2zm2 12h14.56l.67 2H22.77l.67-2H40zm13.8 4H24.2l3.62 38h22.36l3.62-38z'/%3E%3Cpath d='M129 92h-6v4h-6v4h-6v14h-3l.24 2 3.76 32h36l3.76-32 .24-2h-3v-14h-6v-4h-6v-4h-8zm18 22v-12h-4v4h3v8h1zm-3 0v-6h-4v6h4zm-6 6v-16h-4v19.17c1.6-.7 2.97-1.8 4-3.17zm-6 3.8V100h-4v23.8a10.04 10.04 0 0 0 4 0zm-6-.63V104h-4v16a10.04 10.04 0 0 0 4 3.17zm-6-9.17v-6h-4v6h4zm-6 0v-8h3v-4h-4v12h1zm27-12v-4h-4v4h3v4h1v-4zm-6 0v-8h-4v4h3v4h1zm-6-4v-4h-4v8h1v-4h3zm-6 4v-4h-4v8h1v-4h3zm7 24a12 12 0 0 0 11.83-10h7.92l-3.53 30h-32.44l-3.53-30h7.92A12 12 0 0 0 130 126z'/%3E%3Cpath d='M212 86v2h-4v-2h4zm4 0h-2v2h2v-2zm-20 0v.1a5 5 0 0 0-.56 9.65l.06.25 1.12 4.48a2 2 0 0 0 1.94 1.52h.01l7.02 24.55a2 2 0 0 0 1.92 1.45h4.98a2 2 0 0 0 1.92-1.45l7.02-24.55a2 2 0 0 0 1.95-1.52L224.5 96l.06-.25a5 5 0 0 0-.56-9.65V86a14 14 0 0 0-28 0zm4 0h6v2h-9a3 3 0 1 0 0 6H223a3 3 0 1 0 0-6H220v-2h2a12 12 0 1 0-24 0h2zm-1.44 14l-1-4h24.88l-1 4h-22.88zm8.95 26l-6.86-24h18.7l-6.86 24h-4.98zM150 242a22 22 0 1 0 0-44 22 22 0 0 0 0 44zm24-22a24 24 0 1 1-48 0 24 24 0 0 1 48 0zm-28.38 17.73l2.04-.87a6 6 0 0 1 4.68 0l2.04.87a2 2 0 0 0 2.5-.82l1.14-1.9a6 6 0 0 1 3.79-2.75l2.15-.5a2 2 0 0 0 1.54-2.12l-.19-2.2a6 6 0 0 1 1.45-4.46l1.45-1.67a2 2 0 0 0 0-2.62l-1.45-1.67a6 6 0 0 1-1.45-4.46l.2-2.2a2 2 0 0 0-1.55-2.13l-2.15-.5a6 6 0 0 1-3.8-2.75l-1.13-1.9a2 2 0 0 0-2.5-.8l-2.04.86a6 6 0 0 1-4.68 0l-2.04-.87a2 2 0 0 0-2.5.82l-1.14 1.9a6 6 0 0 1-3.79 2.75l-2.15.5a2 2 0 0 0-1.54 2.12l.19 2.2a6 6 0 0 1-1.45 4.46l-1.45 1.67a2 2 0 0 0 0 2.62l1.45 1.67a6 6 0 0 1 1.45 4.46l-.2 2.2a2 2 0 0 0 1.55 2.13l2.15.5a6 6 0 0 1 3.8 2.75l1.13 1.9a2 2 0 0 0 2.5.8zm2.82.97a4 4 0 0 1 3.12 0l2.04.87a4 4 0 0 0 4.99-1.62l1.14-1.9a4 4 0 0 1 2.53-1.84l2.15-.5a4 4 0 0 0 3.09-4.24l-.2-2.2a4 4 0 0 1 .97-2.98l1.45-1.67a4 4 0 0 0 0-5.24l-1.45-1.67a4 4 0 0 1-.97-2.97l.2-2.2a4 4 0 0 0-3.09-4.25l-2.15-.5a4 4 0 0 1-2.53-1.84l-1.14-1.9a4 4 0 0 0-5-1.62l-2.03.87a4 4 0 0 1-3.12 0l-2.04-.87a4 4 0 0 0-4.99 1.62l-1.14 1.9a4 4 0 0 1-2.53 1.84l-2.15.5a4 4 0 0 0-3.09 4.24l.2 2.2a4 4 0 0 1-.97 2.98l-1.45 1.67a4 4 0 0 0 0 5.24l1.45 1.67a4 4 0 0 1 .97 2.97l-.2 2.2a4 4 0 0 0 3.09 4.25l2.15.5a4 4 0 0 1 2.53 1.84l1.14 1.9a4 4 0 0 0 5 1.62l2.03-.87zM152 207a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-11 1a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-6 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3-5a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-8 8a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm0 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4 7a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5-2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-5-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-24 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm16 5a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm7-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0zm86-29a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1 246 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM275 214a29 29 0 0 0-57.97 0h57.96zM72.33 198.12c-.21-.32-.34-.7-.34-1.12v-12h-2v12a4.01 4.01 0 0 0 7.09 2.54c.57-.69.91-1.57.91-2.54v-12h-2v12a1.99 1.99 0 0 1-2 2 2 2 0 0 1-1.66-.88zM75 176c.38 0 .74-.04 1.1-.12a4 4 0 0 0 6.19 2.4A13.94 13.94 0 0 1 84 185v24a6 6 0 0 1-6 6h-3v9a5 5 0 1 1-10 0v-9h-3a6 6 0 0 1-6-6v-24a14 14 0 0 1 14-14 5 5 0 0 0 5 5zm-17 15v12a1.99 1.99 0 0 0 1.22 1.84 2 2 0 0 0 2.44-.72c.21-.32.34-.7.34-1.12v-12h2v12a3.98 3.98 0 0 1-5.35 3.77 3.98 3.98 0 0 1-.65-.3V209a4 4 0 0 0 4 4h16a4 4 0 0 0 4-4v-24c.01-1.53-.23-2.88-.72-4.17-.43.1-.87.16-1.28.17a6 6 0 0 1-5.2-3 7 7 0 0 1-6.47-4.88A12 12 0 0 0 58 185v6zm9 24v9a3 3 0 1 0 6 0v-9h-6z'/%3E%3Cpath d='M-17 191a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2H4zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1-14 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM15 214a29 29 0 0 0-57.97 0h57.96z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .leftMessage {
            border-radius: 0px 10px 10px 10px;
            border: 1px solid black;
            background-color: #EDEFF3;
            padding: 5px;
            float: left;
            clear: both;
            text-align: start;
            max-width: 90%;
            margin-bottom: 10px;

        }

        .rightMessage { 
            border-radius: 10px 0px 10px 10px;
            border: 1px solid black;
            background-color: #05B4A9;
            padding: 5px;
            color: white;
            float: right;
            clear: both;
            text-align: end;
            max-width: 90%;
            margin-bottom: 10px;
        }

        .time {
            font-size: 12px;
        }
        .textWhite{
            color: white;
        }
        .textDark{
            color: black;
        }
        .sender_name{
            font-size: 12px;
        }
        .rightMessage  a{
            color: white;
            font-weight: 600;
        }
    </style>
    
</head>

<body>

    <div id="loader" class="center"></div>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <?php require('./agent_components/side_bar.php'); ?>


        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-8 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-3">Application Details</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-4 text-sm-end">
                                <div class="mx-n1">
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->


                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <div class="container-fluid p-sm-5 my-5" style="font-size: 22px;">
                                <form id="update_form" action="../../backend/agent/application_update.php"
                                    onsubmit="return submitform()" method="post" enctype="multipart/form-data">

                                    <input type="number" hidden name="application_id" value="<?php echo $row['id']?>">

                                    <input type="text" hidden name="new_document">
                                    <input type="text" hidden name="updated_document">
                                    <input type="text" hidden name="deleted_document">

                                    <div class="row mb-4 d-none">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Applicatin Id:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly name="application_id" value="<?php echo $row["id"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Name:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly required name="name" value="<?php echo $row["name"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Email:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" style="width: 100%;" readonly required name="email" value="<?php echo $row["email"];?>">
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Phone:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly required name="phone"  value="<?php echo $row["phone"];?>">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Country:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" id="showcountry" name="showcountry" readonly
                                                value="<?php echo $row["country_name"];?>">
                                            <select name="country" id="country" hidden>
                                                <?php
                                                  if ($data->num_rows>0) {
                                                    # code...
                                                   while( $country_row=mysqli_fetch_array($data)){
                                                   ?>
                                                <option <?php echo
                                                    $row["country_id"]==$country_row['id']?"selected":"";?>
                                                    value="
                                                    <?php echo $country_row['id']; ?>">
                                                    <?php echo $country_row['country_name']; ?>
                                                </option>
                                                <?php
                                                    
                                                    }
                                                    mysqli_stmt_close($sql);
                                                }  
                                                else{
                                                    mysqli_stmt_close($sql);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Uiversity:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly required name="university_name"
                                                value="<?php echo $row["university_name"];?>">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Course Name:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" class="form-control" readonly required name="course_name"
                                                value="<?php echo $row["course_name"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Intake:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" class="form-control" readonly required name="intake"
                                                value="<?php echo $row["intake"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Status:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                        <!-- <input type="number" hidden id="old_status" name="old_status" readonly
                                                value="<?php echo $row["status_number"];?>"> -->
                                            <input type="text" class="form-control" id="showstatus" name="showstatus" readonly
                                                value="<?php echo $row["status_name"];?>">
                                            <!-- <select name="status" id="status" required hidden>
                                                <?php
                                                    $stmt="SELECT status_number,status_name FROM status_assumptions WHERE deleted_at IS NULL";
                                                    $sql123=mysqli_prepare($conn, $stmt);
                                            
                                                    $result=mysqli_stmt_execute($sql123);
                                                    $data22= mysqli_stmt_get_result($sql123);
                                                    if ($data22->num_rows>0) {
                                                    # code...
                                                    while( $status_row=mysqli_fetch_array($data22)){
                                                    ?>
                                                    <option <?php echo $row["status_number"]==$status_row['status_number']?"selected":"";?>
                                                        value="<?php echo $status_row['status_number']; ?>">
                                                        <?php echo $status_row['status_name']; ?>
                                                    </option>
                                                <?php
                                                    
                                                    }
                                                    mysqli_stmt_close($sql123);
                                                }  
                                                else{
                                                    mysqli_stmt_close($sql123);
                                                }
                                                ?>
                                            </select> -->
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Documents:
                                        </div>
                                        <br>
                                        <div class="col-12" id="moredocument">
                                            <?php 
                                        
                                         $stmt="SELECT id,document_name,document_location 
                                         FROM application_documents WHERE deleted_at IS NULL AND application_id=(?)";
                                         $sql=mysqli_prepare($conn, $stmt);
                                  
                                         mysqli_stmt_bind_param($sql,'i',$row['id']);
                                         $result=mysqli_stmt_execute($sql);
                                         if ($result) {

                                            $data= mysqli_stmt_get_result($sql);
                                            if ($data->num_rows>0) {
                                                while($row2=mysqli_fetch_array($data)){
                                                    ?>

                                            <div id="<?php echo $row2['id']; ?>">
                                                <input type="number" hidden name="doc_id[]" readonly
                                                    value="<?php echo $row2['id']; ?>">
                                                <input type="text" name="document_location[]" hidden
                                                    value="<?php echo $row2['document_location'];?>">
                                                <input type="text" class="form-control mb-3"
                                                    oninput="update(<?php echo $row2['id']; ?>)" required
                                                    name="doc_name[]" readonly
                                                    value="<?php echo $row2['document_name']; ?>">
                                                <a class="btn btn-neutral mb-3 text-primary" name="doc_download[]"
                                                    href="<?php echo '../../documents/agent/'.$row2['document_location'];?>">
                                                    Download <i class="bi bi-download"></i></a>

                                                <input type="file" oninput="update(<?php echo $row2['id']; ?>)"
                                                    accept=".pdf,.png,.docs,.docx,.jpeg,.jpg" class="form-control mb-3"
                                                    name="document[]" hidden>

                                                <button type="button" class="btn btn-neutral text-danger p-2 mb-2"
                                                    name="deletebtn[]" hidden
                                                    onclick="delete_div(<?php echo $row2['id']; ?>)"><i
                                                        class="bi bi-trash-fill"></i> Remove</button>
                                            </div>

                                            <?php
                                                        }
                                                    } 
                                                    else {
                                                        echo "No Document Available";
                                                    }
                                                    
                                                } else {
                                                    echo "Query Error";
                                                }
                                                
                                                ?>
                                        </div>
                                        <div class="col-12" hidden>
                                            <!-- <input type="file"  accept=".pdf,.docs,.docx,.png,.jpg,.jpeg" required class="form-control my-4" 
                                            name="document[]"> -->
                                        </div>
                                    </div>
                                    <button type="button" id="addbtn" hidden onclick="add_more()"
                                        class="btn btn-neutral text-primary p-2 mb-4">Add More</button>



                                    <div class="row mb-3">
                                        <button <?php echo $row['status']==2?'disabled':''?> class="btn btn-neutral col-auto text-danger <?php echo $row['status']==2?'d-none':''?>" onclick="make_editable()"
                                            type="button" id="editbtn">Edit Details</button>
                                        <button class="btn btn-neutral col-auto text-success" type="submit"
                                            id="updatebtn" style="margin-right: 10px;" hidden>Update</button>
                                        <button class="btn btn-neutral col-auto text-warning"
                                            onclick="make_uneditable()" type="button" id="cancelbtn"
                                            hidden>Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <div class="container-fluid">
                                <p class="mb-2">Activity:</p>
                                <div class="view_box border-1 mb-3" >

                                    <?php 
                                        mysqli_stmt_close($sql);

                                        $stmt="SELECT users.name,chat_table.* FROM chat_table LEFT JOIN users ON 'users.id'='chat_table.from_user'
                                        WHERE chat_table.application_id=(?) AND chat_table.deleted_at IS NULL ORDER BY chat_table.created_at";
                                        $sql=mysqli_prepare($conn, $stmt);
                                
                                        //binding the parameters to prepard statement
                                
                                        
                                        mysqli_stmt_bind_param($sql,"i",$application_id123);

                                        
                                        $agent_id456=$agent_id123;
                                        $application_id456=$_SESSION['agent_id'];

                                        $result=mysqli_stmt_execute($sql);
                                        
                                        if($result==false){
                                            echo mysqli_error($conn);
                                        }

                                        $data=mysqli_stmt_get_result($sql);
                                        if($data->num_rows==0){
                                            ?>
                                            <p class="text-center mt-2" id="defaltMessage">Nothing To Show</p>
                                            <?php

                                        }
                                        else{

                                            while($row=mysqli_fetch_array($data)){
                                                ?>
                                                <div name="<?php echo $row['from_user']==$_SESSION['agent_id']?'rightMessage':'leftMessage'?>" 
                                                    class="<?php echo $row['from_user']==$_SESSION['agent_id']?'rightMessage':'leftMessage'?>">
                                                    <h6  class="<?php echo $row['from_user']==$_SESSION['agent_id']?'textWhite':'textDark'?> sender_name"><?php  
                                                        if($row['from_user']!=$_SESSION['agent_id']){
                                                            echo 'By Gleam Team';
                                                        }
                                                        // else{
                                                        //     echo 'By You';
                                                        // }
                                                     ?></h6>
                                                       <p class="message"><?php echo makeUrltoLink($row['message']); ?></p>
                                                    <p class="time"><?php echo $row['created_at']; ?></p>
                                               </div>
                                                
                                                <?php
                                            }
                                            mysqli_stmt_close($sql);
                                        }
                                    
                                    ?>
                                  
                                </div>
                                <div class="send_box">
                                    <form action="#">
                                        <input type="number" hidden name="application_id123" value="<?php echo $application_id123; ?>">
                                        <input type="number" hidden name="is_this_agent" value="<?php echo 0; ?>">
                                        <input type="number" hidden name="agent_id123" value="<?php echo $agent_id123; ?>">
                                        <input type="number" hidden name="admin_id123" value="<?php echo $_SESSION['admin_id']; ?>">
                                        <textarea class="form-control" maxlength="250" name="message_box" id="message_box" rows="2" placeholder="Type message..."></textarea>
                                        <button type="button" class="btn btn-outline-primary mt-2 p-2" onclick="sendMessage()">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        var new_document_count = 1;
        var delete_document_count = 1;
        var new_document = [];
        var updated_document = [];
        var deleted_document = [];

        function update(a) {
            var count = true;
            updated_document.forEach(element => {
                if (element == a) {
                    count = false;
                    return;
                }
            });
            if (count == true) {
                updated_document.push(a);
            }
            console.log(updated_document);
        }

        function add_more() {
            // console.log("hell0");
            var new_div = document.createElement('div');
            new_div.id = new_document_count;
            document.getElementById('moredocument').append(new_div);


            var input_new2 = document.createElement('input');
            input_new2.type = "file";
            input_new2.name = "document[]";
            input_new2.accept = '.pdf,.docs,.docx,.png,.jpg,.jpeg';
            input_new2.setAttribute('required', 'required');
            input_new2.classList.add('form-control');
            input_new2.classList.add('my-4');

            var input_new = document.createElement('input');
            input_new.type = "text";
            input_new.name = "doc_name[]";
            input_new.placeholder = "Document Name";
            input_new.setAttribute('required', 'required');
            input_new.classList.add('form-control');
            input_new.classList.add('my-2');

            var input_new3 = document.createElement('input');
            input_new3.type = "button";
            input_new3.name = "button[]";
            input_new3.placeholder = "Document File";
            input_new3.setAttribute('required', 'required');
            input_new3.setAttribute('hidden', 'hidden');
            input_new3.classList.add('form-control');
            input_new3.classList.add('my-2');

            var input_new4 = document.createElement('input');
            input_new4.type = "number";
            input_new4.name = "doc_id[]";
            input_new4.placeholder = "Document id";
            input_new4.value = new_document_count;
            // input_new4.value = new_document_count;
            input_new4.setAttribute('required', 'required');
            input_new4.setAttribute('hidden', 'hidden');
            input_new4.classList.add('form-control');
            input_new4.classList.add('my-2');


            var new_button = document.createElement('button');
            new_button.type = 'button';
            new_button.classList.add('btn');
            new_button.classList.add('btn-neutral');
            new_button.classList.add('text-danger');
            new_button.classList.add('p-2');
            new_button.setAttribute('onclick', 'delete_div(' + new_document_count + ')');




            new_button.innerHTML = '<i class="bi bi-trash-fill"></i> Remove';
            document.getElementById(new_document_count).append(input_new);
            document.getElementById(new_document_count).append(input_new2);
            document.getElementById(new_document_count).append(input_new3);
            document.getElementById(new_document_count).append(input_new4);
            document.getElementById(new_document_count).append(new_button);

            new_document.push(new_document_count);

            new_document_count++;
        }

        function delete_div(a) {
            var list = document.getElementById('moredocument');
            var aa = document.getElementById(a);

            list.removeChild(aa);
            deleted_document.push(a);

            new_document = new_document.filter((e) => {

                if (e != a) {
                    return e;
                }
            });

            updated_document = updated_document.filter((e) => {

                if (e != a) {
                    return e;
                }
            });

            console.log("new_document", new_document);
            console.log("updated_document", updated_document);


            console.log("deleted_document", deleted_document);


        }

        function make_editable() {
            document.getElementById('editbtn').setAttribute('hidden', 'hidden');
            document.getElementById('updatebtn').removeAttribute('hidden');
            document.getElementById('cancelbtn').removeAttribute('hidden');

            document.getElementById('addbtn').removeAttribute('hidden');
            // document.getElementById('removebtn').removeAttribute('hidden');
            document.getElementById('moredocument').removeAttribute('hidden');


            document.getElementsByName('name')[0].removeAttribute('readonly');
            document.getElementsByName('email')[0].removeAttribute('readonly');
            document.getElementsByName('phone')[0].removeAttribute('readonly');
            document.getElementsByName('university_name')[0].removeAttribute('readonly');
            document.getElementsByName('course_name')[0].removeAttribute('readonly');
            document.getElementsByName('intake')[0].removeAttribute('readonly');

            document.getElementById('showcountry').setAttribute('hidden', 'hidden');
            document.getElementById('country').removeAttribute('hidden');


            var total_doc_num = (document.getElementsByName('document[]')).length;
            for (let index = 0; index < total_doc_num; index++) {

                document.getElementsByName('doc_name[]')[index].removeAttribute('readonly');
                document.getElementsByName('doc_download[]')[index].setAttribute('hidden', 'hidden');
                document.getElementsByName('document[]')[index].removeAttribute('hidden');
                document.getElementsByName('deletebtn[]')[index].removeAttribute('hidden');

                // document.getElementsByName('show_doc[]')[index].setAttribute('hidden', 'hidden');
                // document.getElementsByName('edit_doc[]')[index].removeAttribute('hidden');  
            }

        }

        function make_uneditable() {
            // document.getElementById('updatebtn').setAttribute('hidden', 'hidden');
            // document.getElementById('cancelbtn').setAttribute('hidden', 'hidden');
            // document.getElementById('editbtn').removeAttribute('hidden');

            // document.getElementById('addbtn').setAttribute('hidden', 'hidden');
            // document.getElementById('removebtn').setAttribute('hidden', 'hidden');
            // document.getElementById('moredocument').setAttribute('hidden', 'hidden');


            // document.getElementsByName('name')[0].setAttribute('readonly', 'readonly');
            // document.getElementsByName('email')[0].setAttribute('readonly', 'readonly');
            // document.getElementsByName('phone')[0].setAttribute('readonly', 'readonly');
            // document.getElementsByName('university_name')[0].setAttribute('readonly', 'readonly');

            // document.getElementById('country').setAttribute('hidden', 'hidden');
            // document.getElementById('showcountry').removeAttribute('hidden');

            // var total_doc_num = (document.getElementsByName('document[]')).length;
            // for (let index = 0; index < total_doc_num; index++) {

            //     document.getElementsByName('document[]')[index].setAttribute('hidden', 'hidden');
            //     document.getElementsByName('doc_name[]')[index].setAttribute('readonly', 'readonly');
            //     document.getElementsByName('doc_download[]')[index].removeAttribute('hidden');

            // }

            window.location.reload();
        }

    </script>

    <script>
        function editbutton() {
            document.getElementById('editButton').style.display = "none";
            document.getElementsByName('email')[0].style.width = "fit-content";

            document.getElementById('updateButton').style.display = 'block';
            var x = document.getElementsByClassName("disabledClass");
            for (var i = 0; i < x.length; i++) {
                x[i].disabled = false;
            }
            var y = document.getElementsByClassName("hiddenClass");
            for (var i = 0; i < y.length; i++) {
                y[i].style.display = "none";
            }
            var z = document.getElementsByClassName("visibleClass");
            for (var i = 0; i < z.length; i++) {
                z[i].style.display = 'block';
            }

        }// end of function
    </script>


    <script>
        function submitform() {
            var n1 = new_document.toString();
            var u1 = updated_document.toString();
            var d1 = deleted_document.toString();
            document.getElementsByName('new_document')[0].value = n1;
            document.getElementsByName('updated_document')[0].value = u1;
            document.getElementsByName('deleted_document')[0].value = d1;

            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
            document.querySelector(
                "#loader").style.zIndex = "2";

            return true;
        }
    </script>

    <?php require('./agent_components/scripts.php'); ?>

    <script>
        function sendMessage(){

            var is_this_agent=document.getElementsByName('is_this_agent')[0].value;
            var application_id=document.getElementsByName('application_id123')[0].value;
            var to_user=document.getElementsByName('admin_id123')[0].value;
            var from_user=document.getElementsByName('agent_id123')[0].value;
            var message=document.getElementsByName('message_box')[0].value;

            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
            document.querySelector(
                "#loader").style.zIndex = "2";
            
            if (message !=null && message!='' && message!=' ') {
                if (message !=null || message!='' || message!=' ') {
                $.ajax({
                        type: "POST",
                        url: "../../backend/chatting/new_chat.php",
                        data: {
                            application_id: application_id,
                            is_this_agent: is_this_agent,
                            to_user: to_user,
                            from_user: from_user,
                            message: message
                        },
                        success: function (response) {
                            // console.log(response)
                            // alert("Successfilly updated");
                            location.reload();
                        },
                        error: function (error) {
                            alert(error.responseText);
                        }
                    });
               
           }
               
           }
          

        }
    </script>




</body>

</html>