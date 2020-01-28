<?php


define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "gmm");

$link1 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if($link1 === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



if(isset($_GET['id'])){
	$typeid = $_GET['typeid'];

	if($typeid == 'Games'){
		$deletegame = "DELETE FROM games WHERE game_id = ".$_GET['id'];
		if($stmt = mysqli_prepare($link1, $deletegame)){
			mysqli_stmt_execute($stmt);
			echo "deleted successfully";
			mysqli_stmt_close($stmt);
		}else{
			echo "there was a mistake";
		}
	}
	elseif($typeid == 'Movies'){
		$deletegame = "DELETE FROM movies WHERE movie_id =".$_GET['id'];
		if($stmt = mysqli_prepare($link1, $deletegame)){
			mysqli_stmt_execute($stmt);
			echo "deleted successfully";
			mysqli_stmt_close($stmt);
		}else{
			echo "there was a mistake";
		}	
	}
	elseif($typeid == 'Musics'){
		$deletegame = "DELETE FROM music WHERE music_id =".$_GET['id'];
		if($stmt = mysqli_prepare($link1, $deletegame)){
			mysqli_stmt_execute($stmt);
			echo "deleted successfully";
			mysqli_stmt_close($stmt);
		}else{
			echo "there was a mistake";
		}

	}
	elseif($typeid == 'Series'){
		$deletegame = "DELETE FROM series WHERE series_id =".$_GET['id'];
		if($stmt = mysqli_prepare($link1, $deletegame)){
			mysqli_stmt_execute($stmt);
			echo "deleted successfully";
			mysqli_stmt_close($stmt);
		}else{
			echo "there was a mistake";
		}
	}
	elseif($typeid == 'News'){
		$deletegame = "DELETE FROM news WHERE news_id =".$_GET['id'];
		if($stmt = mysqli_prepare($link1, $deletegame)){
			mysqli_stmt_execute($stmt);
			echo "deleted successfully";
			mysqli_stmt_close($stmt);	
		}else{
			echo "there was a mistake";
		}	

	}else{
		echo " mistake";
	}
	
	
}else{
	echo "messege3";
}	
mysqli_close($link1);

?>