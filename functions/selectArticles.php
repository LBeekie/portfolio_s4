<?php
//include ("sql.php");
include ("connect.php");

$sql = "SELECT * FROM article " .$_REQUEST["sql"];
//echo $sql;
//$sql = "SELECT * FROM article";

global $conn;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
    $rows = [];
    while($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
}else {
    $rows[] = null;
    //echo "null";
}

//print_r($rows);
//return $rows; //or echo?
echo json_encode($rows);

mysqli_close($conn);
?>