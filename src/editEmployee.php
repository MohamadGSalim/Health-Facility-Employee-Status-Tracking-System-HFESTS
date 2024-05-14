<?php
include_once "./header.php";
$id = $_GET['editid'];
$id = strtok($id, '&');?>
<?php
$sql = "SELECT * FROM Employee WHERE MedicareNbr = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql2 = "Select a.PostalCode FROM Address as a JOIN Employee as e ON a.StreetName = e.StreetName WHERE e.MedicareNbr ='$id'";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result);
?>
<div class="container">
	<h1>Edit <?php echo $row['MedicareNbr']; ?> Profile</h1>
	<form action="editEmployee.include.php" method="POST">
		<div class="mb-3 mt-3">
			<label for="firstName" class="form-label">First Name</label>
			<input type="text" class="form-control" id="firstName" name="firstName" value= "<?php echo $row['FirstName']; ?>" required>
		</div>
		<div class="mb-3 mt-3">
			<label for="lastName" class="form-label">Last Name</label>
			<input type="text" class="form-control" id="lastName" name="lastName" value= "<?php echo $row['LastName']; ?>" required>
		</div>
		<div class="mb-3 mt-3">
			<label for="dateOfBirth" class="form-label">Date Of Birth</label>
			<input type="date" min="1900-01-01" max="2023-05-01" class="form-control" id="dateOfBirth" name="dateOfBirth" value= "<?php echo $row['DOB']; ?>"required>
			<input type="hidden" class="form-control" id="medicareNbr" name="medicareNbr" value= "<?php echo $row['MedicareNbr']; ?>" >
		</div>
		<div class="mb-3 mt-3">
			<label for="phone" class="form-label">Phone</label>
			<input type="text" pattern="[0-9]{10}" class="form-control" id="phone" name="phone" value= "<?php echo implode('',explode('-',$row['Phone'])) .'';?>"required>
		</div>
		<div class="mb-3 mt-3">
			<label for="citizenship" class="form-label">Citizenship</label>
			<input type="text" class="form-control" id="citizenship" name="citizenship" value= "<?php echo $row['Citizenship']; ?>"required>
		</div>
		<div class="form-outline mt-3 mb-3">
			<label class="email" for="email">Email</label>
			<input type="email" placeholder="user@example.com" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" class="form-control" id="email" name="email" value= "<?php echo $row['Email']; ?>" required />
		</div>
		<div class="mb-3 mt-3">
			<label for="sNum" class="form-label">Street Number</label>
			<input type="text" class="form-control" id="sNum" name="sNum" value= "<?php echo $row['StreetNbr']; ?>" required>
		</div>
		<div class="mb-3 mt-3">
			<label for="sName" class="form-label">Street Name</label>
			<input type="text" class="form-control" id="sName" name="sName" value="<?php echo $row['StreetName']; ?>"required>
			<input type="hidden" class="form-control" id="postal" name="postal" value= "<?php echo $row2["PostalCode"]; ?>">

		</div>
		<div class="mt-3">
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
			<a href="Employees.php"> <button type="button" class="btn btn-outline-danger">Cancel</button></a>
        </div>
	</form>
</div>
<?php
include_once "./footer.php";