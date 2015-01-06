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
        <script type="text/javascript">
            function ajaxfunc() {
                var xhr = new XMLHttpRequest();
                /*if (window.XMLHttpRequest) 
                    xhr = new XMLHttpRequest();
                else if (window.ActiveXObject) 
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                else 
                    throw new Error("Ajax is not supported by your browser");*/

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status == 200) {
                            document.getElementById('data').innerHTML = xhr.responseText;
                        }
                    }
                }

                var option = document.getElementById('select').value;
                var name = document.getElementById('name').value;
                name = name.replace(' ', '+');
                var queryString = "?option=" + option ;
                queryString +=  "&name=" + name ;
                //var data = "option=" + option + "&name=" + name;
                //alert("get1.php" + queryString);
                xhr.open("GET", "get1.php" + queryString, true);
                //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send(null); 
            }
        </script>

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
                        <a class="list-group-item" href="get_artist.php">Get Artists</a>
                        <a class="list-group-item" href="get_award.php">Get Awards</a>
                        <a class="list-group-item" href="get_top3.php">Get Top 3 Movies</a>
                        <a class="list-group-item" href="rate.php">Rate a Movie</a>
                        <a class="list-group-item" href="review.php">Review a Movie</a>
                        <a class="list-group-item" href="watchlist.php">Add to watchlist</a>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <br><br><br>
                    <div class="form-wrap">
                        <h1>Get Movies by : </h1>
                        <form>
                        <div class="form-group">    
                            <select name="option" id="select" class="form-control">
                                <option value="awards">Awards</option>
                                <option value="artists">Artists</option>
                                <option value="genre">Genre</option>
                                <option value="language">Language</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="text" class="sr-only">Query</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="">
                        </div>
                        <input type="button" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Get!!!" onclick="ajaxfunc()">
                    </form>
                    </div>
                </div>
            </div>
            <br><br><br>
            <div class="container-fluid">
                 <div class="col-md-10 col-md-offset-1" id="data">   
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
