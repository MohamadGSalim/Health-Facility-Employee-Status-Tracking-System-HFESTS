<?php
include_once "./header.php";
$id = $_GET['addid'];
$id = strtok($id, '/');
?>
<?php
$sql = "SELECT * FROM worksAt WHERE FacilityName = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Add NEW Employement</h1>
    <form action="addWorksAt.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="medicareNbr" class="form-label">Medicare Number</label>
            <select class="form-select" name="medicareNbr" id="medicareNbr">
                <?php
                $sql = "SELECT MedicareNbr from Employee";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $med = $row['MedicareNbr'];
                    echo ' <option value="' . $med . '">' . $med . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="facilityName" class="form-label">Facility Name</label>
            <select class="form-select" name="facilityName" id="facilityName">
                <option value="<?php if(stripos($id,"err") === false){echo $id;}?>" selected disabled hidden required><?php if(stripos($id,"err") === false){echo $id;} ?></option>
                <?php
                $sql = "SELECT Name from Facility";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['Name'];
                    echo ' <option value="' . $name . '">' . $name . '</option>';
                }
                ?>
            </select>
            <input type="hidden" class="form-control" id="fName" name="fName" value="<?php echo $id ?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
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
            <label for="sDate" class="form-label">Start Of Employement</label>
            <input type="date" min="1900-01-01" max="2023-05-01" class="form-control" id="sDate" name="sDate" required>
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
            <a href="./Query7.php?type=<?php if(stripos($id,"err") === false){echo $id;} ?>&submit="> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";