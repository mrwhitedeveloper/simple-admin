<?php
    include("../db.php");
  
    $sql = "SELECT  *  from departments where deleted_at is null";
    $res = mysqli_query($con,$sql);

    $result = array();
    while($row =mysqli_fetch_array($res)) 
    {
        array_push($result,array('id'=>$row['dept_id'],'name'=>$row['dept_name']));
    }
    echo json_encode($result);
    mysqli_close($con);
?>