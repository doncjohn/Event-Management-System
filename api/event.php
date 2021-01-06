<?php
include('../dbcon.php');
$sql = "SELECT * FROM `event`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $i=0;
  header("Content-Type: JSON");
  header("Access-Control-Allow-Origin: *");
  while($row = $result->fetch_assoc()) {
    $response[$i]['Event_ID']= $row['Event_ID'];
    $response[$i]['Event_Name']= $row['Event_Name'];
    $response[$i]['Event_Location']= $row['Event_Location'];
    $response[$i]['Thumbnail_Image']= $row['Thumbnail_Image'];
    $response[$i]['Event_Start_Date']= $row['Event_Start_Date'];
    $response[$i]['Event_End_Date']= $row['Event_End_Date'];
    $response[$i]['Reg_Start_Date']= $row['Reg_End_Date'];
    $response[$i]['Reg_End_Date']= $row['Reg_End_Date'];
    $response[$i]['Reg_Fee']= $row['Reg_Fee'];
    $i++;
  }
  echo json_encode($response,JSON_PRETTY_PRINT);
} else {
  echo "0 results";
}

$conn->close();
?>