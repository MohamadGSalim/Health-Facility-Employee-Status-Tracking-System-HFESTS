<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $doB = $_POST['dateOfBirth'];
    $medicareNbr = $_POST['medicareNbr'];
    $phone = $_POST['phone'];
    $phone =  (substr(chunk_split(substr($phone,0,6),3,'-'),0,8)).substr($phone,6,11);
    $citizenship = $_POST['citizenship'];
    $email = $_POST['email'];
    $postal = $_POST['postal'];
    $addnum = $_POST['sNum'];
    $addName = $_POST['sName'];

    /*Checks for data before insert*/
    function employeeFieldsEmpty($fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $streetnum, $streetname)
    {
        if (
            empty($fName) || empty($lName) || empty($doB) ||  empty($medicareNbr) || empty($phone) || empty($email)
            || empty($citizenship) || empty($streetnum) || empty($streetname)
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
    function func_alert($message,$location){
        //Display alert box 
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location = '$location' </script>";
    }
    function addressExists($conn, $streetnum, $streetname)
    {
        // attempting to use prepared statement with OOP way NOT WORKING CANT FIND VAR $DB
        //$addresses = $db -> query('Select * From Address WHERE StreetNbr = ? AND StreetName = ?',$streetnum,$streetname) ->fetchAll(); 
        $sql = "SELECT * FROM Address WHERE StreetNbr = '$streetnum' AND StreetName = '$streetname'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }
    function updateEmployee($conn, $fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $streetnum, $streetname, $postal)
    {
        $sql1 = "UPDATE Address SET  StreetNbr='$streetnum', StreetName= '$streetname' WHERE PostalCode='$postal'";
        $result = mysqli_query($conn, $sql1);
        if ($result) {
            $sql = "UPDATE Employee SET FirstName ='$fName', LastName = '$lName', DOB = '$doB', 
            Phone = '$phone',Citizenship='$citizenship',Email='$email',
            StreetNbr='$streetnum', StreetName='$streetname' WHERE MedicareNbr = '$medicareNbr'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                func_alert("Successfully Updated!", "./editEmployee.php?editid=$medicareNbr&error=none");
                exit();
            } else {
                func_alert("Failed to Update! Reason: ". mysqli_error($conn), "./editEmployee.php?editid=$medicareNbr&error=databaseerror1");
                exit();
            }
        } else {
            func_alert("Failed to Update! Reason: ". mysqli_error($conn), "./editEmployee.php?editid=$medicareNbr&error=databaseerror2");
            exit();
        }
    }

    /*Call methods to check for isempty*/
    if (employeeFieldsEmpty($fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $addnum, $addName)) {
        header("location: ./editEmployee.php?editid=$medicareNbr&error=EmptyFields");
        exit();
    }
    updateEmployee($conn, $fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $addnum, $addName, $postal);
    echo mysqli_error($conn);
}
