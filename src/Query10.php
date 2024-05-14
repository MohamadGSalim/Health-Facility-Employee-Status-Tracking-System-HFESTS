<?php
include_once "./header.php";
?>

<div class="container p-5">
  <form method="POST" action="./Query10.php">
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
          <div class="col-md-1 text-center"><h3>Facilites</h3></div>
        </div>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>
                Mail ID
              </th>
              <th>
                Body
              </th>
              <th>
                Date
              </th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
<?php
if(isset($_POST['submit'])){
  $facility = $_POST['type'];
}
$sql = "Select email.mailId, email.body, email_log.Date as date FROM email inner join  email_log on email.mailId = email_log.mailId where FacilityName='$facility' ORDER BY email_log.Date ASC";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['mailId'];
        $body = $row['body'];
        $date = $row['date'];
    echo '<tr>
    <td>
        <div class="ms-2">
          <p class="fw mb-0">'
            .$id.
          '</p>
        </div>
      </td>
      <td>
      <div class="ms-2">
        <p class="fw mb-0">'
          .$body.
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