<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if(!empty($_GET)) {
            function review() {
                $mname = $_GET['mname'];
                $review = $_GET['review'];

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

                $query = "insert into review_table values('$username', '$movie_id', '$review')";
                //echo $query;
                $result = mysqli_query($conn, $query);

                if($result == false) {
                    echo "Cant review more than once!!!\n";
                    //die("Error" . mysqli_error($conn));
                }
                else {
                    echo "Done!!!";
                }
            }
            review();
        }
    }
?>