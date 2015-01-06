<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_GET)) {
            
            function display_artists() {
                $option = $_GET['option'];
                $name = $_GET['name'];

                echo '<div class="datagrid">';
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                

                if($option == "movie") { 
                    echo '<th>Fname</th><th>Lname</th><th>Job Title</th><th>Age</th><th>Origin</th>';
                    echo '<th></th></tr></thead><tbody>';
                    $query = "  select artist_table.art_fname, artist_table.art_lname, artist_table.job_title, artist_table.age, artist_table.origin
                                from movie_artist_table
                                inner join artist_table
                                on artist_table.artist_id=movie_artist_table.artist_id
                                inner join movie_table
                                on movie_table.movie_id=movie_artist_table.movie_id
                                where movie_table.mname='$name'";
                    //echo $query;
                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>".$row['art_fname']."</td>";
                        echo "<td>".$row['art_lname']."</td>";
                        echo "<td>".$row['job_title']."</td>";
                        echo "<td>".$row['age']."</td>";
                        echo "<td>".$row['origin']."</td>";

                        echo "</tr>";

                    }
                }       
                elseif ($option == "award") {
                    echo '<th>Fname</th><th>Lname</th><th>Category</th><th>Year</th><th>Job Title</th><th>Age</th><th>Origin</th><th>Movie Name</th><th>Genre</th><th>Language</th><th>Release Year</th><th>Duration</th><th>Rating</th><th>Num of Ratings</th>';
                    echo '</tr></thead><tbody>';

                    //list($fname, $lname) = explode(' ', $name);

                    $query = "  select c.art_fname, c.art_lname, i.category, i.year, c.job_title, c.age, c.origin, a.mname, a.genre, a.language, a.release_date, a.duration, a.rating, a.num_of_ratings
                                from movie_artist_award_table i, movie_table a, award_table b, artist_table c
                                where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
                                and b.award_name='$name'";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['art_fname'] . "</td>";
                        echo "<td>" . $row['art_lname'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['job_title'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['origin'] . "</td>";
                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['num_of_ratings'] . "</td>";

                        echo "</tr>";

                    }

                }
                elseif ($option == "genre") {
                    echo '<th>Fname</th><th>Lname</th><th>Category</th><th>Year</th><th>Job Title</th><th>Age</th><th>Origin</th><th>Movie Name</th><th>Genre</th><th>Language</th><th>Release Year</th><th>Duration</th><th>Rating</th><th>Num of Ratings</th>';
                    echo '</tr></thead><tbody>';

                    list($award, $genre) = explode(', ', $name);


                    $query = "  select c.art_fname, c.art_lname, i.category, i.year, c.job_title, c.age, c.origin, a.mname, a.genre, a.language, a.release_date, a.duration, a.rating, a.num_of_ratings, a.num_of_reviews
                                from movie_artist_award_table i, movie_table a, award_table b, artist_table c
                                where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
                                and b.award_name='$award' and a.genre='$genre'";
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

                        echo "<td>" . $row['art_fname'] . "</td>";
                        echo "<td>" . $row['art_lname'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['job_title'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['origin'] . "</td>";
                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['num_of_ratings'] . "</td>";

                        echo "</tr>";

                    }
                }
                elseif ($option == "job") {
                    echo '<th>Fisrt Name</th><th>Last Name</th><th>Age</th><th>Origin</th>';
                    echo '</tr></thead><tbody>';
                    
                    $query = "  select art_fname, art_lname, age, origin from artist_table
                                where job_title='$name'";
                    require("db.php");
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['art_fname'] . "</td>";
                        echo "<td>" . $row['art_lname'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['origin'] . "</td>";

                        echo "</tr>";

                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
                display_artists();

        }
    }
?>