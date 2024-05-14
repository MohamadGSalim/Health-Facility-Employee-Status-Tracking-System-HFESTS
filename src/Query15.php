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
$sql = "with all_hours AS(
Select Employee. FirstName AS FirstName, Employee.LastName AS LastName, Employee.Dob AS Dob, Employee.Email AS Email, 
SUM(TIMEDIFF( schedule.EndTime, schedule.StartTime)) /10000 as hours_worked, Min(schedule.date) as frist_work_day 
FROM Employee inner join  schedule  on Employee. MedicareNbr= schedule.MedicareNbr inner join worksAt on Employee. MedicareNbr =worksAt. MedicareNbr 
WHERE   worksAt.endDate IS NULL and worksAt.Role='Nurse' AND ((worksAt.EndDate is null and worksAt.StartDate <schedule.Date )or (worksAt.EndDate is not null and worksAt.EndDate>schedule.Date ) )
 GROUP BY Employee.MedicareNbr )
 select  *
 from  all_hours ORDER BY hours_worked DESC LIMIT 1";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $first = $row['FirstName'];
        $last = $row['LastName'];
        $dob = $row['Dob'];
        $email = $row['Email'];
        $hours = $row['hours_worked'];
        $firstDay = $row['frist_work_day'];
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