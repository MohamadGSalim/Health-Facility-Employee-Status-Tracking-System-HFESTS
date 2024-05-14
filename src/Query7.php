<?php
include_once "./header.php";
?>
<div class="container p-5">
  <form action="./Query7.php" method="GET">
    <div class="col mb-2">
      <h4>Find Your Facility</h4>
      <select id="type" name="type" class="form-select">
        <?php
        $sql = "SELECT Name From Facility";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['Name'];
            echo '<option value="' . $name . '">' . $name . '</option>';
          }
        }
        ?>
      </select>
    </div>
    <div class="col">
      <button type="submit" name="submit" class="btn btn-primary">
        Search
      </button>
    </div>
  </form>
</div>
<div class="container p-5">
  <div class="table-wrapper">
    <div class="table-title">
      <?php
      if (isset($_GET['type'])) {
        $name = $_GET['type'];
        echo '<div class="col-md-5"><h3>' . $name . '</h3></div>';
      } else {
        echo '<div class="col-md-5"><h3>Facilities</h3></div>';
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
            Email
          </th>
          <th>
            Citizenship
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
          <th>
            Action
          </th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        if (isset($_GET['type'])) {
          $sql = "Select worksAt.Role as role, Employee. FirstName, Employee.LastName, Employee.DOB AS date_of_birth, Employee. MedicareNbr, Employee.Phone, Employee.Email, Employee.Citizenship,
              Employee.StreetNbr, Employee.StreetName, Address.PostalCode, address_general.City, address_general.Province
              From Employee LEFT JOIN worksAt on Employee.MedicareNbr= worksAt.MedicareNbr
              left join Address ON Address.StreetNbr = Employee.StreetNbr AND Address.StreetName = Employee.StreetName inner join address_general on Address. PostalCode = address_general. PostalCode
              Where worksAt.EndDate IS NULL and worksAt.FacilityName= '" . $name . "'
              ORDER BY lower(worksAt.Role) asc, Employee. FirstName ASC, Employee.LastName ASC";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['role']; ?>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['FirstName']; ?>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['LastName']; ?>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['date_of_birth']; ?>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['MedicareNbr']; ?>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['Phone']; ?></p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['Email']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['Citizenship']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['StreetNbr']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['StreetName']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['PostalCode']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['City']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      <?php echo $row['Province']; ?></p>
                    </p>
                  </div>
                </td>
                <td>
                  <a href="./editWorksAt.php?editid=<?php echo $row['MedicareNbr'] ?>/">
                    <button type="button" class="btn btn-outline-warning">Edit</button>
                  </a>
                  <a href="./Schedule.php?viewid=<?php echo $row['MedicareNbr']; ?>&facilityName=<?php if (isset($_GET['type'])) {
                                                                                                    $name = $_GET['type'];
                                                                                                    echo $name;
                                                                                                  } ?>/" <button type="button" class="btn btn-outline-primary">Schedule</button>
                  </a>
                </td>
              </tr>
        <?php
            }
          }
        } ?>
      </tbody>
    </table>
    <div class="mt-3">
      <a href="./addWorksAt.php?addid=<?php if (isset($_GET['type'])) {
                                        $name = $_GET['type'];
                                        echo $name;
                                      } ?>/">
        <button type="button" class="btn btn-success">Add Employement</button>
      </a>
    </div>
  </div>
</div>


<?php
include_once "./footer.php";
?>