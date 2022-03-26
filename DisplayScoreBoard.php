<?php
  function ShowScoreBoard($InitialWordleNumber, $path, $data_base_name, $twitter_ids_file_name)
  {
     $db = new SQLite3($path.$data_base_name);
     $myfile = fopen($path.$twitter_ids_file_name, "r") or die("Unable to open file!");

     $ThisUserName = '';

     $StartingWordleNumber=$InitialWordleNumber;
     $ScoresArray = array(7,7,7,7,7,7,7);
     $TotalScore = 0;
     $ThisWordleNumber = $StartingWordleNumber;
     $WordleNumberArray = array($StartingWordleNumber,$StartingWordleNumber+1,$StartingWordleNumber+2,
                                $StartingWordleNumber+3,$StartingWordleNumber+4,$StartingWordleNumber+5,$StartingWordleNumber+6);

     echo "<table style='font-size:200%' id='scoreboard_table' class='display'> <thead> <tr> <th>Player</th> <th> {$WordleNumberArray[0]} </th> <th>{$WordleNumberArray[1]}</th>".
          "<th>{$WordleNumberArray[2]}</th> <th>{$WordleNumberArray[3]}</th> <th>{$WordleNumberArray[4]}</th>".
          "<th>{$WordleNumberArray[5]}</th> <th>{$WordleNumberArray[6]}</th> <th>Total</th> </tr> </thead>";
     echo "<tbody>";

     while(!feof($myfile))
     {
        $ThisUserName = trim(fgets($myfile),"\n");
	$data_base_query = "SELECT username, wordlenumber, wordlescore FROM wordle_scores WHERE username == '".$ThisUserName.
                           "' AND wordlenumber >=".$StartingWordleNumber." AND wordlenumber < ".$StartingWordleNumber." + 7 ORDER BY wordlenumber ASC;";
        $data = $db->query($data_base_query);
        /*Fetch the next 7 rows in the data*/
        for($data_loop = 0 ; $data_loop < 7 ; $data_loop++)
        {
           if(!($data_row = $data->fetchArray(SQLITE3_ASSOC)))
           {
              $data_row = array("wordlenumber"=>0, "wordlescore"=>7);
           }

           if($data_row['wordlenumber'] == $ThisWordleNumber)
           {
               $ScoresArray[$data_loop] = $data_row['wordlescore'];
           }
           else
           {
               $ScoresArray[$data_loop] = 7;
           }
	   $ThisWordleNumber = $ThisWordleNumber + 1;
        }
        $TotalScore = array_sum($ScoresArray);
        if($ThisUserName != "")
        {
           echo "<tr> <td align='center'> {$ThisUserName} </td> <td align='center'> {$ScoresArray[0]} </td>".
                                                             " <td align='center'> {$ScoresArray[1]} </td>".
                                                             " <td align='center'> {$ScoresArray[2]} </td>".
                                                             " <td align='center'> {$ScoresArray[3]} </td>".
                                                             " <td align='center'> {$ScoresArray[4]} </td>".
                                                             " <td align='center'> {$ScoresArray[5]} </td>".
                                                             " <td align='center'> {$ScoresArray[6]} </td>".
                                                             " <td align='center'> {$TotalScore} </td> </tr>";
        }
        $ThisScoreCounter = 0;
        $ThisWordleNumber = $StartingWordleNumber;
     }
     echo "</tbody> </table>";

     $db->close();
     fclose($myfile);
  }
?>
