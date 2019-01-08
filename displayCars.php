<?php 
    include("db.php");

    $query = "select * from cars";
    $display_cars = mysqli_query($connection, $query);
    if(!$display_cars) {
        die("Error" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($display_cars)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td><a rel='{$row['id']}' href='javascript:void(0)' class='title_link' >{$row['car_title']}</a></td>";
        echo "</tr>";
    }

 ?>

 <script>
     // $('#action-container').hide();

        $(document).ready(function(){

            $('.title_link').on('click', function(){
                $('#action-container').show();
                var id = $(this).attr("rel");
                $.post("process.php", {id : id}, function(data){
                    $('#action-container').html(data);
                });
                
            });
        });
 </script>