<?php


function get_attendence_today(){
    include 'Models/Connection.php';

    $sql = "SELECT * FROM att WHERE DATE(record_time) = CURDATE() ORDER BY At_id DESC";
    $result = $conn->query($sql);

    $all_rows = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $all_rows[] = $row;
        }
    }

    return $all_rows;
}
?>