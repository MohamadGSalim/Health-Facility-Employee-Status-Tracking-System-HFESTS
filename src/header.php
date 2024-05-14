<?php
include_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css?v=5" rel="stylesheet" />
  <title>IAC353_4 Health Facility Database</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-secondary" id="mainNav">
    <div class="container-fluid text-white-50 ">
      <a class="navbar-brand" href="./index.php">IAC353_4</a>
      <button class="navbar-toggler text-uppercase font-weight-bold text-white rounded bg-info" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-current="page" aria-expanded="false">
              Facilities
            </a>
            <ul class="dropdown-menu ">
              <li><a class="dropdown-item" href="./Facilities.php">View Facilities</a></li>
              <li><a class="dropdown-item" href="./addFacility.php">Add Facility</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-current="page" aria-expanded="false">
              Employees
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./Employees.php">View Employees</a></li>
              <li><a class="dropdown-item" href="./addEmployees.php">Add Employees</a></li>
              <li><a class="dropdown-item" href="./Query7.php">View Employements</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-current="page" aria-expanded="false">
              Vaccinations
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./Vaccinations.php">View Vaccinations</a></li>
              <li><a class="dropdown-item" href="./addVaccinations.php">Add Vaccination</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-current="page" aria-expanded="false">
              Infections
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./Infections.php">View Infections</a></li>
              <li><a class="dropdown-item" href="./addInfection.php">Add Infection</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-current="page" aria-expanded="false">
              Queries
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./Query6.php">View Query6</a></li>
              <li><a class="dropdown-item" href="./Query7.php">View Query7</a></li>
              <li><a class="dropdown-item" href="./Query8.php">View Query8</a></li>
              <li><a class="dropdown-item" href="./Query9.php">View Query9</a></li>
              <li><a class="dropdown-item" href="./Query10.php">View Query10</a></li>
              <li><a class="dropdown-item" href="./Query11.php">View Query11</a></li>
              <li><a class="dropdown-item" href="./Query12.php">View Query12</a></li>
              <li><a class="dropdown-item" href="./Query13.php">View Query13</a></li>
              <li><a class="dropdown-item" href="./Query14.php">View Query14</a></li>
              <li><a class="dropdown-item" href="./Query15.php">View Query15</a></li>
              <li><a class="dropdown-item" href="./Query16.php">View Query16</a></li>
              <li><a class="dropdown-item" href="./Query17.php">View Query17</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>