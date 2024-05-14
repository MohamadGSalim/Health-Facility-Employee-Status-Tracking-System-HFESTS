<?php
include_once "config.php";

if(isset($_GET['deleteid'])){
$mednum = $_GET['deleteid'];
$facility = $_GET['facility'];
$date = $_GET['date'];
$vaccine = $_GET['type'];
$dosenum = $_GET['dosenum'];
$sql = "DELETE FROM emp_vaccinated WHERE MedicareNbr=$mednum AND FacilityName = '$facility' AND VaccineType = '$vaccine' AND Date = '$date' AND DoseNbr = $dosenum";
$result = mysqli_query($conn,$sql);
if($result){
    header("location: ./Vaccinations.php?error=none");
}
}