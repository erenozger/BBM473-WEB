<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Include config file
require_once "config.php";

$email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
        echo($password_err);
    } else{
        $password = trim($_POST["password"]);
        
    }

    if(empty($email_err) && empty($password_err)){
        $sql = "SELECT u.user_mail,u.password,g.role FROM user as u,general_user as g WHERE u.user_mail = g.usermail AND u.user_mail = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $email, $hashed_password,$role );
                    
                    
                    if(mysqli_stmt_fetch($stmt)){
                        

                        if(md5($password) == $hashed_password){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;
                            if($role == 2){
                                $rolename = "Moderator";
                            }elseif($role == 3){
                                $rolename = "News Writer";
                            }else{
                                $rolename = "General user";
                            }

                            $_SESSION["rolename"] = $rolename;  
                            $_SESSION["role"] = $role;  
                            header("location: home.php");
                        
                        } else{
                            $password_err = "The password you entered was not valid.";
                            echo "$password_err";
                        }
                    }
                }else{
                    $email_err = "No account found with that email.";
                    echo "$email_err";

                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        
    }else{
        echo "$email_err";
        
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Sign in GMMS</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Sign In GMMS</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="input-group">

                            <input class="input--style-3" type="email" placeholder="Email" name="email"value="<?php echo $email; ?>">
                        </div>
                        <div class="input-group">
                            
                            <input class="input--style-3" type="password" id="pwd" placeholder="Password" name="password"value="<?php echo $password; ?>">

                        </div>
                        
                        
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit">Sign In</button>    
                        </div>
                        <h2 class="text"></h2>
                        <h2 class="text">Don't you have an account?<a href="signup.php">Signup here</a></h2>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->