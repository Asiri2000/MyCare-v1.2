<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
include_once '../models/SendMail.php';
use models\SendMail;


class ReminderCalenderController
{
    private $remainderMail;

    public function __construct()
    {
        $this->remainderMail = new SendMail();
    }

    public function handleData()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case "GET":
                break;

            case "POST":
                $eventTitle = $_POST['eventTitle'];
                $eventTimeFrom = $_POST['eventTimeFrom'];
                $eventTimeTo = $_POST['eventTimeTo'];
                $eventMail = $_POST['eventMail'];
                $eventDate = $_POST['eventDate'];
                $message = "<p>Your Event Add Successfully</p>" .
                     "<p>Event Title:$eventTitle</p>" .
                     "<p>Event Date:$eventDate</p>" .
                    "<p>Event Time From :$eventTimeFrom</p>" .
                    "<p>Event Time To: $eventTimeTo</p>";
                $result=$this->remainderMail->sendMailMessage($eventMail,"","Event Details",$message);
                $data = array('result' => $result);
                echo json_encode($data);
                break;
        }
    }
}

$remainder = new ReminderCalenderController();
$remainder->handleData();
