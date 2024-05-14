<?php
include_once "./header.php";
?>

<div class="container p-5">
  <div class="table-wrapper">
    <div class="table-title">
      <div class="col-md-1 text-center">
        <h3>Employees</h3>
      </div>
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
            Medicare Number
          </th>
          <th>
            Phone
          </th>
          <th>
            Citizenship
          </th>
          <th>
            Email
          </th>
          <th>
            StreetNumber
          </th>
          <th>
            StreetName
          </th>
          <th>
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="table-group-divider">

        <?php
        $sql = 'SELECT * FROM Employee';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $fname = $row['FirstName'];
          $lname = $row['LastName'];
          $dob = $row['DOB'];
          $mednum = $row['MedicareNbr'];
          $phone = $row['Phone'];
          $citizenship = $row['Citizenship'];
          $email = $row['Email'];
          $streetnum = $row['StreetNbr'];
          $streetname = $row['StreetName'];
          echo  '<tr>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">'
            . $fname .
            '</p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $lname . '
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $dob . '
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $mednum . '
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $phone . '
                    </p>
                  </div>
                </td>
                <td>
                <div class="ms-2">
                  <p class="fw mb-0">
                    ' . $citizenship . '
                  </p>
                </div>
              </td>
              <td>
              <div class="ms-2">
                <p class="fw mb-0">
                  ' . $email . '
                </p>
              </div>
            </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $streetnum . '
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      ' . $streetname . '
                    </p>
                  </div>
                </td>
                <td>
                <a href="./editEmployee.php?editid=' . $mednum . '">
                    <button type="button" class="btn btn-outline-warning">Edit</button>
                </a>
                <a href="./deleteEmployee.php?deleteid=' . $mednum . '">
                    <button type="button" class="btn btn-outline-danger">Delete</button>
                </a>
                </td>
              </tr>
            ';    
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php
include_once "./footer.php";
?>