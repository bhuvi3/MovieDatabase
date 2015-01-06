<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_GET)) {
            
            function display_movies() {
                $option = $_GET['option'];
                $name = $_GET['name'];

                echo '<div class="datagrid">';
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                

                if($option == "awards") { 
                    echo '<th>Movie Name</th><th>Duration</th><th>Language</th><th>Genre</th><th>Release Year</th><th>Category</th><th>Year</th><th>Fname</th><th>Lname</th><th>Rating</th><th>Num of Ratings</th>';
                    echo '<th></th></tr></thead><tbody>';
                    $query = "  select joined.movie_name, joined.duration, joined.language, joined.genre, joined.release_date, joined.category, joined.year, joined.fname, joined.lname, joined.rating, joined.num_of_ratings
                                from (select a.mname movie_name, a.duration duration, a.language language, a.genre genre, a.release_date release_date , b.category category, b.year year, c.art_fname fname, c.art_lname lname, d.award_name award,  a.rating rating, a.num_of_ratings num_of_ratings, a.num_of_reviews num_of_reviews
                                from movie_table a, movie_artist_award_table b, artist_table c, award_table d 
                                where a.movie_id=b.movie_id and b.artist_id=c.artist_id and b.award_id=d.award_id) joined 
                                where joined.award='$name'";
                    //echo $query;
                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>".$row['movie_name']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td>".$row['language']."</td>";
                        echo "<td>".$row['genre']."</td>";
                        echo "<td>".$row['release_date']."</td>";
                        echo "<td>".$row['category']."</td>";
                        echo "<td>".$row['year']."</td>";
                        echo "<td>".$row['fname']."</td>";
                        echo "<td>".$row['lname']."</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['num_of_ratings'] . "</td>";

                        echo "</tr>";

                    }
                }       
                elseif ($option == "artists") {
                    echo '<th>Movie Name</th><th>Genre</th><th>Suggested Audience</th><th>Release Year</th><th>Duration</th><th>Language</th><th>Rating</th><th>Num of Ratings</th>';
                    echo '</tr></thead><tbody>';

                    list($fname, $lname) = explode(' ', $name);

                    $query = "  select jj.movie_name, jj.genre, gg.suggested_audience, jj.release_date, jj.duration, jj.language, jj.rating, jj.num_of_ratings
                                from 
                                (select joined.movie_name movie_name, joined.genre genre, joined.release_date release_date, joined.duration duration, joined.language language, joined.rating rating, joined.num_of_ratings num_of_ratings, joined.num_of_reviews num_of_reviews from
                                (select a.mname movie_name, a.duration duration, a.language language, a.genre genre, a.release_date release_date, a.rating rating, a.num_of_ratings num_of_ratings, a.num_of_reviews num_of_reviews, b.art_fname fname, b.art_lname lname
                                from movie_artist_table i, movie_table a, artist_table b
                                where i.movie_id = a.movie_id and b.artist_id = i.artist_id) joined
                                where joined.fname = '$fname' and joined.lname = '$lname') jj, genre_table gg
                                where jj.genre = gg.genre_name";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['movie_name'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['suggested_audience'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['num_of_ratings'] . "</td>";

                        echo "</tr>";

                    }

                }
                elseif ($option == "genre") {
                    echo '<th>Movie Name</th><th>Release Year</th><th>Duration</th><th>Language</th></tr></thead><tbody>';
                    $query = "  select mname, release_date, duration, language
                                from movie_table
                                where genre = '$name'";
                    //echo $query;
                    require("db.php");
                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        printf("error: %s\n", mysqli_error());
                    }

                    $num = mysqli_num_rows($result);
                    //echo $num;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['mname']."</td>";
                        echo "<td>".$row['release_date']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td>".$row['language']."</td>";
                        echo "</tr>";

                    }
                }
                elseif ($option == "language") {
                    echo '<th>Movie Name</th><th>Release Year</th><th>Duration</th><th>Genre</th><th>Rating</th><th>Num of Ratings</th><th>Num of Reviews</th></tr></thead><tbody>';
                    $query = "  select mname, release_date, duration, genre, rating, num_of_ratings, num_of_reviews
                                from movie_table
                                where language = '$name'";
                    require("db.php");
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>".$row['mname']."</td>";
                        echo "<td>".$row['release_date']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td>".$row['genre']."</td>";
                        echo "<td>".$row['rating']."</td>";
                        echo "<td>".$row['num_of_ratings']."</td>";
                        echo "<td>".$row['num_of_reviews']."</td>";

                        echo "</tr>";

                    }
                }
                elseif ($option == "year") {
                    echo '<th>Movie Name</th><th>Duration</th><th>Genre</th><th>Language</th><th>Rating</th><th>Num of Ratings</th><th>Num of Reviews</th></tr></thead><tbody>';
                    $query = "  select mname, duration, genre, language, rating, num_of_ratings, num_of_reviews
                                from movie_table
                                where release_date = '$name'";
                    require("db.php");
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>".$row['mname']."</td>";
                        echo "<td>".$row['duration']."</td>";
                        echo "<td>".$row['genre']."</td>";
                        echo "<td>".$row['language']."</td>";
                        echo "<td>".$row['rating']."</td>";
                        echo "<td>".$row['num_of_ratings']."</td>";
                        echo "<td>".$row['num_of_reviews']."</td>";

                        echo "</tr>";

                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
                display_movies();

        }
    }
?>

<!--doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>DBMS</title>m
        <meta name="description" content="dbms">
        <meta name="author" content="Vinay">
        <link id="bootstrap-css" rel="stylesheet" href="assets/bootstrap.min.css">
        <link rel="stylesheet" href="assets/login.css">
        <link rel="stylesheet" href="assets/table.css">
        <script src="assets/jquery-1.10.2.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
        <style type="text/css">
            html,
            body {
                height: 100%;
                background-color: #333;
            }
            body {
                color: #fff;
                text-align: center;
                text-shadow: 0 0px 0px rgba(0,0,0,.5);
            }
            .site-wrapper {
                display: table;
                width: 100%;
                height: 100%; /* For at least Firefox */
                min-height: 100%;
                -webkit-box-shadow: inset 0 0 100px rgba(0,0,0,.5);
                box-shadow: inset 0 0 100px rgba(0,0,0,.5);
            }
            .foo2 {
                position: relative;
                bottom: 0;
                width: 100%;
            }
            .b {
                position: fixed;
                top: 150px;
                bottom: 0;
                left: 0;
                right: 0;
                margin: 0 auto;
            }
        </style>

    </head>
    <body>
        <?php
            display_movies();
        ?>
    </body>
</html-->