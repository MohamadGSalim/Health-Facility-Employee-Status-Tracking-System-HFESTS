<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $postal = $_POST['Postal'];
    $medicareNbr = $_POST['medicareNbr'];


    /*Checks for data before insert*/
    function facilityFieldsEmpty($name)
    {
        if (empty($name)) {
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
    function deleteFacility($conn, $name, $postal, $medicareNbr)
    {
        $sql1 = "DELETE FROM Address WHERE PostalCode = '$postal'";
        $result1 =  mysqli_query($conn, $sql1);
        $sql2 = "DELETE FROM address_general WHERE PostalCode = '$postal'";
        $result1 =  mysqli_query($conn, $sql2);

        if (!empty($medicareNbr)) {
            $sql3 = "UPDATE Facility SET Manager = NULL WHERE Manager = '$medicareNbr'";
            $result1 =  mysqli_query($conn, $sql3);
        }
        if ($result1) {
            $sql = "DELETE FROM Facility WHERE Name = '$name'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                func_alert("Successfully Deleted!", "./Facilities.php");
                exit();
            } else {
                func_alert("Failed to Delete! Reason: " . mysqli_error($conn), "./Facilities.php?error=FacilityFailedToRemove");
                exit();
            }
        } else {
            func_alert("Failed to Delete!  Reason: " . mysqli_error($conn), "./Facilities.php?error=AddressFailedToRemove");
            exit();
        }
    }
    /*Call methods to check for isempty*/
    if (facilityFieldsEmpty($name)) {
        func_alert("Failed to Delete!", "./Facilities.php");
        exit();
    }

    deleteFacility($conn, $name, $postal, $medicareNbr);
    echo mysqli_error($conn);
}
