<?php
include_once "./header.php";
$id = $_GET['editid'];
$id = strtok($id, '/');
?>
<?php
$sql = "SELECT * FROM Facility WHERE Name = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql2 = "SELECT a.PostalCode FROM Address as a JOIN Facility as f ON a.StreetName = f.StreetName WHERE f.Name ='$id'";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result);
$sql3 = "SELECT e.MedicareNbr FROM Employee as e JOIN Facility as f ON e.MedicareNbr = f.Manager WHERE f.Name ='$id'";
$result = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Edit <?php echo $row['Name']; ?> Profile</h1>
    <form action="editFacility.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" pattern="[0-9]{10,11}" class="form-control" id="phone" name="phone" value="<?php echo implode('', explode('-', $row['Phone'])) . ''; ?>" required>
            <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $row['Name']; ?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="website" class="form-label">Web Address</label>
            <input type="text" class="form-control" id="website" name="website" pattern="^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}$" value="<?php echo $row['WebAddress']; ?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="type" class="form-label">Facility Type</label>
            <select id="type" name="type" class="form-select">
                <option value="<?php echo $row['Type']; ?>" selected disabled hidden><?php echo $row['Type']; ?></option>
                <option value="Hospital">Hospital</option>
                <option value="CLSC">CLSC</option>
                <option value="Clinic">Clinic</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Special">Special Installement</option>
            </select>
        </div>
        <div class="form-outline mt-3 mb-3">
            <label class="form-label" for="capacity">Number input</label>
            <input type="number" id="capacity" name="capacity" class="form-control" value="<?php echo $row['Capacity']; ?>" />
        </div>
        <div class="mb-3 mt-3">
            <label for="sNum" class="form-label">Street Number</label>
            <input type="text" class="form-control" id="sNum" name="sNum" value="<?php echo $row['StreetNbr']; ?>" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="sName" class="form-label">Street Name</label>
            <input type="text" class="form-control" id="sName" name="sName" value="<?php echo $row['StreetName']; ?>" required>
            <input type="hidden" class="form-control" id="postal" name="postal" value="<?php echo $row2["PostalCode"]; ?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="manager" class="form-label">Manager</label>
            <input type="text" class="form-control" id="manager" name="manager" value="<?php echo $row['Manager']; ?>">
            <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value="<?php echo $row3['MedicareNbr']; ?>">
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
            <a href="Facilities.php"> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";
