<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $username = $usernick = $birthdate = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    $sql = "SELECT user_mail FROM user WHERE user_mail = ?";
        
    if($stmt = mysqli_prepare($link, $sql)){
            
        mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            
        $param_email = trim($_POST["email"]);
            
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
                /* store result */
            mysqli_stmt_store_result($stmt);
                
            if(mysqli_stmt_num_rows($stmt) == 1){
                $email_err = "This email is already taken.";
            } else{
                $email = trim($_POST["email"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
       
    mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    }else{
        $password = trim($_POST["password"]);
    }
    
    $username = trim($_POST["username"]);
    $birthdate = trim($_POST["birthdate"]);
    $usernick = trim($_POST["usernick"]);
    
    if(empty($email_err)){
        
        if(empty($password_err)){
            $sql = "CALL userregister(?, ?, ?, ?, ?)";
        
         
            if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_password,$param_username,$param_dob, $param_usernick);
            
            // Set parameters
                $param_email = $email;
                $param_password = md5($password); // Creates a password hash
                $param_username = $username;
                $param_dob = $birthdate;
                $param_usernick = $usernick;



            // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                    header("location: signin.php");
                }else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }else{
            echo "$password_err";
        }
     
    }
    else{
        echo "$email_err";
    }
    
    // Close connection
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
    <title>GMMS Signup Page</title>

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
                    <h2 class="title">Registration GMMS</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" name="email" value="<?php echo $email; ?>">

                            
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password" value="<?php echo $password; ?>">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="User Name" name="username" value="<?php echo $username; ?>">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="User Nick" name="usernick" value="<?php echo $usernick; ?>">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3 js-datepicker" type="text" placeholder="Birthdate" name="birthdate" value="<?php echo $birthdate; ?>">
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                        

                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit">Sign Up</button>    
                        </div>
                        <h2 class="text"></h2>
                        <h2 class="text">Already have an account?<a href="signin.php">Signin here</a></h2>

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

</body>
</html>