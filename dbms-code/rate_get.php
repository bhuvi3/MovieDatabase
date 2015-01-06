<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if(!empty($_GET)) {
            function rate_movie() {
                $mname = $_GET['mname'];
                $rating = $_GET['rating'];

                $query = "  select movie_id from movie_table
                            where mname = '$mname'";
                require("db.php");

                $result = mysqli_query($conn, $query);

                if($result == false) {
                    echo "Movie Not Found";
                }

                $row = mysqli_fetch_assoc($result);

                $movie_id = $row['movie_id'];
                $username = $_SESSION['user'];

                $query = "CALL RATING_INSERT('$username', '$movie_id', '$rating');";
                //echo $query;

                $result = mysqli_query($conn, $query);

                if($result == false) {
                    echo "Cant rate more than once!!!";
                    //die("Error" . mysqli_error($conn));
                }
                else {
                    echo "Done!!!";
                }
            }
            rate_movie();
        }
    }
?>