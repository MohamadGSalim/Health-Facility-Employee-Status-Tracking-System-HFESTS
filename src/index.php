<?php
include_once "./header.php";
?>
<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5 " src="assets/img/healthIcon.png" alt="..." />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">IAC353_4 Health Facility DataBase</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <div class="masthead-subheading fw-light mb-0">
            <div class="mt-3">
                <a href="./Facilities.php">
                    <button type="button" class="btn btn-outline-success  btn-xlarge">Facilities</button>
                </a>
                <a href="./Employees.php">
                    <button type="button" class="btn btn-outline-success  btn-xlarge">Employees</button>
                </a>
                <a href="./Vaccinations.php">
                    <button type="button" class="btn btn-outline-success  btn-xlarge">Vaccines</button>
                </a>
                <a href="./Infections.php">
                    <button type="button" class="btn btn-outline-success  btn-xlarge">Infections</button>
                </a>
            </div>
        </div>
        <div class="masthead-subheading fw-light mb-0">
            <div class="mt-3">
                <h3>Do You Want To Schedule an Employee?</h3>
                <a href="./Query7.php">
                    <button type="button" class="btn btn-success  btn-lg">Find Employment</button>
                </a>
            </div>
        </div>
    </div>
</header>

<body>
</body>

<?php
include_once "./footer.php";
?>