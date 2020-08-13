<?php 
    include("../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['dept_name'])){
            $dept_name = $_REQUEST['dept_name'];
        }

        if(isset($_REQUEST['saveType'])){
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        if($sType=='1'){
            $sql = "INSERT INTO departments ( dept_name) VALUES ('".$dept_name."')";
        }
        else{
            $sql = "UPDATE `departments` SET `dept_name`='".$dept_name."' WHERE dept_id=".$id;
        }
  
    if ($con->query($sql) === TRUE)
        {
            $response["code"] = 1;
            $response["message"] = "successfully stored";
        } else {
            $response["code"] = 2;
            $response["message"] = mysqli_error($con);
        }       
        echo json_encode($response);
        mysqli_close($con);
} 
?>