<?php
    require("config.php");

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_GET)) {
            
            function display_awards() {
                $option = $_GET['option'];
                $name = $_GET['name'];

                echo '<div class="datagrid">';
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                

                if($option == "movie") { 
                    echo '<th>Award Name</th><th>Category</th><th>Year</th><th>Organisation</th><th>Description</th><th>Fname</th><th>Lname</th><th>Job Title</th><th>Age</th><th>Origin</th>';
                    echo '<th></th></tr></thead><tbody>';
                    $query = "  select b.award_name,i.category, i.year, b.organisation, b.description, c.art_fname, c.art_lname, c.job_title, c.age, c.origin
                                from movie_artist_award_table i, movie_table a, award_table b, artist_table c
                                where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
                                and a.mname = '$name'";
                    //echo $query;
                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['award_name'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['organisation'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>".$row['art_fname']."</td>";
                        echo "<td>".$row['art_lname']."</td>";
                        echo "<td>".$row['job_title']."</td>";
                        echo "<td>".$row['age']."</td>";
                        echo "<td>".$row['origin']."</td>";

                        echo "</tr>";

                    }
                }       
                elseif ($option == "artist") {
                    echo '<th>Award Name</th><th>Category</th><th>Year</th><th>Organisation</th><th>Description</th><th>Movie Name</th><th>Genre</th><th>Rating</th>';
                    echo '</tr></thead><tbody>';

                    list($fname, $lname) = explode(' ', $name);

                    $query = "  select b.award_name, i.category, i.year, b.organisation, b.description, a.mname, a.genre, a.rating
                                from movie_artist_award_table i, movie_table a, award_table b, artist_table c
                                where i.movie_id=a.movie_id and i.award_id=b.award_id and i.artist_id=c.artist_id
                                and c.art_fname = '$fname' and c.art_lname = '$lname'";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['award_name'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['organisation'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['mname'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";

                        echo "</tr>";

                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
                display_awards();

        }
    }
?>