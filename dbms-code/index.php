<?php 
    require("config.php"); 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $submitted_username = ''; 
    if(!empty($_POST)){ 
        $query = " 
            SELECT 
                username, 
                password,
                d_admin_client
            FROM user_table 
            WHERE 
                username = '$username'";
         
        $result = mysqli_query($conn, $query);
        // Fetch all
        $row = mysqli_fetch_assoc($result);

        $login_ok = false; 

        if($row){ 
            if($password === $row['password']){
                $login_ok = true;
            } 
        } 

        if($login_ok){ 
            unset($row['password']); 
            $_SESSION['user'] = $username;
            if($row['d_admin_client']){  
            	header("Location: admin.php"); 
            	die("Redirecting to: admin.php"); 
            }else{
            	header("Location: user.php"); 
            	die("Redirecting to: user.php");
            }
        } 
        else{ 
            print("Login Failed."); 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
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
        <script type="text/javascript">
            function myfunc() {
                var username = document.getElementById("username").value;
                var pass = document.getElementById("password").value;
                if(username == "" || pass == "" ) {
                    alert("Cannot be empty");
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
                                <h1>Log in</h1>
                                <form role="form" action="index.php" method="post" id="login-form" autocomplete="off" onsubmit="return myfunc()">
                                    <div class="form-group">
                                        <label for="username" class="sr-only">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="key" class="sr-only">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                                </form>
                                <a href="register.php" class="forget">Register</a>
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
