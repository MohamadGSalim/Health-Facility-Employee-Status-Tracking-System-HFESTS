<?php
include_once "./header.php";
?>
<div class="container"> 
<form action="./addInfection.include.php" method="POST">
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
<label for="Infection" class="form-label">Infection</label>
<select class="form-select" name="Infection" id="Infection">';
<?php
$sql = "SELECT Type from Infection";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $type = $row['Type'];
    echo '<option value="'.$type.'">'.$type.'</option>';
}
?>
</select>
</div>
<div class="mb-3 mt-3">
    <label for="dateOfInf" class="form-label">Date Of Infection</label>
    <input type="date" min="1900-01-01" max= "2023-05-01" class="form-control" id="dateOfInf" name="dateOfInf"required>
</div>
<div class="mt-3">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<?php
include "./footer.php";
?>