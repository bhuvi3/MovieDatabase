<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_GET)) {
            
            function display_top3() {
                $option = $_GET['option'];
                $name = $_GET['name'];

                echo '<div class="datagrid">';
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                

                if($option == "genre") { 
                    echo '<th>Movie Name</th><th>Duration</th><th>Language</th><th>Release Year</th><th>Rating</th><th>Num of Ratings</th><th>Num of Reviews</th>';
                    echo '<th></th></tr></thead><tbody>';
                    $query = "  select * from 
                                (select mname, duration, language, release_date, rating, num_of_ratings, num_of_reviews
                                from movie_table
                                where genre='$name'
                                order by rating desc) a
                                limit 3";
                    //echo $query;
                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['num_of_ratings'] . "</td>";
                        echo "<td>" . $row['num_of_reviews'] . "</td>";

                        echo "</tr>";

                    }
                }       
                elseif ($option == "actor") {
                    echo '<th>Movie Name</th><th>Duration</th><th>Language</th><th>Release Year</th><th>Genre</th><th>Rating</th>';
                    echo '</tr></thead><tbody>';

                    list($fname, $lname) = explode(' ', $name);

                    $query = "  select * from
                                (select * from 
                                (select movie_table.mname, movie_table.duration, movie_table.language, movie_table.release_date, movie_table.genre, movie_table.rating rating
                                from movie_artist_table, artist_table, movie_table
                                where artist_table.artist_id=movie_artist_table.artist_id and movie_table.movie_id=movie_artist_table.movie_id
                                and artist_table.art_fname='$fname' and artist_table.art_lname='$lname') joined
                                order by joined.rating desc) b
                                limit 3";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";

                        echo "</tr>";

                    }
                }
                elseif ($option == "rating") {
                    echo '<th>Movie Name</th><th>Duration</th><th>Genre</th><th>Language</th><th>Release Year</th><th>Rating</th>';
                    echo '</tr></thead><tbody>';

                    //list($fname, $lname) = explode(' ', $name);

                    $query = "  select * from
                                (select mname, duration, genre, language, release_date, rating
                                from movie_table
                                order by rating desc) a
                                limit 3";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";

                        echo "</tr>";

                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
                display_top3();

        }
    }
?>