<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>tic | tac | toe</title>
	<link rel="stylesheet" href="css/ttt.css">
</head>
<?php $current = 'ttt_game'; ?>
<body class = pagecontainer>
<div class = "header">
	<a href="ttt_game.php?status=000000000000">Play again?</a>
</div>
<div class="container">
<div class="board">
<?php include ("ttt_game/ttt_functions.php"); ?>
<?php 
	$status = get_Status();
	$currentBoard = get_Board($status);
	$currentScore = get_Score($status);
	$whoseNext = whoseNext($currentBoard);
	$nextBoards = nextBoards($currentBoard, $whoseNext);
	$possibleWins = checkAllWins($nextBoards);
	$possibleTies = checkAllTies($nextBoards);
	$nextScores = nextScores($currentScore, $possibleWins, $possibleTies);
	$end = endGame($nextScores);
	$nextStatuses = nextStatuses($nextBoards, $nextScores);
	$printHTML = printBoard($currentBoard, $end, $nextStatuses);
?>


<?php 
// For flat storage
$file_connection = fopen('ttt.txt','a');?> 

<?php
//Mostly for printing the board; the $pos variable a part of the almost complete function of writing the board result to flat storage. Once I get that working, the plan is to move that variable assigment up to the top if possible. Could probably move the assignment of the square array to the checkspaces function (or some reorganization of that function into multiple parts)
		// print_r($nextStatuses);
		print_r($printHTML);
?>
<?php
// This code is for converting results to flat storage; unsure if this should be relegated to a function of its own, or if its fine here;
		$x = ($pos[0].$pos[1].$pos[2]);
		$y = ($pos[3].$pos[4].$pos[5]);
		$z = ($pos[6].$pos[7].$pos[8]);

?>
<?php 
//thinking this is fine here; unclear as to where this code needs to be in relation to the fopen function 
		fwrite($file_connection, $x);
		fwrite($file_connection, $y);
		fwrite($file_connection, $z);
		fclose($file_connection);
?>
</div>	
</div>
</body>
</html>