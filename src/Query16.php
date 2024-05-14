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
                Medicare Number
              </th>
              <th>
                First Name
              </th>
              <th>
                Last Name
              </th>
              <th>
                Role
              </th>
              <th>
                Date of Birth
              </th>
              <th>
                Email
              </th>
              <th>
                Hours Worked
              </th>
              <th>
                First Day
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
$sql = "Select Employee.MedicareNbr as MedicareNbr, Employee.FirstName as FirstName, Employee.LastName as LastName, worksAt.Role as Role,
Employee.Dob as Dob, Employee.Email as Email,(NULL) as start_date, 
(0) as hours_worked from Employee inner join worksAt on Employee.MedicareNbr= worksAt.MedicareNbr 
inner join Facility on worksAt.FacilityName = Facility.Name  where worksAt.endDate is null and  (worksAt.Role='Doctor' OR worksAt.Role='Nurse')  
AND (NOT Employee.MedicareNbr in (select schedule.MedicareNbr from schedule inner join 
Employee on schedule.MedicareNbr = Employee.MedicareNbr inner join worksAt on Employee.MedicareNbr =worksAt.MedicareNbr where worksAt.EndDate 
is null and (worksAt.Role='Doctor' OR worksAt.Role='Nurse')))
AND (Employee. MedicareNbr IN (Select Employee.MedicareNbr from Employee inner join emp_infected on Employee.MedicareNbr = emp_infected.MedicareNbr 
WHERE emp_infected.InfectionType='COVID-19' GROUP BY Employee. MedicareNbr HAVING count(emp_infected. MedicareNbr) >=3)) GROUP BY Employee.MedicareNbr 
UNION 
Select Employee.MedicareNbr as MedicareNbr, Employee.FirstName as FirstName, Employee.LastName as LastName, worksAt.Role as Role,
Employee.Dob as Dob, Employee.Email as Email,Min(schedule.date) as start_date,
SUM(TIMEDIFF( schedule.EndTime, schedule.StartTime))/10000 as hours_worked 
from Employee inner join worksAt on Employee.MedicareNbr= worksAt.MedicareNbr 
inner join Facility on worksAt.FacilityName = Facility.Name inner join schedule on Facility.Name = schedule.FacilityName 
and worksAt.MedicareNbr = schedule.MedicareNbr where worksAt.endDate is null and  (worksAt.Role='Doctor' OR worksAt.Role='Nurse')  
AND ((worksAt.EndDate is null and worksAt.StartDate <schedule.Date )or (worksAt.EndDate is not null and worksAt.EndDate>schedule.Date ) )
AND (Employee. MedicareNbr IN (Select Employee.MedicareNbr from Employee inner join emp_infected on Employee.MedicareNbr = emp_infected.MedicareNbr 
WHERE emp_infected.InfectionType='COVID-19' group BY Employee. MedicareNbr HAVING count(emp_infected. MedicareNbr) >=3)) GROUP BY Employee.MedicareNbr 
ORDER BY lower(Role),  FirstName, LastName ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $mednum = $row['MedicareNbr'];
        $first = $row['FirstName'];
        $last = $row['LastName'];
        $role = $row['Role'];
        $dob = $row['Dob'];
        $email = $row['Email'];
        $hours = $row['hours_worked'];
        $firstDay = $row['frist_work_day'];
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$mednum.
          '</p>
        </div>
      </td>
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
<td>
<div class="ms-2">
  <p class="fw mb-0">'
    .$dob.
  '</p>
</div>
</td>
<td>
<div class="ms-2">
  <p class="fw mb-0">'
    .$email.
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
<td>
<div class="ms-2">
  <p class="fw mb-0">'
    .$firstDay.
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