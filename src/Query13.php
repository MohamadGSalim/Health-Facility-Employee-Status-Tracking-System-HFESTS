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
                Province
              </th>
              <th>
                Capacity
              </th>
              <th>
                Number of Infected
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
$sql = "Select Facility.Name, address_general.Province as Province, Facility.Capacity, (0) AS number_of_infected FROM address_general 
INNER JOIN Address on address_general.PostalCode = Address.postalCode INNER JOIN Facility on Address.StreetNbr = Facility.StreetNbr AND
 Address.StreetName = Facility.StreetName INNER JOIN worksAt ON Facility.Name = worksAt.FacilityName WHERE  
Not (Facility.Name IN 
 (SELECT DISTINCT worksAt.FacilityName from worksAt inner join Employee on worksAt.MedicareNbr = Employee. MedicareNbr 
 JOIN emp_infected on Employee.MedicareNbr = emp_infected.MedicareNbr WHERE  (worksAt.EndDate is null or worksAt.EndDate BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) and (emp_infected.Date BETWEEN 
 (NOW() - INTERVAL 14 DAY) AND NOW()))) GROUP BY Facility.Name
UNION
Select Facility.Name, address_general.Province as Province, Facility.Capacity, count( distinct worksAt.MedicareNbr) AS number_of_infected FROM address_general 
INNER JOIN Address on address_general.PostalCode = Address.postalCode INNER JOIN Facility on Address.StreetNbr = Facility.StreetNbr AND
 Address.StreetName = Facility.StreetName INNER JOIN worksAt ON Facility.Name = worksAt.FacilityName WHERE  
worksAt.MedicareNbr IN 
 (SELECT DISTINCT worksAt.MedicareNbr from worksAt inner join Employee on worksAt.MedicareNbr = Employee. MedicareNbr 
 JOIN emp_infected on Employee.MedicareNbr = emp_infected.MedicareNbr WHERE  (worksAt.EndDate is null or worksAt.EndDate BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW()) and (emp_infected.Date BETWEEN 
 (NOW() - INTERVAL 14 DAY) AND NOW())) GROUP BY Facility.Name ORDER BY Province, number_of_infected ASC";

$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['Name'];
        $province = $row['Province'];
        $capacity = $row['Capacity'];
        $infected = $row['number_of_infected'];
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$name.
          '</p>
        </div>
      </td>
      <td>
      <div class="ms-2">
        <p class="fw mb-0">'
          .$province.
        '</p>
      </div>
    </td>
    <td>
    <div class="ms-2">
      <p class="fw mb-0">'
        .$capacity.
      '</p>
    </div>
  </td>
  <td>
  <div class="ms-2">
    <p class="fw mb-0">'
      .$infected.
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