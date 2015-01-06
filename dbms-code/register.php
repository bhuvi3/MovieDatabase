<?php 
    require("config.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['username'])) 
        { die("Please enter a username."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
         
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM user_table 
            WHERE 
                username = '$username'; 
        "; 
        $result = mysqli_query($conn, $query);
        // Fetch all
        $row = mysqli_fetch_assoc($result);


        if($row){ die("This username is already in use"); } 

        $query = " 
            INSERT INTO user_table ( 
                username, 
                password,
                d_admin_client
            ) VALUES ( 
                '$username',
                '$password',
                '0'
            ) 
        "; 
        $row = mysqli_query($conn, $query);

        header("Location: index.php"); 
        die("Redirecting to index.php"); 
    } 
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Movie Database</title>
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
        <script type="text/javascript">
            function myfunc() {
                var username = document.getElementById("username").value;
                var pass = document.getElementById("password").value;
                var pass2 = document.getElementById("password2").value;
                if(username == "" || pass == "" || pass2 == "") {
                    alert("Cannot be empty");
                    return false;
                }
                else if (pass != pass2) {
                    alert("Passwords dont match");
                    return false;
                } 
            }
        </script>
    </head>
    <body>
        <div class="site-wrapper">
            <section id="login">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-wrap">
                                <h1>Register</h1>
                                <form role="form" action="register.php" method="post" id="login-form" autocomplete="off" onsubmit="return myfunc()">
                                    <div class="form-group">
                                        <label for="username" class="sr-only">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="key" class="sr-only">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="key" class="sr-only">Confirm Password</label>
                                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
                                    </div>
                                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                                </form>
                            </div>
                        </div> <!-- /.col-xs-12 -->
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
            </section>

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
