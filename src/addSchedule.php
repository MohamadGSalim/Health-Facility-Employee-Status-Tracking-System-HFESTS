<?php
include_once "./header.php";
$id = $_GET['addid'];
$id = strtok($id, '/');
$fName = $_GET['facilityName'];
$fName = strtok($fName, '/');
?>
<?php
$sql = "SELECT * FROM Employee WHERE MedicareNbr = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Add NEW Schedule for Employee <?php echo $row['MedicareNbr']; ?></h1>
    <form action="addSchedule.include.php" method="POST">
    <div class="mb-3 mt-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" min="1900-01-01" max= "2099-05-01" class="form-control" id="date" name="date" required>
            <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value= "<?php echo $row['MedicareNbr'] ?>" >
        </div>
        <div class="mb-3 mt-3">
            <label for="Facility" class="form-label">Facility</label>
            <select class="form-select" name="fName" id="fName">
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
            <label for="sTime" class="form-label">Start time</label>
            <input type="time" class="form-control" id="sTime" name="sTime" required>
            <input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value= "<?php echo $id?>" >
        </div>
        <div class="mb-3 mt-3">
            <label for="eTime" class="form-label">End Time</label>
            <input type="time"class="form-control" id="eTime" name="eTime" required>
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
			<a href="./Schedule.php?viewid=<?php echo $id ?>&facilityName=<?php echo $fName;?>/"> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";