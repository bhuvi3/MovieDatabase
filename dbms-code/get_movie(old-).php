<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    require("config.php");

    //echo $conn;

    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_POST)) {
            
            function display_movies() {
                $option = $_POST['option'];
                $name = $_POST['name'];

                echo '<div class="datagrid">';
                echo '<table>';
                echo "<thead>";
                echo "<tr>";
                echo '<th>Movie Name</th><th>Genre</th><th>Release Year</th><th>Duration</th><th>Language</th>';

                if($option == "awards") { 
                    echo '<th></th></tr></thead><tbody>';
                    $query = "";

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>".$row['mname']."</td>";
                        echo "<td>".$row['myear']."</td>";
                        //Add here
                        echo "</tr>";

                    }
                }       
                elseif ($option == "artists") {
                    echo '</tr></thead><tbody>';

                    list($fname, $lname) = explode(' ', $name);

                    $query = "select joined.movie_name, joined.genre, joined.release_date, joined.duration, joined.language, joined.rating, joined.num_of_ratings, joined.num_of_reviews from
                                (select a.mname movie_name, a.duration duration, a.language language, a.genre genre, a.release_date release_date, a.rating rating, a.num_of_ratings num_of_ratings, a.num_of_reviews num_of_reviews, b.art_fname fname, b.art_lname lname
                                from movie_artist_table i, movie_table a, artist_table b
                                where i.movie_id = a.movie_id and b.artist_id = i.artist_id) joined
                                where joined.fname = '$fname' and joined.lname = '$lname'";

                    require("db.php");

                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        echo "gg";
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                        echo "<td>" . $row['movie_name'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $row['release_date'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "<td>" . $row['language'] . "</td>";
                        //Add here
                        echo "</tr>";

                    }

                }
                elseif ($option == "genre") {
                    echo '<th></th></tr></thead><tbody>';
                    $query = "select `genre_name` from `genre_table`";
                    echo $query;
                    require("db.php");
                    $result = mysqli_query($conn, $query);

                    if($result == false) {
                        printf("error: %s\n", mysqli_error());
                    }

                    $num = mysqli_num_rows($result);
                    echo $num;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['genre_name']."</td>";
                        //Add here
                        echo "</tr>";

                    }
                }
                else {
                    echo '<th></th></tr></thead><tbody>';
                    $query = "";

                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";

                       echo "<td>".$row['movie_id']."</td>";
                       echo "<td>".$row['mname']."</td>";
                       echo "<td>".$row['myear']."</td>";
                       //Add here
                        echo "</tr>";

                    }
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            //display_movies();

        }
    }
?>

<!doctype html>
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
    <body>m
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">Movie Database</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">User<span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="download">
                            <li><a href="logout.php" target="_blank">Logout</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="site-wrapper">
            <div class="container">
                <div class="col-md-2">
                    <br><br><br>
                    <div class="list-group">
                        <a class="list-group-item" href="get_movie.php">Get Movies</a>
                        <a class="list-group-item" href="#">Get Artists</a>
                        <a class="list-group-item" href="#">Get Awards</a>
                        <a class="list-group-item" href="#">Get Awards by genre</a>
                        <a class="list-group-item" href="#">Get Top 3 Movies</a>
                    </div> 
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <br><br><br>
                    <div class="form-wrap">
                        <h1>Get Movies by : </h1>
                        <form role="form" action="get_movie.php" method="post" id="get-form" autocomplete="off">
                        <div class="form-group">    
                            <select name="option" id="select" class="form-control">
                                <option value="awards">Awards</option>
                                <option value="artists">Artists</option>
                                <option value="genre">Genre</option>
                                <option value="seq">Sequel/Prequel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text" class="sr-only">Query</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Get!!!">
                    </form>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="container-fluid">
                 <div class="col-md-10 col-md-offset-1">   
                    <?php
                        display_movies();
                    ?>
                </div>
            </div>
            <br><br><br>
            <footer id="footer" class="foo2">
                <div class="container">
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p>RaoD © - 2014</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </body>
</html>
