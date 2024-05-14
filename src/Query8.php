<?php
include_once "./header.php";
?>
<div class="container p-5">
<form action="./Query8.php" method="POST">
<div class="col mb-2">
<select id="type" name="type"class="form-select" >
<?php
$startdate = $_POST['start'];
$enddate = $_POST['end'];
$sql = "SELECT MedicareNbr From Employee";
$result = mysqli_query($conn,$sql);
if($result){
  while($row = mysqli_fetch_assoc($result)){
    $mednum = $row['MedicareNbr'];
    echo '<option value="'.$mednum.'">'.$mednum.'</option>';
  }
}
?>
</select>
<div class="col">
  <label for="start">Start Date</label>
<input type="date" id="start" name="start"
       <?php
       if(isset($_POST['type'])){
        echo 'value="'.$startdate.'"';
       } else {
        echo 'value="2023-04-08"';
       }
       ?>
       min="0001-01-01" max="3000-12-31">
  <label for="end">End Date</label>
<input type="date" id="end" name="end"
      <?php
       if(isset($_POST['type'])){
        echo 'value="'.$enddate.'"';
       } else {
        echo 'value="2023-04-08"';
       }
       ?>
       min="0001-01-01" max="3000-12-31">
</div>
</div>
  <div class="col">
    <button type="submit" name="submit" class="btn btn-primary">
      Submit
    </button>
  </div>
</form>
</div>
<div class="container p-5">
      <div class="table-wrapper">
        <div class="table-title">
        <?php
        if(isset($_POST['type'])){
        $mednum = intval($_POST['type']);
        echo '<div class="col-md-1 text-center"><h3>'.$mednum.'</h3></div>';
        } else {
        echo '<div class="col-md-1 text-center"><h3>MedicareNumber</h3></div>';
        }
        ?> 
        </div>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Date
              </th>
              <th>
                Start
              </th>
              <th>
                End
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
if(isset($_POST['type'])){
$sql = "Select schedule.FacilityName, DAYOFYEAR(Date) as start_day, StartTime, EndTime from schedule 
where schedule.MedicareNbr=".$mednum." AND schedule.Date BETWEEN '".$startdate."' AND '".$enddate."' ORDER BY schedule.FacilityName, DAYOFYEAR(Date), StartTime ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $facility = $row['FacilityName'];
        $date = $row['start_day'];
        $start = $row['StartTime'];
        $end = $row['EndTime'];
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$facility.
          '</p>
        </div>
      </td>
      <td>
      <div class="ms-2">
        <p class="fw mb-0">'
          .$date.
        '</p>
      </div>
    </td>
    <td>
    <div class="ms-2">
      <p class="fw mb-0">'
        .$start.
      '</p>
    </div>
  </td>
  <td>
  <div class="ms-2">
    <p class="fw mb-0">'
      .$end.
    '</p>
  </div>
</td>
    </tr>';
    }
}
}
?>
          </tbody>
        </table>
      </div>
    </div>

    <?php
include_once "./footer.php";
?>