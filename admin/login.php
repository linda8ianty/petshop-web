<?php
ob_start();
session_start();
if(isset($_SESSION["admin_username"])) header("location:index.php");

include "../include/config.php";
include "../function/function.php";

// PROSES LOGIN
// if(isset($_POST["submit_login"])) {
//     $username = mysqli_real_escape_string($connection, $_POST["username"]);
//     $password = password_hash(mysqli_real_escape_string($connection, $_POST["password"]), PASSWORD_DEFAULT);
//     $sql_login = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

//     if(mysqli_num_rows($sql_login) > 0) {
//         $row_admin = mysqli_fetch_assoc($sql_login);
//         $_SESSION["admin_id"] = $row_admin["id"];
//         $_SESSION["admin_username"] = $row_admin["username"];
//         header("location:index.php");
//     }else{
//         header("location:login.php?failed");
//     }
// }

// PROSES LOGIN 2

        // $usernameErr = $passwordErr = "";
        // $Username = $Password = "";


if(isset($_POST["submit_login"])) {
    if(empty($_POST["username"]) || empty($_POST["password"])) {
        if(empty($_POST["username"])) {
            header("location:login.php?usernameincomplete");
        }elseif(empty($_POST["password"])){
            header("location:login.php?passwordincomplete");
        }
        //header("location:login.php?incomplete");
        //echo "<script>alert('Both fields are required')</script>";

        

        // if($_SERVER["REQUEST_METHOD"] == "POST") {
        //     if(empty($_POST["name"])) {
        //         $usernameErr = "username wajib diisi";
        //     }else{
        //         $Username = test_input($_POST["username"]);
        //     }

        //     if(empty($_POST["password"])) {
        //         $passwordErr = "password wajib diisi";
        //     }else{
        //         $Password = test_input($_POST["password"]);
        //     }
        // }

        

    }else{
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $password = mysqli_real_escape_string($connection, $_POST["password"]);

        $sql_login = mysqli_query($connection, "SELECT * FROM admin WHERE username = '$username'");

        if(mysqli_num_rows($sql_login) > 0) {
            while($row_admin = mysqli_fetch_assoc($sql_login)) {
                if(password_verify($password, $row_admin["password"])) {
                    //return true;
                    $_SESSION["admin_id"] = $row_admin["id"];
                    $_SESSION["admin_username"] = $row_admin["username"];
                    header("location:index.php");
                }else{
                    header("location:login.php?failed");
                }
            }
        }else{
            header("location:login.php?failed");
        }
    }
}

// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
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
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="has-validation" role="form" method="post" action="<?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <fieldset>
                            <?php if(isset($_GET["failed"])) {?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    Username atau Password Anda Salah. Silakan hubungi Administrator.
                                </div>
                            <?php }elseif(isset($_GET["usernameincomplete"])){?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    Username wajib diisi. Silakan hubungi Administrator.
                                </div>
                            <?php }elseif(isset($_GET["passwordincomplete"])){ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hiden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                                    Password wajib diisi. Silakan hubungi Administrator.
                                </div>
                            <?php }?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus="autofocus"/>
                                    <span class="error"> <?php //echo $usernameErr;?></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" />
                                    <span class="error"> <?php //echo $passwordErr;?></span>
                                </div>
    
                                <input type="submit" name="submit_login" value="Login" class="btn btn-lg btn-success btn-block"/>
                                <br>
                                <p class="text-center text-muted">Not a member yet? <a href="register.php" style="color:#5cb85c"><strong>Sign Up</strong></a></p>
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