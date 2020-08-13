<?php 
   include("../db.php"); 

    $id=$_REQUEST['id'];
    //date_default_timezone_set("Asia/Kolkata");
    $cdt=date("Y-m-d H:i:s");
    //$sql = "UPDATE `departments` SET `deleted_at`='$cdt' WHERE dept_id=".$id;
    $sql = "DELETE FROM `departments` WHERE `dept_id`=".$id;
	$res = mysqli_query($con,$sql);

	$result = array();
		
    if ($con->query($sql) === TRUE)
    {
        $response["code"] = 1;
        $response["message"] = "successfully deleted";
        
    } else {
        $response["code"] = 2;
        $response["message"] = mysqli_error($con);
    }
    echo json_encode($response);
    mysqli_close($con);   
?>