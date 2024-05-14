<?php
include_once "./header.php";
?>

<div class="container"> 
<form action="./addVaccination.include.php" method="POST">

<div class="mb-3 mt-3">
<label for="Facility" class="form-label">Facility</label>
<select class="form-select" name="Facility" id="Facility">
<?php
$sql = "SELECT Name from Facility";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['Name'];
    echo '<option value="'.$name.'">'.$name.'</option>';
}
?>
</select>
</div>
<div class="mb-3 mt-3">
<label for="MedicareNbr" class="form-label">MedicareNbr</label>
<select class="form-select" name="MedicareNbr" id="MedicareNbr" >
<?php
$sql = "SELECT MedicareNbr from Employee";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $med = $row['MedicareNbr'];
    echo ' <option value="'.$med.'">'.$med.'</option>';
}
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
    echo '<option value="'.$type.'">'.$type.'</option>';
}
?>
</select>
</div>
<div class="mb-3 mt-3">
    <label for="dateOfVacc" class="form-label">Date Of Vaccination</label>
    <input type="date" min="1900-01-01" max= "2023-05-01" class="form-control" id="dateOfVacc" name="dateOfVacc"required>
</div>
<div class="mt-3">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<?php
include "./footer.php";
?>