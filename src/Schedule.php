<?php
include_once "./header.php";
$id = $_GET['viewid'];
$id = strtok($id, '&');
$fName = $_GET['facilityName'];
$fName = strtok($fName, '/');
?>
<div class="container p-5">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="col-md-5 ">
                <h3>Schedule for <?php
                                    $sql = "SELECT * FROM Employee WHERE MedicareNbr = '$id'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['FirstName'] . ' ' . $row['LastName']; ?>
                </h3>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        MedicareNbr
                    </th>
                    <th>
                        FacilityName
                    </th>
                    <th>
                        StartTime
                    </th>
                    <th>
                        EndTime
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php
                $sql = "SELECT * FROM schedule WHERE MedicareNbr = '$id' ORDER BY DATE ASC, EndTime ASC";
                $result = mysqli_query($conn, $sql);
                $rowcount =  mysqli_num_rows($result);
                if (intval($rowcount) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <div class="ms-2">
                                    <p class="fw mb-0">
                                        <?php echo $row['Date']; ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="fw mb-0">
                                        <?php echo $row['MedicareNbr']; ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="fw mb-0">
                                        <?php echo $row['FacilityName']; ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="fw mb-0">
                                        <?php echo $row['StartTime']; ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="ms-2">
                                    <p class="fw mb-0">
                                        <?php echo $row['EndTime']; ?>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <a href="./editSchedule.php?editid=<?php echo $row['MedicareNbr'] ?>&facilityName=<?php echo $fName;?>&date=<?php echo $row['Date'];?>&stime=<?php echo $row['StartTime'];?>&etime=<?php echo $row['EndTime'];?>/">
                                    <button type="button" class="btn btn-outline-warning">Edit</button>
                                </a>
                                <a href="./deleteSchedule.php?deleteid=<?php echo $row['MedicareNbr'] ?>&facilityName=<?php echo $fName;?>&date=<?php echo $row['Date'];?>&time=<?php echo $row['StartTime'];?>/">
                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
        $sql = "SELECT * FROM schedule WHERE MedicareNbr = '$id'";
        $result = mysqli_query($conn, $sql);
        $rowcount =  mysqli_num_rows($result);
        if (intval($rowcount) == 0) { ?>
            <p class="text-center  fw-bold">
                NOT SCHEDULED
            </p>
        <?php
        }
        ?>
        <div class="mt-3">
            <a href="./addSchedule.php?addid=<?php echo $id; ?>&facilityName=<?php echo $fName;?>/">
                <button type="button" class="btn btn-success">Add</button>
            </a>
            <a href="./Query7.php?type=<?php echo $fName ?>&submit="> <button type="button" class="btn btn-outline-primary">Go Back</button></a>
        </div>
    </div>
</div>
<?php
include_once "./footer.php";
?>