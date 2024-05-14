<?php
include_once "./header.php";
?>
    <div class="container p-5">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="col-md-1 text-center"><h3>Facilities</h3></div>
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
                StreetNumber
              </th>
              <th>
                StreetName
              </th>
              <th>
                Manager
              </th>
              <th>
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
           
              <?php
              $sql = 'SELECT * FROM Facility';
              $result = mysqli_query($conn,$sql);
              while($row = mysqli_fetch_assoc($result)){
                $name = $row['Name'];
                $phone = $row['Phone'];
                $website = $row['WebAddress'];
                $type = $row['Type'];
                $capacity = $row['Capacity'];
                $streetnum = $row['StreetNbr'];
                $streetname = $row['StreetName'];
                $manager = $row['Manager'];
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
                      '.$manager.'
                    </p>
                  </div>
                </td>
                <td>
                <a href="./editFacility.php?editid='.$name.'/">
                    <button type="button" class="btn btn-outline-warning">Edit</button>
                </a>
                <a href="./deleteFacility.php?deleteid='.$name.'/">
                    <button type="button" class="btn btn-outline-danger">Delete</button>
                </a>
                </td>
              </tr>';
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
<?php
include_once "./footer.php";
?>
