<?php
include_once "./config.php";

if(isset($_POST['submit'])){
$facility=$_POST['Facility'];
$mednum=$_POST['MedicareNbr'];
$type=$_POST['Vaccine'];
$date=$_POST['dateOfVacc'];

$sql = 'SELECT MAX(DoseNbr) FROM emp_vaccinated WHERE MedicareNbr = '.$mednum.'';
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_assoc($result);
    $doseNum = $row['MAX(DoseNbr)'];
}

if(empty($doseNum)){
    $doseNum = 1;
} else {
    $doseNum = intval($doseNum) + 1;
}

function emptyVaccFields($mednum, $facility,$type, $date){
    if(empty($mednum) ||  empty($facility) || empty($type) || empty($date)){
        return true;
    } else {
        return false;
    }
}

function vaccEntryExists($conn, $mednum, $facility ,$type, $date){
$sql= 'SELECT * FROM emp_vaccinated WHERE MedicareNbr = '.$mednum.' AND VaccineType = "'.$type.'" AND Date = "'.$date.'" AND FacilityName = "'.$facility.'"';
$result = mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);
return ($rowcount > 0);
}



function addVaccination($conn, $mednum, $facility,$type, $dosenum,$date){
    $sql = "INSERT INTO emp_vaccinated(MedicareNbr, FacilityName, VaccineType, DoseNbr, Date) VALUES($mednum,'$facility','$type',$dosenum,'$date')";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("location: ./Vaccinations.php?error=none");
    }
}

if(emptyVaccFields($mednum,$facility,$type,$date)){
    echo "empty bozo";
}



if(vaccEntryExists($conn,$mednum,$facility,$type,$date)){
    echo "not nice";
    exit();
}

addVaccination($conn, $mednum, $facility, $type, $doseNum, $date);

}

