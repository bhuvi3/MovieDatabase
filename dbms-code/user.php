<?php
    require("config.php");
    if(empty($_SESSION['user'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>DBMS</title>
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
                text-shadow: 0 1px 3px rgba(0,0,0,.5);
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
                position: fixed;
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
                <div class="col-md-4 col-md-offset-4">
                    <br><br><br><br><br><br>
                    <div class="list-group">
                        <a class="list-group-item" href="get_movie.php">Get Movies</a>
                        <a class="list-group-item" href="get_artist.php">Get Artists</a>
                        <a class="list-group-item" href="get_award.php">Get Awards</a>
                        <a class="list-group-item" href="get_top3.php">Get Top 3 Movies</a>
                        <a class="list-group-item" href="rate.php">Rate a Movie</a>
                        <a class="list-group-item" href="review.php">Review a Movie</a>
                        <a class="list-group-item" href="watchlist.php">Add to watchlist</a>
                    </div> <!-- /.list-group -->
                </div>
              </div>

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
