<?php
include_once "./header.php";
$id = $_GET['deleteid'];
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
<div class="row">
    <div class="d-flex justify-content-center align-items-center col-4 mx-auto" style="height:100vh">
        <div class=" container rounded border border-2 bg-secondary p-2">
            <form action="deleteFacility.include.php" method="POST">
            <div class="mb-3 mt-3 text-white fw-bold justify-content-center align-items-center d-flex  ">
                    <label for="confirmation" class="form-label">Are You Sure You Would Like to Delete?</label>
                    <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $row['Name']; ?>">
                    <input type="hidden" class="form-control" id="postal" name="postal" value="<?php echo $row2['PostalCode']; ?>">
                    <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value="<?php echo $row3['MedicareNbr']; ?>">
                </div>
                <div class="mt-3 justify-content-center align-items-center d-flex mb-3">
                    <button type="submit" name="submit" id="submit" class="btn btn-warning me-2">Delete</button>
                    <a href="Facilities.php"> <button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once "./footer.php";
