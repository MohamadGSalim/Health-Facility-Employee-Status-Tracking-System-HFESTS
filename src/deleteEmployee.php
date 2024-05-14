<?php
include_once "./header.php";
$id = $_GET['deleteid'];
$id = strtok($id, '&');?>
<?php
$sql = "SELECT * FROM Employee WHERE MedicareNbr = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql2 = "Select a.PostalCode FROM Address as a JOIN Employee as e ON a.StreetName = e.StreetName WHERE e.MedicareNbr ='$id'";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result);
$sql3 = "SELECT * FROM Facility WHERE Manager ='$id'";
$result = mysqli_query($conn, $sql3);
$row3= mysqli_fetch_assoc($result);
?>
<div class="row">
    <div class="d-flex justify-content-center align-items-center col-4 mx-auto" style="height:100vh">
        <div class=" container rounded border border-2 bg-secondary p-2">
            <form action="deleteEmployee.include.php" method="POST">
                <div class="mb-3 mt-3 text-white fw-bold justify-content-center align-items-center d-flex  ">
                    <label for="confirmation" class="form-label">Are You Sure You Would Like to Delete?</label>
                    <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value="<?php echo $row['MedicareNbr']; ?>">
                    <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $row3['Name']; ?>">

                </div>
                <div class="mt-3 justify-content-center align-items-center d-flex mb-3">
                    <button type="submit" name="submit" id="submit" class="btn btn-warning me-2">Delete</button>
                    <a href="Employees.php"> <button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once "./footer.php";
