<?php
include_once "./header.php";
$id = $_GET['editid'];
$id = strtok($id,'/');
?>
<?php
$sql = "SELECT * FROM worksAt WHERE MedicareNbr = '$id' AND EndDate IS NULL";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Edit Employee: <?php echo $row['MedicareNbr']; ?> Profile</h1>
    <form action="editWorksAt.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select">
                <option value="<?php echo $row['Role']; ?>" selected disabled hidden><?php echo $row['Role']; ?></option>
                <option value="Nurse">Nurse</option>
                <option value="Doctor">Doctor</option>
                <option value="Cashier">Cashier</option>
                <option value="Pharmacist">Pharmacist</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Administrative Personnel">Administrative Personnel</option>
                <option value="Security Personnel">Security Personnel</option>
                <option value="Regular Emloyee">Regular Employee</option>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="endDate" class="form-label">End Of Employement</label>
            <input type="date" min="1900-01-01" max= "2099-05-01" class="form-control" id="endDate" name="endDate" value= "<?php echo $row['EndDate']; ?>" >
            <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value= "<?php echo $row['MedicareNbr'] ?>" >
            <input type="hidden" class="form-control" id="sDate" name="sDate" value="<?php echo $row['StartDate']; ?>" >
            <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $row['FacilityName']; ?>" >
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
            <a href="./Query7.php?type=<?php echo $row['FacilityName']?>&submit="> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";