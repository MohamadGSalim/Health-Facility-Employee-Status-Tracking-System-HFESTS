<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $doB = $_POST['dateOfBirth'];
    $medicareNbr = $_POST['medicareNbr'];
    $phone = $_POST['phone'];
    $phone =  (substr(chunk_split(substr($phone, 0, 6), 3, '-'), 0, 8)) . substr($phone, 6, 11);
    $citizenship = $_POST['citizenship'];
    $email = $_POST['email'];
    $address = explode(" ", $_POST['address'], 2);
    $postal = $_POST['postal'];
    $city = $_POST['city'];
    $province = $_POST['province'];

    $addnum = $address[0];
    $addName = $address[1];
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
    function employeeFieldsEmpty($fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $streetnum, $streetname, $province)
    {
        if (
            empty($fName) || empty($lName) || empty($doB) ||  empty($medicareNbr) || empty($phone) || empty($email)
            || empty($citizenship) || empty($streetnum) || empty($streetname) || empty($province)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    function addressExists($conn, $streetnum, $streetname)
    {
        // attempting to use prepared statement NOT WORKING CANT FIND VAR $DB
        //$addresses = $db -> query('Select * From Address WHERE StreetNbr = ? AND StreetName = ?',$streetnum,$streetname) ->fetchAll(); 
        $sql = "SELECT * FROM Address WHERE StreetNbr = '$streetnum' AND StreetName = '$streetname'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }

    function addressGeneralExists($conn, $city, $province)
    {
        // attempting to use prepared statement NOT WORKING CANT FIND VAR $DB
        //$addresses = $db -> query('Select * From Address WHERE StreetNbr = ? AND StreetName = ?',$streetnum,$streetname) ->fetchAll(); 
        $sql = "SELECT * FROM address_general WHERE City = '$city' AND Province = '$province'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }

    function employeesExists($conn, $medicareNbr)
    {
        $sql = "SELECT * FROM Employee WHERE MedicareNbr = '$medicareNbr'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        return ($rowcount > 0);
    }

    function addEmployee($conn, $fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $streetnum, $streetname, $postal, $province, $city)
    {
        if (!addressExists($conn, $city, $province)) {
            $sql1 = "INSERT INTO address_general(PostalCode,City,Province) VALUES('$postal','$city','$province')";
            $result = mysqli_query($conn, $sql1);
            if (!addressExists($conn, $streetnum, $streetname)) {
                $sql2 = "INSERT INTO Address(StreetNbr,StreetName,PostalCode) VALUES('$streetnum','$streetname','$postal')";
                $result = mysqli_query($conn, $sql2);
            }else{
                $result = TRUE;
            }
        } else {
            $result = TRUE;
        }
        if ($result) {
            $sql = "INSERT INTO Employee(FirstName, LastName, DOB, MedicareNbr, Phone,Citizenship,Email, StreetNbr, StreetName) VALUES('$fName','$lName','$doB','$medicareNbr','$phone','$citizenship','$email','$streetnum','$streetname')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                func_alert("Successfully Added!", "./addEmployees.php?error=none");
                exit();
            } else {
                func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addEmployees.php?error=databaseerror1");
                exit();
            }
        } else {
            func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addEmployees.php?error=databaseerror2");
            exit();
        }
    }

    /*Call methods to check for isempty*/
    if (employeeFieldsEmpty($fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $addnum, $addName, $province)) {
        func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addEmployees.php?error=EmptyFields");
        exit();
    }

    if (EmployeesExists($conn, $medicareNbr)) {
        func_alert("Fail to Add! Reason: ". mysqli_error($conn), "./addEmployees.php?error=EmployeeExists");
        exit();
    }

    addEmployee($conn, $fName, $lName, $doB, $medicareNbr, $phone, $citizenship, $email, $addnum, $addName, $postal, $province, $city);
    echo mysqli_error($conn);
}
