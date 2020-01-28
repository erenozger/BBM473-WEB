<?php
// Initialize the session
session_start();

$searchkey = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: signin.php");
    exit;
}

$valueToCheck = "";

if(isset($_POST['search'])){
  $valueToSearch = $_POST['valueToSearch'];
  $valueToCheck = $_POST['contenttype'];
  
  if($valueToCheck == 'Games'){
    $deletegame = "SELECT g.game_id,'Games' as contenttype,g.game_name,g.game_firm,g.gametype,g.rating FROM games as g , creategamesrel as c, moderator as m WHERE g.game_id = c.game_id AND c.mod_id = m.mod_id AND g.game_name LIKE '%".$valueToSearch."%' ORDER BY g.rating DESC;";
    $search_result = filterTable($deletegame);  
  }
  
  elseif($valueToCheck == 'Movies'){
    $deletemovie = "SELECT m.movie_id,'Movies' as contenttype,m.movie_name,m.movie_type,c.contentdetails,m.rating FROM movies as m, createmoviesrel as c, moderator as d WHERE m.movie_id = c.movie_id AND c.mod_id = d.mod_id AND m.movie_name LIKE '%".$valueToSearch."%' ORDER BY m.rating DESC;";

    $search_result = filterTable($deletemovie);
    
  }
  elseif($valueToCheck == 'Musics'){
    $deletemusic = "SELECT m.music_id,'Musics' as contenttype,m.music_name,m.music_artist,c.contentdetails,m.rating FROM music as m, createmusicrel as c, moderator as d WHERE m.music_id = c.music_id AND c.mod_id = d.mod_id AND m.music_name LIKE '%".$valueToSearch."%' ORDER BY m.rating DESC;";
    $search_result = filterTable($deletemusic);
    
  }
  elseif($valueToCheck == 'Series'){
    $deleteseries = "SELECT s.series_id,'Series' as contenttype,s.series_name,c.contenttype,c.contentdetails,s.rating FROM series as s, createseriesrel as c, moderator as m WHERE s.series_id = c.series_id AND c.mod_id = m.mod_id AND s.series_name LIKE '%".$valueToSearch."%' ORDER BY s.rating DESC;";
    $search_result = filterTable($deleteseries);
  }
  elseif($valueToCheck == 'News'){
    $deletenews = "SELECT news.news_id,'News' as contenttype,news.newstitle,news.text,news.newsdate,news.writer_id FROM news WHERE news.newstitle LIKE '%".$valueToSearch."%' ORDER BY newsdate DESC LIMIT 5;";
    $search_result = filterTable($deletenews);
  }else{
    $message = "Please select a content type!!!";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }


  
  
    


  
}

else{
  $valueToCheck = 'Games';
  if($valueToCheck == 'Games'){
    $deletegame = "SELECT g.game_id,'Games' as contenttype,g.game_name,g.game_firm,g.gametype,g.rating FROM games as g , creategamesrel as c, moderator as m WHERE g.game_id = c.game_id AND c.mod_id = m.mod_id ORDER BY g.rating DESC;";
    $search_result = filterTable($deletegame);
  }
  
  elseif($valueToCheck == 'Movies'){
    $deletemovie = "SELECT m.movie_id,m.movie_name,m.movie_type,c.contentdetails,m.rating FROM movies as m, createmoviesrel as c, moderator as d WHERE m.movie_id = c.movie_id AND c.mod_id = d.mod_id ORDER BY m.rating DESC;";
    $search_result = filterTable($deletemovie);

    
  }
  elseif($valueToCheck == 'Musics'){
    $deletemusic = "SELECT m.music_id,m.music_name,m.music_artist,c.contentdetails,m.rating FROM music as m, createmusicrel as c, moderator as d WHERE m.music_id = c.music_id AND c.mod_id = d.mod_id ORDER BY m.rating DESC;";
    $search_result = filterTable($deletemusic);
    
  }
  elseif($valueToCheck == 'Series'){
    $deleteseries = "SELECT s.series_id,s.series_name,c.contenttype,c.contentdetails,s.rating FROM series as s, createseriesrel as c, moderator as m WHERE s.series_id = c.series_id AND c.mod_id = m.mod_id ORDER BY s.rating DESC;";
    $search_result = filterTable($deleteseries);   
  }
  elseif($valueToCheck == 'News'){
    $deletenews = "SELECT news.news_id,news.newstitle,news.text,news.writer_id,news.newsdate FROM news ORDER BY newsdate DESC LIMIT 5;";
    $search_result = filterTable($deletenews);
  }else{
    $message = "error2!!!";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
  

}


function filterTable($query)
{
  $connect = mysqli_connect("localhost","root","","gmm");
  $filter_Result = mysqli_query($connect,$query);
  return $filter_Result;

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
        <td height="38"><div align="center"><a href="home.php">Home Page</a></div></td>
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
          <br><br>
      </p>
        <td><div align="center"><a href="moderator.php"><t>Moderator Profile<t></a></div></td>
        <td height="38" class="menuactive"><div align="center"><a href="deletecontent.php">Delete Contents Page</a></div></td>
        <td><div align="center"><a href="addcontent.php">ADD Contents Page</a></div></td>
        
      </tr>
    </table>
  </div>
</div>
<div id="menu">
  <div align="center">
    <form align = "center"action="deletecontent.php" method="post">
      <br><br>
      <t>You have to choose content type<t>
      <div class="input-group">
        <div class="rs-select2 js-select-simple select--no-search">
          <select name="contenttype">
            
            
            <option>Games</option>
            <option>Movies</option>
            <option>Musics</option>
            <option>Series</option>
            <option>News</option>
          </select>
          <div class="select-dropdown"></div>
        </div>
      </div>

      <table width="350" border="1">
        
        <tr>
          
          <td height="38"><input height="38"  type="text" name="valueToSearch" placeholder="Search From Content name" ><input type = "submit" name="search" value="Search"></td>
        </tr>
      </table>
      
    </form>
  </div>
</div>





<div id="icerik">
  <div align="center">
    
    <table width="1000" border="0">
      
      <tr>  
        <th>Content ID</th>
        <th>Content type</th>
        <th>Content Name</th>
        <th>Some Details</th>
        <th>Some Details</th>
        <th>Rating</th>
        <th width="100px">Action</th>
      </tr>
      <?php while($row = mysqli_fetch_array($search_result)) :?>
      <tr id ="<?php echo $row[0] ?>" typeid = "<?php echo $row[1] ?>">
        <td><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
        <td><?php echo $row[3];?></td>
        <td><?php echo $row[4];?></td>
        <td><?php echo $row[5];?></td>
        <td><button class="btn btn-danger btn-sm remove">Delete</button></td>
      </tr>
      <?php endwhile;?>
      



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".remove").click(function(){
        
        var id = $(this).parents("tr").attr("id");
        var typeid = $(this).parents("tr").attr("typeid");
        

        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: 'delete.php',
               type: 'GET',
               data: {id: id,typeid: typeid},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });


</script>
</html>
