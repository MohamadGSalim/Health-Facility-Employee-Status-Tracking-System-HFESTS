<?php
include_once "config.php";

if(isset($_POST['submit'])){
    $name = $_POST['facilityName'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];
    $address = explode(" ",$_POST['address'],2);
    $postal = $_POST['postal'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $manager = $_POST['Manager'];

    if(empty($manager)){
        $manager = "NULL";
    }

    $addnum = $address[0];
    $addName = $address[1];

    function facilityFieldsEmpty($name,$phone,$web,$capacity,$streetnum,$streetname,$province){
        if(empty($name) || empty($phone) ||empty($web) ||empty($capacity) ||empty($streetnum) ||empty($streetname) ||empty($province)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function addressExists($conn,$streetnum,$streetname){
        $sql = "SELECT * FROM Address WHERE StreetNbr = '$streetnum' AND StreetName = '$streetname'";
        $result = mysqli_query($conn,$sql);
        $rowcount=mysqli_num_rows($result);
        return ($rowcount > 0);
    }

    function facilityExists($conn,$name){
        $sql = "SELECT * FROM Facility WHERE Name = '$name'";
        $result = mysqli_query($conn,$sql);
        $rowcount=mysqli_num_rows($result);
        return ($rowcount > 0);
    }

    function addFacility($conn,$name,$phone,$website,$type,$capacity,$streetnum,$streetname,$postal,$province,$city,$manager){
        $sql1 = "INSERT INTO address_general(PostalCode,City,Province) VALUES('$postal','$city','$province')";
        $result = mysqli_query($conn,$sql1);
        $sql2 = "INSERT INTO Address(StreetNbr,StreetName,PostalCode) VALUES('$streetnum','$streetname','$postal')";
        $result = mysqli_query($conn,$sql2);
        if($result){
            $sql = "INSERT INTO Facility(Name, Phone, WebAddress, Type, Capacity, StreetNbr, StreetName,Manager) VALUES('$name','$phone','$website','$type','$capacity','$streetnum','$streetname',$manager)";
            $result = mysqli_query($conn,$sql);
            if($result){
                header("location: ./Facilities.php?error=none");
                exit();
            }else {
                header("location: ./addFacility.php?error=databaseerror");
                exit();
            }
        } else {
            header("location: ./addFacility.php?error=databaseerror");
            exit();
        }
    }

    if(facilityFieldsEmpty($name,$phone,$website,$capacity,$addnum,$addName,$province)){
        header("location: ./addFacility.php?error=EmptyFields");
        exit();
    }

    if(facilityExists($conn,$name)){
        header("location: ./addFacility.php?error=FacilityExists");
        exit();
    } 

    if(addressExists($conn,$addnum,$addName)){
            header("location: ./addFacility.php?error=AddressTaken");
            exit();
    }

    addFacility($conn,$name,$phone,$website,$type,$capacity,$addnum,$addName,$postal,$province,$city,$manager);
    echo mysqli_error($conn);
}