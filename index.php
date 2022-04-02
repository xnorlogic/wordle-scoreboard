<?php
   include "environment_path.php";
   include "DisplayScoreBoard.php";

   /*Parameters for generating the wordle scoreboard*/
   $path = $local_path_to_dbc;
   $data_base_name = "wordleScores.db";
   $twitter_ids_file = "twitterUsers";
   $initial_wordle_number = 275;

   echo "<html>";
   echo "<head>";
   echo "<title>Wordle Scores Scoreboard</title>";
   echo "<h1>Wordle Scores</h1>";
   echo "<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'/>";
   echo "<script type='text/javascript' language='javascript' src='https://code.jquery.com/jquery-3.5.1.js'></script>";
   echo "<script type='text/javascript' language='javascript' src='https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js'></script>";
   echo "<script type='text/javascript' class='init'> $(document).ready(function() { $('#scoreboard_table').DataTable();} ); </script>";
   echo "</head>";
   echo "<body>";
   echo "<hr>";

   echo "<form method='post'> <input type='submit' value='Submit'/>".
   "<label for='some_wordle_number'> First Wordle Number of the Challenge: </label>".
   "<input type='text' name='some_wordle_number' value='275'> </form>";

   if(array_key_exists('some_wordle_number', $_POST))
   {
      $initial_wordle_number = (int)$_POST['some_wordle_number'];
      echo "<p>Wordle Score Challenge start point <b>{$initial_wordle_number}</b> !</p>";
      ShowScoreBoard($initial_wordle_number, $path, $data_base_name, $twitter_ids_file);
   }

   echo "<hr>";
   echo "<br>";
   echo "<a href='DisplayAllWordleData.php'><img src='AllScoresButton.png' alt='AllWordleData' style='width:900px;height:144px;'></a><br>";
   echo "<a href='https://github.com/xnorlogic/wordle-score-script.git' target='_blank'>-- Script for score harvesting --</a><br>";
   echo "</body>";
   echo "</html>";
?>

