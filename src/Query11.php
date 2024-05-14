<?php
include_once "./header.php";
?>
<div class="container p-5">
<form action="./Query11.php" method="POST">
<div class="col mb-2">
<select id="type" name="type"class="form-select">
<?php
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
                First Name
              </th>
              <th>
                Last Name
              </th>
              <th>
                Role
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
if(isset($_POST['type'])){
$sql = "Select Employee. FirstName, Employee.LastName, worksAt.Role FROM worksAt INNER JOIN Employee on worksAt.MedicareNbr = Employee.MedicareNbr INNER JOIN schedule on Employee.MedicareNbr= schedule.MedicareNbr WHERE (worksAt.Role='Doctor' OR worksAt.Role='Nurse') AND  schedule.Date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() AND worksAt.FacilityName='".$name."' ORDER BY lower(worksAt.Role), Employee. FirstName ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $first = $row['FirstName'];
        $last = $row['LastName'];
        $role = $row['Role'];   
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$first.
          '</p>
        </div>
      </td>
      <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$last.
          '</p>
        </div>
      </td>
      <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$role.
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