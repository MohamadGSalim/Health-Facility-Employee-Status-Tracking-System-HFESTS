<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $medicareNbr = $_POST['medicareNbr'];
    $name = $_POST['name'];

    /*Checks for data before insert*/
    function employeeFieldsEmpty($medicareNbr)
    {
        if (empty($medicareNbr)) {
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
    function deleteEmployee($conn, $medicareNbr,$name)
    {
        $result1 = TRUE;
        if (!empty($name)) {
            $sql3 = "UPDATE Facility SET Manager = NULL WHERE Manager = '$medicareNbr'";
            $result1 =  mysqli_query($conn, $sql3);
        }
        if ($result1) {
            $sql = "DELETE FROM Employee WHERE MedicareNbr = '$medicareNbr'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                func_alert("Successfully Deleted!", "./Employees.php");
                exit();
            } else {
                func_alert("Failed to Delete! Reason: " . mysqli_error($conn), "./Employees.php");
                exit();
            }
        }else {
            func_alert("Failed to Delete! Reason: " . mysqli_error($conn), "./Employees.php");
            exit();
        }
    }
    /*Call methods to check for isempty*/
    if (employeeFieldsEmpty($medicareNbr)) {
        func_alert("Failed to Delete!", "./Employees.php");
        exit();
    }

    deleteEmployee($conn, $medicareNbr,$name);
    echo mysqli_error($conn);
}
