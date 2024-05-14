<?php 
include_once "config.php";

if(isset($_GET['deleteid'])){
    $mednum = $_GET['deleteid'];
    $infection = $_GET['infection'];
    $date = $_GET['date'];

    $sql = "DELETE FROM emp_infected WHERE MedicareNbr = $mednum AND InfectionType = '$infection' AND Date = '$date'";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("location: ./Infections.php?error=none");
    }
}