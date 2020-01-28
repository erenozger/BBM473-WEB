<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: signin.php");
    exit;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<style type="text/css">
table {
  border-collapse: collapse;
}
table, th, td {
  border: 1px solid black;

}
th {
  background-color: #808080;
  color: white;
}
body {
	background-image: url("3.jpg");
}
#menu {
	margin-right: auto;
	margin-left: auto;
}
#ust {
	margin-right: auto;
	margin-left: auto;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 20px;
	text-align: center;
}
#icerik {
	margin-right: auto;
	margin-left: auto;
	text-align: center;
	padding-top: 30px;
	line-height: 140%;
  border-collapse: collapse;
  font-family: monospace;
  font-size: 20px;
}
#imza {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 16px;
	line-height: 140%;
	text-align: center;
	margin-right: auto;
	margin-left: auto;
	color: #FFF;
}
#icerik div table tr td p {
	color: #000;
}
#menu div table tr td div a {
	background: #000;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  width: 100%;
  display: table;
	
}
#menu div table tr td div a:Hover {
	background: url("../images/gmms1.png") top left/cover no-repeat;
  display: table-cell;
  width: 50%;
}
#icerik2 {
	margin-right: auto;
	margin-left: auto;
}
#imza div {
	font-size: 20px;
	color: #FFF;
}
a:link {
	color: #C00;
	text-decoration: underline;
}
a:visited {
	text-decoration: underline;
	color: #FC6;
}
a:hover {
	text-decoration: none;
	color: #F93;
}
a:active {
	text-decoration: underline;
	color: #C00;
}
.menuactive{
background-color:#000000;
}


td{
	background-color: #CCC;
	font-size: 16px;
}


#icerik div table tr td p strong {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 20px;
}
#icerik div table tr td p strong u {
	color: #F00;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 17px;
	padding: 20px;
}
</style>

<head>
    <!-- Required meta tags-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
<div id="ust">
  <div align="center"><img src="2.gif" alt="ust" width="905" height="205" align="bottom" /></div>
</div>
<div id="menu">
  <div align="center">
    <table width="1000" border="1">
      <tr>
        <td height="38"><div align="center"><a href="moderator.php">Moderator Page (add/delete)</a></div></td>
      </tr>
    </table>
  </div>
</div>

<div id="menu">
  <div align="center">
    <table width="1000" border="1">
      <tr>
      	<div class="page-header">
    		<t>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</t>
    		<t>Role, <b><?php echo htmlspecialchars($_SESSION["rolename"]); ?></b></t>
		</div>
		<p>
        	<a href="profile.php" class="btn btn-warning">My Profile</a>
        	<a href="logout.php" class="btn btn-danger">Log out</a>
    	</p>
        <td><div align="center"><a href="home.php">Home</a></div></td>
        <td><div align="center"><a href="games.php">Games</a></div></td>
        <td><div align="center"><a href="movies.php">Movies</a></div></td>
        <td><div align="center"><a href="musics.php">Musics</a></div></td>
        <td height="38" class="menuactive"><div align="center"><a href="series.php">Series</a></div></td>
        <td><div align="center"><a href="home.php">Links</a></div></td>
        <td><div align="center"><a href="home.php">Links</a></div></td>
      </tr>
    </table>
  </div>
</div>
<div id="icerik">
  <div align="center">
    <table width="1500" border="0">
      <tr>  
        <th>Series Name</th>
        <th>Series Genre</th>
        <th>Series Details</th>
        <th>Rating</th>
        <th>Added By</th>
      </tr>
      <?php
            require_once "config.php";
            $sql = "SELECT s.series_name,c.contenttype,c.contentdetails,s.rating,m.mod_nick FROM series as s, createseriesrel as c, moderator as m WHERE s.series_id = c.series_id AND c.mod_id = m.mod_id ORDER BY s.rating DESC LIMIT 50;";
            
            if($stmt = mysqli_prepare($link, $sql)){
              if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                

                if(mysqli_stmt_num_rows($stmt) > 0){
                  
                  mysqli_stmt_bind_result($stmt, $seriesname1, $seriesgenre1,$seriesdetails1,$rating1,$addedby);
                  while(mysqli_stmt_fetch($stmt)){
                    echo "<tr><td>".$seriesname1."</td><td>".$seriesgenre1."</td><td>".$seriesdetails1."</td><td>".$rating1."</td><td>".$addedby."</td></tr>";

                  }
                  
                  
                }
                echo "</table>";
              }else{
                echo "0 result";
              }
              mysqli_stmt_close($stmt);
            }
            mysqli_close($link)
            
      ?>

    </table>
  </div>
</div>
<div id="icerik2"></div>
<div id="imza">
  <div align="center">
    <p>&nbsp;</p>
    <p>Created by GMMS Group </p>
  </div>
</div>
</body>
</html>
