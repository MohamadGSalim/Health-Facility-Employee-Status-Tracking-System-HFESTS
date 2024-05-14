<?php
include_once "./header.php";
?>
<div class="container">
    <form action="addFacility.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="facilityName" class="form-label">Facility Name</label>
            <input type="text" class="form-control" id="facilityName" name="facilityName">
        </div>
        <div class="mb-3 mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3 mt-3">
            <label for="website" class="form-label">Web Address</label>
            <input type="text" class="form-control" id="website" name="website" pattern="^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}$" placeholder="www.example.com">
        </div>
        <label for="type" class="form-label">Facility Type</label>
        <select id="type" name="type" class="form-select">
            <option value="Hospital">Hospital</option>
            <option value="CLSC">CLSC</option>
            <option value="Clinic">Clinic</option>
            <option value="Pharmacy">Pharmacy</option>
            <option value="Special">Special Installement</option>
        </select>
        <div class="form-outline mt-3 mb-3">
            <label class="form-label" for="capacity">Number input</label>
            <input type="number" id="capacity" name="capacity" class="form-control" />
        </div>
        <div class="mb-3 mt-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="mb-3 mt-3">
            <label for="postal" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postal" name="postal">
        </div>
        <div class="mb-3 mt-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <label for="type" class="form-label">Province</label>
        <select id="province" name="province" class="form-select">
            <option value="AB">Alberta</option>
            <option value="BC">British Colombia</option>
            <option value="MB">Manitoba</option>
            <option value="NB">New Brunswick</option>
            <option value="NL">Newfoundland</option>
            <option value="NT">Northwest Territories</option>
            <option value="NS">Nova Scotia</option>
            <option value="NU">Nunavut</option>
            <option value="ON">Ontario</option>
            <option value="PE">Prince Edward Island</option>
            <option value="QC">Quebec</option>
            <option value="SK">Saskatchewan</option>
            <option value="YT">Yukon</option>
        </select>
        <div class="mb-3 mt-3">
            <label for="Manager" class="form-label">Manager</label>
            <select class="form-select" name="Manager" id="Manager">
                <?php
                $sql = "SELECT MedicareNbr from Employee";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $med = $row['MedicareNbr'];
                    echo ' <option value="' . $med . '">' . $med . '</option>';
                }
                ?>
                <option value="" selected>None</option>
            </select>
        </div>
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php
include_once "./footer.php";
?>