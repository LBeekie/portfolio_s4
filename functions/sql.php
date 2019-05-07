<?php
include ("connect.php");

function sqlSelect($sql){
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
    return $rows;

    mysqli_close($conn);
    
}
?>