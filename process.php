<?php 
    include("db.php");

    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "select * from cars where id = {$id}";
        $display_cars = mysqli_query($connection, $query);
        if(!$display_cars) {
            die("Error" . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_array($display_cars)) {

            echo "<p id='update-notification' class='bg-success text-white text-center'></p>";
            echo "<input type='text' rel='".$row['id']."' class='form-control title_input' value='".$row['car_title']."'>";
            echo "<input type='button' class='btn btn-success btn-block update' value='Update'>";
            echo "<input type='button' class='btn btn-danger btn-block delete' value='Delete'>";
            echo "<input type='button' class='btn btn-dark btn-block' value='Close'>";
        }
    }

    if (isset($_POST['updateCar'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];

        $query = "update cars set car_title = '$title' where id = '$id'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Failed" . mysqli_error($connection));
        }
    }

    if (isset($_POST['deleteCar'])) {
        $id = $_POST['id'];

        $query = "delete from cars where id = '$id'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Failed" . mysqli_error($connection));
        }
    }

 ?>

 <script>
     $(document).ready(function(){

        var id;
        var title;
        var updateCar = "updateCar";
        var deleteCar = "deleteCar";

        $('.title_input').on('input', function(){
            id = $(this).attr('rel');
            title = $(this).val();
            // alert(title);
        });

        $(".update").on('click', function(){
            $.post("process.php", {id: id, title: title, updateCar: updateCar}, function(data){
                $('#update-notification').text("Updated Successfully!");
            });
        });

        $(".delete").on('click', function(){
            if(confirm('Are You sure?')) {
                id = $(".title_input").attr('rel');
                $.post("process.php", {id: id, deleteCar: deleteCar}, function(data){
                    $('#update-notification').text("Deleted Successfully!");
                    $("#action-container").hide();
                    $('.title_input').val("");
                });
            }
        });

        $(".btn-dark").on('click', function(){
            $("#action-container").hide();
        });

     });
 </script>