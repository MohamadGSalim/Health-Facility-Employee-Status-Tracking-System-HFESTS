<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $medicareNbr = $_POST['medicareNbr'];
    $sTime = $_POST['sTime'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    /*Checks for data before insert*/
    /*Checks for data before insert*/
    function scheduleFieldsEmpty($date, $medicareNbr, $sTime,$name)
    {
        if (
          empty($medicareNbr) || empty($date) || empty($sTime) || empty($name) 
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    /**Helps send a confirmation message and redirectes page 
     * Improvement could be creating a modal and popping up a message
     **/
    function func_alert($message, $location)
    {
        //Display alert box 
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location = '$location' </script>";
    }
    function deleteSchedule($conn, $medicareNbr,$sTime,$date)
    {
        global $name;
        $sql = "DELETE FROM schedule WHERE MedicareNbr = '$medicareNbr' AND StartTime = '$sTime' AND Date = '$date'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            func_alert("Successfully Deleted!", "./Schedule.php?viewid=$medicareNbr&facilityName=$name");
            exit();
        } else {
            func_alert("Failed to Delete! Reason: ". mysqli_error($conn), "./Schedule.php?viewid=$medicareNbr&facilityName=$name");
            exit();
        }
    }
    if (scheduleFieldsEmpty($date, $medicareNbr, $name, $sTime,$eTime)) {
        func_alert("Fail to Add!", "./Schedule.php?viewid=$medicareNbr&facilityName=$name/error=EmptyFields");
        exit();
    }
    deleteSchedule($conn, $medicareNbr,$sTime,$date);
    echo mysqli_error($conn);
}