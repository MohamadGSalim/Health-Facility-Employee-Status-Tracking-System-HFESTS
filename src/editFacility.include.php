<?php
include_once "config.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];
    $postal = $_POST['postal'];
    $streetNum = $_POST['sNum'];
    $streetName = $_POST['sName'];
    $manager = $_POST['manager'];
    $medicareNbr = $_POST['medicareNbr'];

    function facilityFieldsEmpty($name,$phone,$web,$capacity,$streetNum,$streetName){
        if(empty($name) || empty($phone) ||empty($web) ||empty($capacity) ||empty($streetNum) ||empty($streetName)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**Helps send a confirmation message and redirectes page 
     * Improvement could be creating a modal and popping up a message
    **/ 
    function func_alert($message,$location){
        //Display alert box 
        global $type;
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location= '$location' </script>";
    }
    /**
     * Deals with the no change in value for type if no value but default is selected in the facility update
     */
    function isTypeEmpty($conn,$name){
        global $type;
        if(is_null($type)){
            $sql = "SELECT Type FROM Facility WHERE Name = '$name'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $type = $row['Type'];
            return true;
        }
        return false;
    }
    /**
     * Check to see if the employee is currently working at the facility
     */
    function isEmployeeAtFacility($conn, $medicareNbr,$name)
    {
        if(empty($medicareNbr)){
            return true;
        }
        $sql = "SELECT * FROM worksAt WHERE MedicareNbr = '$medicareNbr'AND FacilityName = '$name'" ;
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
    /**
     * Check to see if the Person is already a manager for a place or if there is no change in management 
     */
    function isAlreadyManager($conn,$manager,$medicareNbr){
        if(empty($manager)){ //if the manager val is empty
            return false;
        }
        $sql = "SELECT * FROM Facility WHERE Manager = '$manager'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount > 0){
            if($manager == $medicareNbr){ //if same manager should be fine
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    function updateFacility($conn, $name, $phone, $website,$type,$capacity,$streetNum, $streetName,$manager, $postal)
    {
        $sql1 = "UPDATE Address SET  StreetNbr='$streetNum', StreetName= '$streetName' WHERE PostalCode='$postal'";
        $result = mysqli_query($conn, $sql1);
        if ($result) {
            $sql = "UPDATE Facility SET Phone ='$phone',WebAddress='$website',Type='$type',Capacity ='$capacity',
            StreetNbr='$streetNum', StreetName='$streetName', Manager='$manager' WHERE Name = '$name'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                func_alert("Successfully Updated!", "./editFacility.php?editid=$name/error=none");
                exit();
            } else {
                func_alert("Failed to Update! Reason: ". mysqli_error($conn), "./editFacility.php?editid=$name/error=databaseerror1");
                exit();
            }
        } else {
            func_alert("Failed to Update!", "./editFacility.php?editid=$name/error=databaseerror2");
            exit();
        }
    }

    if (facilityFieldsEmpty($name,$phone,$website,$capacity,$streetNum,$streetName)){
        func_alert("Failed to Update!", "./editFacility.php?editid=$name/error=EmptyFields");
        exit();
    }
    if (isAlreadyManager($conn,$manager,$medicareNbr)){
        func_alert("Failed to Update!", "./editFacility.php?editid=$name/error=AlreadyAManager");
        exit();
    }
    if (!isEmployeeAtFacility($conn, $manager,$name)){
        func_alert("Failed to Update!", "./editFacility.php?editid=$name/error=EmployeeNotFound");
        exit();
    }

    isTypeEmpty($conn,$name);

    updateFacility($conn, $name, $phone, $website,$type,$capacity,$streetNum, $streetName,$manager, $postal);
    echo mysqli_error($conn);

}