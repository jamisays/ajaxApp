<?php 
    include("db.php");
    // if($connection) {
    //     echo "200 ok";
    // }
    $result = $_POST['search'];
    if(!empty($result)) {
        $query = "select * from cars where car_title like '%$result%'";
        $search_query = mysqli_query($connection, $query);
        if(!$search_query) {
            die('failed' . mysqli_error($connection));
        }
        $count = mysqli_num_rows($search_query);

        if($count >= 1) {
            while($row = mysqli_fetch_array($search_query)) {
                $brand = $row['car_title'];
                ?>
                <ul class="list-unstyled">
                    <?php
                        echo "<li>{$brand} available!</li>";
                    ?>    
                </ul>

            <?php }
        }
        else {
            echo "Not Available!";
        } 
        
        
    }

 ?>