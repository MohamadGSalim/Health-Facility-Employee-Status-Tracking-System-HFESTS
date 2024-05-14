<?php
include_once "./header.php";
?>
<div class="container p-5">
<form action="./Query12.php" method="POST">
<div class="col mb-2">
<select id="type" name="type"class="form-select">
<?php
$startdate = $_POST['start'];
$enddate = $_POST['end'];
$sql = "SELECT Name From Facility";
$result = mysqli_query($conn,$sql);
if($result){
  while($row = mysqli_fetch_assoc($result)){
    $name = $row['Name'];
    echo '<option value="'.$name.'">'.$name.'</option>';
  }
}
?>
</select>
<div class="col">
  <label for="start">Start Date</label>
<input type="date" id="start" name="start"
       value="2023-04-08"
       min="0001-01-01" max="3000-12-31">
  <label for="end">End Date</label>
<input type="date" id="end" name="end"
      value="2023-04-08"
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
        $name = $_POST['type'];
        echo '<div class="col-md-1 text-center"><h3>'.$name.'</h3></div>';
        } else {
        echo '<div class="col-md-1 text-center"><h3>Facilites</h3></div>';
        }
        ?> 
        </div>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>
                Role
              </th>
              <th>
                Hours
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
if(isset($_POST['type'])){
$sql = "Select worksAt.Role,SUM(TIMEDIFF( schedule.EndTime, schedule.StartTime))/10000 as hours_num
FROM schedule INNER JOIN Employee on schedule.MedicareNbr= Employee.MedicareNbr 
INNER JOIN worksAt on Employee.MedicareNbr= worksAt.MedicareNbr  and schedule.FacilityName= worksAt.FacilityName
WHERE ( schedule.Date BETWEEN '".$startdate."' AND '".$enddate."') AND ((worksAt.EndDate is null and worksAt.StartDate <schedule.Date )or (worksAt.EndDate is not null and worksAt.EndDate>schedule.Date ) )
AND schedule.FacilityName='".$name."' GROUP BY worksAt.Role ORDER BY lower(worksAt.Role) asc";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $role = $row['Role'];
        $hours = $row['hours_num'];
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$role.
          '</p>
        </div>
      </td>
      <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$hours.
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