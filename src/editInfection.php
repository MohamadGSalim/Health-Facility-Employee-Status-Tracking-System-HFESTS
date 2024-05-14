<?php
include_once "./header.php";

function func_alert($message, $location)
{
    //Display alert box 
    echo "<script>alert('$message'); </script>";
    echo "<script>window.location = '$location' </script>";
}

if(isset($_GET['editid'])){
    $mednum = $_GET['editid'];
    $infection = $_GET['infection'];
    $date = $_GET['date'];
}

if(isset($_POST['submit'])){
    $med=$_POST['MedicareNbr'];
    $type=$_POST['Infection'];
    $dateInf=$_POST['dateOfInf'];
    $sql = "UPDATE emp_infected SET MedicareNbr=$med, InfectionType = '$type', Date = '$dateInf' WHERE MedicareNbr=$mednum AND InfectionType = '$infection' AND Date = '$date'";
    $result = mysqli_query($conn,$sql);
    if($result){
        func_alert("Changes Made Successful", "./Infections.php");
        exit();
    }
}

?>
<div class="container"> 
<form method="POST">
<div class="mb-3 mt-3">
<label for="MedicareNbr" class="form-label">MedicareNbr</label>
<select class="form-select" name="MedicareNbr" id="MedicareNbr" >
<?php
$sql = "SELECT MedicareNbr from Employee";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $med = $row['MedicareNbr'];
    if($med === $mednum){
        echo ' <option value="'.$med.'" selected>'.$med.'</option>';
    } else {
        echo ' <option value="'.$med.' ">'.$med.'</option>';
    }
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
    if($type === $infection){
        echo '<option value="'.$type.'" selected>'.$type.'</option>';
    } else {
        echo '<option value="'.$type.'">'.$type.'</option>';
    }  
}
?>
</select>
</div>
<div class="mb-3 mt-3">
    <label for="dateOfInf" class="form-label">Date Of Infection</label>
    <input type="date" min="1900-01-01" max= "2023-05-01" value = <?php echo $date?> class="form-control" id="dateOfInf" name="dateOfInf"required>
</div>
<div class="mt-3">
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
<?php
include "./footer.php";
?>