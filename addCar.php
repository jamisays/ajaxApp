<?php 
    include("db.php");

    if(isset($_POST['carName']) && !empty($_POST['carName'])) {
        $car = $_POST['carName'];
        $query = "insert into cars(car_title) values('$car')";
        $add_car_query = mysqli_query($connection, $query);
        if(!$add_car_query) {
            die("Error occured!" . mysqli_error($connection));
        }
        // header("Location: index.php");
    }

 ?>