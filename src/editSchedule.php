<?php
include_once "./header.php";
$id = $_GET['editid'];
$id = strtok($id, '&');
$fName = $_GET['facilityName'];
$fName = strtok($fName, '&');
$date = $_GET['date'];
$date = strtok($date, '&');
$time = $_GET['stime'];
$time = strtok($time, '/');
$etime = $_GET['etime'];
$etime = strtok($etime, '/');
?>
<?php
$sql = "SELECT * FROM schedule WHERE MedicareNbr = '$id' AND Date='$date' AND StartTime = '$time'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Edit Employee: <?php echo $row['MedicareNbr']; ?> Schedule</h1>
    <form action="editSchedule.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" min="1900-01-01" max="2099-05-01" class="form-control" id="date" name="date" value="<?php echo $row['Date']; ?>" required>
            <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value="<?php echo $row['MedicareNbr']; ?>">
            <input type="hidden" class="form-control" id="name" name="name" value="<?php echo $fName ?>">
            <input type="hidden" class="form-control" id="oldDate" name="oldDate" value="<?php echo $date; ?>">

        </div>
        <div class="mb-3 mt-3">
            <label for="Facility" class="form-label">Facility</label>
            <select class="form-select" name="fName" id="fName" required>
                <option value="<?php echo $row['FacilityName']; ?>" selected disabled hidden><?php echo $row['FacilityName']; ?></option>
                <?php
                $sql = "SELECT DISTINCT f.Name from Facility as f JOIN worksAt as w ON f.Name = w.FacilityName WHERE w.MedicareNbr = '$id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['Name'];
                    echo '<option value="' . $name . '">' . $name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="sTime" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="sTime" name="sTime" value="<?php echo date('H:i', strtotime($time)); ?>" required>
            <input type="hidden" class="form-control" id="oldTime" name="oldTime" value="<?php echo date('H:i', strtotime($time)); ?>" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="eTime" class="form-label">End Time</label>
            <input type="time" class="form-control" id="eTime" name="eTime" value="<?php echo date('H:i', strtotime($etime)); ?>" required>
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
            <a href="./Schedule.php?viewid=<?php echo $id ?>&facilityName=<?php echo $fName; ?>/"> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";
