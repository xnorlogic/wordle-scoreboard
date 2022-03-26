<?php
   include "environment_path.php";

   echo "<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'/>";
   echo "<script type='text/javascript' language='javascript' src='https://code.jquery.com/jquery-3.5.1.js'></script>";
   echo "<script type='text/javascript' language='javascript' src='https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js'></script>";
   echo "<script type='text/javascript' class='init'> $(document).ready(function() { $('#allwordle_data').DataTable();} ); </script>";

   $data_base_path = $local_path_to_dbc.'/wordleScores.db';
   $db = new SQLite3($data_base_path);

   $data_base_query = "SELECT * from wordle_scores";
   $data = $db->query($data_base_query);

   echo "<table style='font-size:200%' id='allwordle_data' class='display'> <thead>".
        "<tr> <th>Player</th> <th>Wordle Number</th> <th>Wordle Score</th> <th>Import Typ</th> </tr> </thead>";
   echo "<tbody>";
   while($data_row = $data->fetchArray(SQLITE3_ASSOC))
   {
      echo "<tr> <td align='center'> {$data_row['username']} </td>".
               " <td align='center'> {$data_row['wordlenumber']} </td>".
               " <td align='center'> {$data_row['wordlescore']} </td>".
               " <td align='center'> {$data_row['Importype']} </td> </tr>";
   }
   echo "</table> </tbody>";
   echo "<hr>";

   $db->close();

   echo "<br>";
   echo "<a href='index.php'><img src='HomeButton.png' alt='Index' style='width:900px;height:144px;'></a><br>";
   echo "<p> Prototype Score Board by Andy R. </p>";
?>
