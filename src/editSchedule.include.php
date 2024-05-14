<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $medicareNbr = $_POST['medicareNbr'];
    $sTime = $_POST['sTime'];
    $oTime = $_POST['oldTime'];
    $eTime = $_POST['eTime'];
    $date = $_POST['date'];
    $oDate = $_POST['oldDate'];
    $name = $_POST['name'];
    $fName = $_POST['fName'];

    //convert to sql format of time
    $sTime = date('H:i:s', strtotime($sTime));
    $eTime = date('H:i:s', strtotime($eTime));

    function scheduleFieldsEmpty( $medicareNbr, $sTime, $eTime, $date)
    {
        if (empty($medicareNbr) || empty($sTime) || empty($eTime) || empty($date)) {
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
    /**
     * Is the Facility Name Empty use a default
     */
    function isFacilityNameEmpty($str){
        global $name;
        global $fName;
        if(empty($str)){
            $fName = $name;
            return true;
        }
        return false;
    }
    /**
     * Deals with the no change in value for type if no value but default is selected in the facility update
     */
    function isFacilityNameEmptyQuery($conn, $medicareNbr, $sTime, $date)
    {
        global $name;
        if (empty($name)) {
            $sql = "SELECT FacilityName FROM schedule WHERE MedicareNbr = '$medicareNbr' AND StartTime = '$sTime' AND Date = '$date'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['FacilityName'];
            return true;
        }
        return false;
    }
    function updateSchedule($conn, $fName, $medicareNbr, $sTime, $eTime, $date,$oTime,$oDate)
    {
        global $name;
        $sql = "UPDATE schedule SET StartTime = '$sTime',EndTime = '$eTime',Date = '$date',
            FacilityName='$fName' WHERE MedicareNbr = '$medicareNbr' AND StartTime = '$oTime' AND Date = '$oDate'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            func_alert("Successfully Updated!", "./editSchedule.php?editid=$medicareNbr&facilityName=$name&date=$date&stime=$sTime&etime=$eTime/error=none");
            exit();
        } else {
            func_alert("Failed to Update! Reason: " . mysqli_error($conn), "./editSchedule.php?editid=$medicareNbr&facilityName=$name&date=$date&stime=$sTime&etime=$eTime/error=databaseerror1");
            exit();
        }
    }
    if (scheduleFieldsEmpty( $medicareNbr, $sTime, $eTime, $date)) {
        global $name;
        func_alert("Failed to Update!", "./editSchedule.php?editid=$medicareNbr&facilityName=$name&date=$date&stime=$sTime&etime=$eTime/error=EmptyFields");
        exit();
    }

    isFacilityNameEmpty($fName);
    updateSchedule($conn, $fName, $medicareNbr, $sTime, $eTime, $date,$oTime,$oDate);
    echo mysqli_error($conn);
}
