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
                Name
              </th>
              <th>
                Phone
              </th>
              <th>
                WebAddress
              </th>
              <th>
                Type
              </th>
              <th>
                Capacity
              </th>
              <th>
                Manager First
              </th>
              <th>
                Manager Last
              </th>
              <th>
                Employees
              </th>
              <th>
                StreetNumber
              </th>
              <th>
                StreetName
              </th>
              <th>
                Postal
              </th>
              <th>
                City
              </th>
              <th>
                Province
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
$sql = "Select Facility.Name, Facility.Phone, Facility.WebAddress, Facility.Type, Facility.Capacity, employee_manager.FirstName AS manager_first_name, 
employee_manager.LastName AS manager_last_name, 
COUNT(worksAt.MedicareNbr),
Facility.StreetNbr, Facility.StreetName, Address.PostalCode, address_general.City, address_general.Province
From Facility left join Employee employee_manager on Facility.Manager= employee_manager.MedicareNbr
left join worksAt on Facility.Name = worksAt.FacilityName
left join Address ON Address.StreetNbr = Facility.StreetNbr AND Address.StreetName = Facility.StreetName inner join address_general on Address. PostalCode = address_general. PostalCode Where worksAt.EndDate IS NULL GROUP BY  Facility.Name ORDER BY address_general.Province, address_general.City, Facility.Type, COUNT(worksAt.MedicareNbr) ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['Name'];
        $phone = $row['Phone'];
        $website = $row['WebAddress'];
        $type = $row['Type'];
        $capacity = $row['Capacity'];
        $streetnum = $row['StreetNbr'];
        $streetname = $row['StreetName'];
        $managerfirst = $row['manager_first_name'];
        $managerlast = $row['manager_last_name'];
        $employees = $row['COUNT(worksAt.MedicareNbr)'];
        $postal = $row['PostalCode'];
        $city = $row['City'];
        $province = $row['Province'];
        echo  '<tr>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">'
              .$name.
            '</p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$phone.'
            </p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$website.'
            </p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$type.'
            </p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$capacity.'
            </p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$managerfirst.'
            </p>
          </div>
        </td>
        <td>
        <div class="ms-2">
          <p class="fw mb-0">
            '.$managerlast.'
          </p>
        </div>
      </td>
      <td>
      <div class="ms-2">
        <p class="fw mb-0">
          '.$employees.'
        </p>
      </div>
    </td>
    <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$streetnum.'
            </p>
          </div>
        </td>
        <td>
          <div class="ms-2">
            <p class="fw mb-0">
              '.$streetname.'
            </p>
          </div>
        </td>
    <td>
    <div class="ms-2">
      <p class="fw mb-0">
        '.$postal.'
      </p>
    </div>
  </td>
  <td>
  <div class="ms-2">
    <p class="fw mb-0">
      '.$city.'
    </p>
  </div>
</td>
<td>
<div class="ms-2">
  <p class="fw mb-0">
    '.$province.'
  </p>
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

