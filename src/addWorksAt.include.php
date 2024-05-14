<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $medicareNbr = $_POST['medicareNbr'];
    $fName = $_POST['facilityName'];
    $role =  $_POST['role'];
    $startDate = $_POST['sDate'];
    $defaultFname = $_POST['fName'];
    /**Helps send a confirmation message and redirectes page 
     * Improvement could be creating a modal and popping up a message
     **/
    function func_alert($message, $location)
    {
        //Display alert box 
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location = '$location' </script>";
    }

    /*Checks for data before insert*/
    function worksAtFieldsEmpty($fName,$medicareNbr, $role, $startDate)
    {
        if (
           empty($fName) || empty($medicareNbr) || empty($role) || empty($startDate)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    /**
     * Is the Facility Name Empty use a default
     */
    function isFacilityNameEmpty($name){
        global $defaultFname;
        global $fName;
        if(empty($name)){
            $fName = $defaultFname;
            return true;
        }
        return false;
    }
    /**
     * Check to see if an employee exists
     */
    function isEmployee($conn, $medicareNbr)
    {
        $sql = "SELECT * FROM Employee WHERE MedicareNbr = '$medicareNbr'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
    /**
     * Check to see if the employee is already employed currently at the facility
     */
    function isEmployed($conn, $medicareNbr,$fName)
    {        
        $endDate = "NULL";
        $sql = "SELECT * FROM worksAt WHERE MedicareNbr = '$medicareNbr' AND FacilityName = '$fName' AND EndDate IS $endDate";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return (intval($rowcount) > 0);
    }
    /**
     * Check to see if the facility exists 
     */
    function isFacility($conn, $fName)
    {
        $sql = "SELECT * FROM Facility WHERE Name = '$fName'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
    /**
     * Check to see if the facility is at capacity
     */
    function isAtCapacity($conn, $fName)
    {
        $endDate = "NULL";

        $sql = "SELECT COUNT(w.MedicareNbr) as workers FROM worksAt as w WHERE FacilityName = '$fName' AND EndDate IS $endDate";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        $sql1 = "SELECT * FROM Facility WHERE Name = '$fName'";
        $result2 = mysqli_query($conn, $sql1);
        $row2 = mysqli_fetch_assoc($result2);
        return (intval($row2['Capacity']) <= intval($row[0]));
    }
    function addWorksAt($conn, $medicareNbr, $fName, $role, $startDate)
    {
        $endDate = "NULL";
        $sql = "INSERT INTO worksAt(MedicareNbr, FacilityName, Role, StartDate, EndDate) VALUES('$medicareNbr','$fName','$role','$startDate',$endDate)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            func_alert("Successfully Added!", "./addWorksAt.php?addid=$fName/error=none");
            exit();
        } else {
            func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addWorksAt.php?addid=$fName/error=databaseerror1");
            exit();
        }
    }

    isFacilityNameEmpty($fName);

    /*Call methods to check for errors in input*/
    if (worksAtFieldsEmpty($medicareNbr, $fName, $role, $startDate)) {
        func_alert("Fail to Add!", "./addWorksAt.php?addid=$fName/error=EmptyFields");
        exit();
    }
    if (!isEmployee($conn, $medicareNbr)) {
        global $fName;
        func_alert("Fail to Add!", "./addWorksAt.php?addid=$fName/error=EmployeeDoesNotExists");
        exit();
    }
    if (isEmployed($conn, $medicareNbr,$fName)) {
        func_alert("Fail to Add!", "./addWorksAt.php?addid=$fName/error=EmployementExists");
        exit();
    }
    
    if (!isFacility($conn, $fName)) {
        func_alert("Fail to Add!", "./addWorksAt.php?addid=$fName/error=FacilityDoesNotExists");
        exit();
    }

    if (isAtCapacity($conn, $fName)) {
        func_alert("Fail to Add!", "./addWorksAt.php?addid=$fName/error=EmployementisAtCapacity");
        exit();
    }

    addWorksAt($conn, $medicareNbr, $fName, $role, $startDate);
    echo mysqli_error($conn);
}