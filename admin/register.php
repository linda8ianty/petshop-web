<?php
ob_start();
session_start();
if(isset($_SESSION["admin_username"])) header("location:index.php");

include "../include/config.php";
include "../function/function.php";

if(isset($_POST["submit_register"])) {
    if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
        if(empty($_POST["username"])) {
            header("location:register.php?usernameincomplete");
        }elseif(empty($_POST["password"])){
            header("location:register.php?passwordincomplete");
        }elseif(empty($_POST["email"])){
            header("location:register.php?emailincomplete");
        }
    }else{
        // CREATE NEW DATA ADMIN
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $email = mysqli_real_escape_string($connection, $_POST["email"]);
        $password = password_hash(mysqli_real_escape_string($connection, $_POST["password"]), PASSWORD_DEFAULT);
        $shown_password = mysqli_real_escape_string($connection, $_POST["password"]);
        mysqli_query($connection, "INSERT INTO admin VALUES('', '$username', '$password', '$shown_password', '$email') ");
        header("location:register.php?thanks");
    }
}

// if(isset($_POST["submit_register"])) {
//     if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {
//         if(empty($_POST["username"])) {
//             header("location:register.php?usernameincomplete");
//         }elseif(empty($_POST["password"])){
//             header("location:register.php?passwordincomplete");
//         }elseif(empty($_POST["email"])){
//             header("location:register.php?emailincomplete");
//         }
//     }else{
//         $username = mysqli_real_escape_string($connection, $_POST["username"]);
//         $password = mysqli_real_escape_string($connection, $_POST["password"]);

//         $sql_login = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username'");

//         if(mysqli_num_rows($sql_login) > 0) {
//             while($row_admin = mysqli_fetch_assoc($sql_login)) {
//                 if(password_verify($password, $row_admin["password"])) {
//                     //return true;
//                     $_SESSION["admin_id"] = $row_admin["id"];
//                     $_SESSION["admin_username"] = $row_admin["username"];
//                     header("location:index.php");
//                 }else{
//                     header("location:login.php?failed");
//                 }
//             }
//         }else{
//             header("location:login.php?failed");
//         }
//     }
// }

// CREATE DATA ADMIN
// if(isset($_POST["submit"])) {
//     $username = mysqli_real_escape_string($connection, $_POST["username"]);
//     $email = $_POST["email"];
//     $password = password_hash(mysqli_real_escape_string($connection, $_POST["password"]), PASSWORD_DEFAULT);
//     $shown_password = mysqli_real_escape_string($connection, $_POST["password"]);
//     mysqli_query($connection, "INSERT INTO admin VALUES('', '$username', '$password', '$shown_password', '$email') ");
//     header("location:index.php?thanks");
// }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CMS PETSHOP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/sb-admin.css" rel="stylesheet" />
    <link href="asset/favicon-16x16.png" type="image/png" rel="Shortcut Icon" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <!-- <div class="panel-heading">
                        <h3 class="panel-title">Sign Up here</h3>
                    </div> -->
                    <div class="panel-body">
                        <form class="has-validation" role="form" method="post">
                            <fieldset>
                                <?php if(isset($_GET["thanks"])) {?>
                                    <h1>Thanks!</h1>
                                    <br>
                                    <h5 class="text-muted">Your Account has been created.</h5>
                                    <h4><a href="index.php?login" style="color:#5cb85c">Sign In</a> here.</h4>
                                <?php }else{?>
                                
                                    <?php if(isset($_GET["usernameincomplete"])) {?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                            Username wajib diisi.
                                        </div>
                                    <?php }elseif(isset($_GET["emailincomplete"])){?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                            Email wajib diisi.
                                        </div>
                                    <?php }elseif(isset($_GET["passwordincomplete"])){ ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                            Password wajib diisi.
                                        </div>
                                    <?php }?>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Username" name="username" type="text" autofocus="autofocus"/>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Email" name="email" type="email" autofocus="autofocus"/>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="" />
                                        </div>
            
                                        <input type="submit" name="submit_register" value="Register" class="btn btn-lg btn-success btn-block"/>
                                        <br>
                                        <p class="text-center text-muted">Already a member? <a href="index.php?login" style="color:#5cb85c"><strong>Sign In</strong></a></p>
                                <?php }?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/sb-admin.js"></script>
</body>
</html>
<?php
mysqli_close($connection);
ob_end_flush();
?>