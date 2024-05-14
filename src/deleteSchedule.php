<?php
include_once "./header.php";
$id = $_GET['deleteid'];
$id = strtok($id, '/');
$fName = $_GET['facilityName'];
$fName = strtok($fName, '/');
$date = $_GET['date'];
$date = strtok($date, '/');
$time = $_GET['time'];
$time = strtok($time, '/');
?>
<?php
$sql = "SELECT * FROM schedule WHERE MedicareNbr = '$id' AND Date='$date' AND StartTime = '$time'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="row">
    <div class="d-flex justify-content-center align-items-center col-4 mx-auto" style="height:100vh">
        <div class=" container rounded border border-2 bg-secondary p-2">
            <form action="deleteSchedule.include.php" method="POST">
            <div class="mb-3 mt-3 text-white fw-bold justify-content-center align-items-center d-flex  ">
                    <label for="confirmation" class="form-label">Are You Sure You Would Like to Delete?</label>
                    <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value="<?php echo $row['MedicareNbr']; ?>">
                    <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $fName; ?>">
                    <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $row['Date']; ?>">
                    <input type="hidden" class="form-control" id="sTime" name="sTime" value="<?php echo $row['StartTime']; ?>">
                </div>
                <div class="mt-3 justify-content-center align-items-center d-flex mb-3">
                    <button type="submit" name="submit" id="submit" class="btn  btn-warning me-2">Delete</button>
                    <a href="./Schedule.php?viewid=<?php echo $row['MedicareNbr'] ?>&facilityName=<?php echo $fName; ?>/"> <button type="button" class="btn btn-danger">Cancel</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
include_once "./footer.php";
