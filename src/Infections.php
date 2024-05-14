<?php
include_once "./header.php";
?>
    <div class="container p-5">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="col-md-1 text-center"><h3>Infections</h3></div>
        </div>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>
                Medicare Number
              </th>
              <th>
                Infection Type
              </th>
              <th>
                Date
              </th>
              <th>
                Actions
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
           
              <?php
              $sql = 'SELECT * FROM emp_infected';
              $result = mysqli_query($conn,$sql);
              while($row = mysqli_fetch_assoc($result)){
                $mednum = $row['MedicareNbr'];
                $infection = $row['InfectionType'];
                $date = $row['Date'];
                echo  '<tr>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">'
                      .$mednum.
                    '</p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      '.$infection.'
                    </p>
                  </div>
                </td>
                <td>
                  <div class="ms-2">
                    <p class="fw mb-0">
                      '.$date.'
                    </p>
                  </div>
                </td>
                <td>
                <a href="./editInfection.php?editid='.$mednum.'&infection='.$infection.'&date='.$date.'">
                    <button type="button" class="btn btn-outline-warning">Edit</button>
                </a>
                <a href="./deleteInfection.php?deleteid='.$mednum.'&infection='.$infection.'&date='.$date.'">
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