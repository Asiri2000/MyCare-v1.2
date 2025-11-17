<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require "../../dbConfig/dbConfig.php";

if (isset($_GET['start_time']) && isset($_GET['date'])) {
    $date = $_GET['date'];
    $start_time = $_GET['start_time'];

    $sql = "SELECT * FROM appointment WHERE Date = '$date' AND Start_time = $start_time";
    $sql_all = "SELECT * FROM room";

    $result = mysqli_query($conn, $sql);
    $result_all = mysqli_query($conn, $sql_all);

    $all_rooms = array();
    $booked_rooms = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (!is_null($row['Room_id'])) {
                array_push($booked_rooms, $row["Room_id"]);
            }
        }
    }

    if (mysqli_num_rows($result_all) > 0) {
        $data = array();
        while ($row_all = mysqli_fetch_assoc($result_all)) {
            array_push($all_rooms, ["id" => $row_all['Room_id'], "name" => $row_all['Room_name']]);
        }

        foreach ($all_rooms as $room) {
            if (in_array($room['id'], $booked_rooms)) {
                $room_arr = array("id" => $room['id'], "name" => $room['name'], "booked" => true);
            } else {
                $room_arr = array("id" => $room['id'], "name" => $room['name'], "booked" => false);
            }

            array_push($data, $room_arr);
        }

        echo json_encode($data);
    } else {
        echo json_encode(array(
            "message" => "No results found"
        ));
    }
} else {
    echo json_encode(array(
        "message" => "Invalid Parameters"
    ));
}
