<?php
    require("config.php");
    if(empty($_SESSION['user'])) {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
    else {
        if (!empty($_POST)) {
          /*$mname = $_POST['mname'];
          $myear = $_POST['myear'];
          $mdur = $_POST['mruntime'];
          $mlan = $_POST['mlan'];
          $mgen = $_POST['mgen'];

          $query = " 
            INSERT INTO movie_table ( 
                mname, 
                myear, 
                duration,
                language,
                genre
            ) VALUES ( 
                '$mname',
                '$myear',
                '$mdur',
                '$mlan',
                '$mgen'
            ) 
        "; */
            $query = $_POST['query'];
            $result = mysqli_query($conn, $query);
        }
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
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Admin<span class="caret"></span></a>
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
            <section id="login">
                <div class="container">
                    <h1>Query : </h1>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-wrap">
                                
                                <form role="form" action="admin.php" method="post" id="login-form" autocomplete="off">
                                    <div class="form-group">
                                        <label for="mname" class="sr-only">Query</label>
                                        <textarea name="query" id="query" class="form-control" placeholder="Query">
                                        </textarea>
                                    </div>
                                    <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Execute!">
                                </form>
                            </div>
                        </div> <!-- /.col-xs-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </section>
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
