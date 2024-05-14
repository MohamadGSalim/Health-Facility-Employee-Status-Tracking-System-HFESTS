<?php
include_once "./config.php";

if(isset($_POST['submit'])){
$mednum=$_POST['MedicareNbr'];
$type=$_POST['Infection'];
$date=$_POST['dateOfInf'];

function emptyInfFields($mednum, $type, $date){
    if(empty($mednum) || empty($type) || empty($date)){
        return true;
    } else {
        return false;
    }
}

function infEntryExists($conn,$mednum,$type,$date){
    $sql= "SELECT * FROM emp_infected WHERE MedicareNbr = $mednum AND InfectionType = '$type' AND Date = '$date'";
    $result = mysqli_query($conn,$sql);
    $rowNum = mysqli_num_rows($result);
    return ($rowNum > 0);
}


function addInfection($conn, $mednum, $type, $date){
    $sql = "INSERT INTO emp_infected VALUES($mednum,'$type','$date')";
    $result = mysqli_query($conn,$sql);
    if($result){
        header('location: ./Infections.php?error=none');
        exit();
    }
}

if(emptyInfFields($mednum,$type,$date)){
    header("location: ./addInfection.php?error=emptyFields");
    exit();
}


if(infEntryExists($conn,$mednum,$type,$date)){
    header('location: ./addInfection.php?error=recordExists');
    exit();
}

addInfection($conn,$mednum,$type,$date);

}