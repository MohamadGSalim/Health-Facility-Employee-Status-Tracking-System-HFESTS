<?php
include_once "./header.php";
?>
<!-- FORM VALIDATION IS NEEDED im currently testing with patterns using regex-->
<div class="container">
    <form action="addEmployees.include.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="dateOfBirth" class="form-label">Date Of Birth</label>
            <input type="date" min="1900-01-01" max= "2023-05-01" class="form-control" id="dateOfBirth" name="dateOfBirth"required>
        </div>
        <div class="mb-3 mt-3">
            <label for="medicareNbr" class="form-label">Medicare Number</label>
            <input type="text" pattern="[0-9]{9}" class="form-control" id="medicareNbr" name="medicareNbr"required>
        </div>
        <div class="mb-3 mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" pattern="[0-9]{10}" class="form-control" id="phone" name="phone" placeholder="eg. 5141112222" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="citizenship" class="form-label">Citizenship</label>
            <input type="text" class="form-control" id="citizenship" name="citizenship" required>
        </div>
        <div class="form-outline mt-3 mb-3">
            <label class="email" for="email">Email</label>
            <input type="email" placeholder="eg. user@example.com" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class="form-control" id="email" name="email" required/>
        </div>
        <div class="mb-3 mt-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="postal" class="form-label">Postal Code</label>
            <input type="text" class="form-control" pattern="^[ABCEGHJKLMNPRSTVXY][0-9][A-Z][0-9][A-Z][0-9]$" id="postal" name="postal" placeholder="eg. A8A8A8" required>
        </div>
        <div class="mb-3 mt-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" required>
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
        <div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php
include_once "./footer.php";
?>