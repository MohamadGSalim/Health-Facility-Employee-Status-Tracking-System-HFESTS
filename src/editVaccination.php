<?php
include_once "./header.php";

function func_alert($message, $location)
{
    //Display alert box 
    echo "<script>alert('$message'); </script>";
    echo "<script>window.location = '$location' </script>";
}

$mednum = $_GET['editid'];
$facility = $_GET['facility'];
$date = $_GET['date'];
$vaccine = $_GET['type'];
$dosenum = $_GET['dosenum'];


if(isset($_POST['submit'])){
    $fname=$_POST['Facility'];
    $type=$_POST['Vaccine'];
    $dateVacc=$_POST['dateOfVacc'];
    $sql = "UPDATE emp_vaccinated SET FacilityName = '$fname', VaccineType = '$type', Date = '$dateVacc' WHERE MedicareNbr=$mednum AND FacilityName = '$facility' AND VaccineType = '$vaccine' AND Date = '$date' AND DoseNbr = $dosenum";
    $result = mysqli_query($conn,$sql);
    echo $sql;
    if($result){
        func_alert("Vaccination Modified","./Vaccinations.php");
    }
}
?>

<div class="container"> 
<form method="POST">

<div class="mb-3 mt-3">
<label for="Facility" class="form-label">Facility</label>
<select class="form-select" name="Facility" id="Facility">
<?php
$sql = "SELECT Name from Facility";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['Name'];
    if($name === $facility){
        echo '<option value="'.$name.'" selected>'.$name.'</option>';
    } else {
        echo '<option value="'.$name.'">'.$name.'</option>';
    }
}
?>
</select>
</div>
<div class="mb-3 mt-3">
<label for="MedicareNbr" class="form-label">MedicareNbr</label>
<select class="form-select" name="MedicareNbr" id="MedicareNbr" >
<?php
 echo ' <option value="'.$mednum.'" selected>'.$mednum.'</option>';
?>
</select>
</div>
<div class="mb-3 mt-3">
<label for="Vaccine" class="form-label">Vaccine</label>
<select class="form-select" name="Vaccine" id="Vaccine">';
<?php
$sql = "SELECT Type from Vaccine";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $type = $row['Type'];
    if($type === $vaccine){
        echo '<option value="'.$type.'" selected>'.$type.'</option>';
    } else {
        echo '<option value="'.$type.'">'.$type.'</option>';
    }  
}
?>
</select>
</div>
<div class="mb-3 mt-3">
    <label for="dateOfVacc" class="form-label">Date Of Vaccination</label>
    <input type="date" min="1900-01-01" max= "2023-05-01" value = <?php echo $date?> class="form-control" id="dateOfVacc" name="dateOfVacc"required>
</div>
<div class="mt-3">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<?php
include "./footer.php";
?>