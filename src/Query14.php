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
                City
              </th>
              <th>
                Number of Facilities
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
$sql = "Select Employee. FirstName, Employee.LastName, address_general.City, COUNT(worksAt.FacilityName) as number_of_facilites FROM address_general
INNER JOIN Address ON  address_general.PostalCode = Address.PostalCode INNER JOIN Employee ON Address. StreetNbr = Employee. StreetNbr 
and Address.StreetName = Employee. StreetName INNER JOIN worksAt on Employee.MedicareNbr = worksAt.MedicareNbr 
WHERE  address_general.province='QC' and worksAt.EndDate IS NULL and worksAt.Role='Doctor' GROUP BY Employee.MedicareNbr 
ORDER BY address_general.City ASC, COUNT(worksAt.FacilityName) DESC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $first = $row['FirstName'];
        $last = $row['LastName'];
        $city = $row['City'];
        $facilities = $row['number_of_facilites'];
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
        .$city.
      '</p>
    </div>
  </td>
  <td>
  <div class="ms-2">
    <p class="fw mb-0">'
      .$facilities.
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