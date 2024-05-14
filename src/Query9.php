<?php
include_once "./header.php";
?>
<div class="container p-5">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="col-md-1 text-center"><h3>Facilites</h3></div>
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
                Facility Name
              </th>
              <th>
                Infection Date
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
$sql = "Select Employee. FirstName, Employee.LastName, worksAt.FacilityName, emp_infected.Date AS infection_date 
FROM Employee INNER JOIN worksAt on Employee.MedicareNbr= worksAt.MedicareNbr
INNER JOIN emp_infected on Employee.MedicareNbr= emp_infected.MedicareNbr WHERE worksAt.Role='Doctor' and emp_infected.Date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() ORDER BY worksAt.FacilityName, Employee. FirstName ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $first = $row['FirstName'];
        $last = $row['LastName'];
        $facility = $row['FacilityName'];
        $date = $row['infection_date'];   
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
    </tr>';
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