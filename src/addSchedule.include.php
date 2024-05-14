<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $medicareNbr = $_POST['medicareNbr'];
    $name =  $_POST['fName'];
    $sTime = $_POST['sTime'];
    $eTime = $_POST['eTime'];

    //convert to sql format of time
    $sTime = date('H:i:s', strtotime($sTime));
    $eTime = date('H:i:s', strtotime($eTime));

    /**Helps send a confirmation message and redirectes page 
     * Improvement could be creating a modal and popping up a message
     **/
    function func_alert($message, $location)
    {
        //Display alert box 
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location.href = '$location'; </script>";
    }

    /*Checks for data before insert*/
    function scheduleFieldsEmpty($date, $medicareNbr, $name, $sTime,$eTime)
    {
        if (
            empty($name) ||  empty($medicareNbr) || empty($date) || empty($sTime) || empty($eTime)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Check if the schedule conflicts for start time 
     */
    function isNotAvailableToStart($conn, $medicareNbr,$sTime,$date)
    {
        $sql = "SELECT * FROM schedule WHERE MedicareNbr = '$medicareNbr' AND Date = '$date' AND '$sTime' BETWEEN StartTime AND EndTime";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
        /**
     * Check if the schedule conflicts for end time
     */
    function isNotAvailableToEnd($conn, $medicareNbr,$eTime,$date)
    {
        $sql = "SELECT * FROM schedule WHERE MedicareNbr = '$medicareNbr' AND Date = '$date' AND '$eTime' BETWEEN StartTime AND EndTime";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
    function addSchedule($conn,$date, $medicareNbr, $name, $sTime,$eTime)
    {
        $sql = "INSERT INTO schedule(Date,MedicareNbr,FacilityName,StartTime,EndTime) VALUES('$date','$medicareNbr','$name','$sTime','$eTime')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            func_alert("Successfully Added!", "./addSchedule.php?addid=" . urlencode($medicareNbr) . "&facilityName=" . urlencode($name) . "/error=none");
            exit();
        } else {
            func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addSchedule.php?addid=" . urlencode($medicareNbr) . "&facilityName=" . urlencode($name) . "/error=databaseerror1");
            exit();
        }
    }
    if (scheduleFieldsEmpty($date, $medicareNbr, $name, $sTime,$eTime)) {
        func_alert("Fail to Add!", "./addSchedule.php?addid=$medicareNbr&facilityName=$name/error=EmptyFields");
        exit();
    }
    if (isNotAvailableToStart($conn, $medicareNbr,$sTime,$date)) {
        global $name;
        func_alert("Fail to Add!", "./addSchedule.php?addid=$medicareNbr&facilityName=$name/error=EmployementUnableToStart");
        exit();
    }
    if (isNotAvailableToEnd($conn, $medicareNbr,$eTime,$date)) {
        global $name;
        func_alert("Fail to Add!", "./addSchedule.php?addid=$medicareNbr&facilityName=$name/error=EmployementUnableToEnd");
        exit();
    }

    addSchedule($conn,$date, $medicareNbr, $name, $sTime,$eTime);
}