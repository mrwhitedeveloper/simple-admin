<?php 
    include("../db.php");
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page

if(isset($_POST['search']['value'])){
   $searchValue = $_POST['search']['value']; // Search value  
}
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (dept_name like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($con,"select count(*) as allcount from departments where deleted_at is  null");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($con,"select count(*) as allcount from departments WHERE deleted_at is  null ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from departments WHERE deleted_at is  null ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($con, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "dept_name"=>$row['dept_name'],
      'edit'=> '<button type="button" id="btnEdit"  class="btn btn-outline-primary" 
      value="Edit" data-id="'.$row["dept_id"].'" data-dept_name="'. $row["dept_name"].'" >
      <i class="fa fa-edit"></i></button></div>',
      'delete'=> '<button type="button" id="btnDelete"  class="btn btn-outline-danger"
       value="Delete" data-id="'.$row["dept_id"].'" >
      <i class="fa fa-trash"></i></button></div>'
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($response);
?>
