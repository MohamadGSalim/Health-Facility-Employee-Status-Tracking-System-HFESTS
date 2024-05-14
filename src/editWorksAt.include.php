<?php
include_once './config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $startDate = $_POST['sDate'];
    $endDate = $_POST['endDate'];
    $medicareNbr = $_POST['medicareNbr'];

    /**Helps send a confirmation message and redirectes page 
     * Improvement could be creating a modal and popping up a message
    **/ 
    function func_alert($message,$location){
        //Display alert box 
        global $endDate;
        echo "<script>alert('$message'); </script>";
        echo "<script>window.location = '$location' </script>";
    }
    /**
     * Check to see if the role is unchanged
     */
    function isRoleEmpty($conn,$medicareNbr,$startDate,$name){
        global $role;

        if(empty($role)){
            $sql = "SELECT * FROM worksAT WHERE MedicareNbr = $medicareNbr AND StartDate = $startDate AND FacilityName =$name";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $role = $row['Role'];
        }
    }

    function updateWorksAt($conn, $name, $role, $endDate,$startDate,$medicareNbr)
    {
        $sql = '';
        //tenary operator to decide whether enddate is null or not 
        $endDate = !empty($endDate) ? "'$endDate'" : "NULL";
        $sql = "UPDATE worksAt SET Role ='$role',EndDate=$endDate WHERE StartDate = '$startDate'AND MedicareNbr='$medicareNbr' AND FacilityName = '$name'" ;
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if($endDate != "NULL"){
                    func_alert("Successfully Updated!", "./Query7.php?type=$name&submit=");
                    exit();
                }else{
                    func_alert("Successfully Updated!", "./editWorksAt.php?editid=$medicareNbr/error=none");
                    exit();
                }

            } else {
                func_alert("Failed to Update! Reason: ". mysqli_error($conn), "./editWorksAt.php?editid=$medicareNbr/error=databaseerror1");
                exit();
            }
        }
        isRoleEmpty($conn,$medicareNbr,$startDate,$name);
        updateWorksAt($conn, $name, $role, $endDate,$startDate,$medicareNbr);
        echo mysqli_error($conn);


    }