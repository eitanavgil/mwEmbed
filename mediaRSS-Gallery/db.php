<?php
//echo $_SERVER['REQUEST_METHOD'];
// setup db
include('db-utils.php');
$dh = sqlite_open($db, 0666, $err) or die ($err);

//if this is a POST, we write a record to the db
if (isset($_POST['description']))
{
  if (!empty($_POST['kEntryId']) && !empty($_POST['description']) )
  {
    $kEntryId = sqlite_escape_string($_POST['kEntryId']);
    $description = sqlite_escape_string($_POST['description']);
    //$name = sqlite_escape_string($_POST['name']);
    //$email = sqlite_escape_string($_POST['email']);
    //        if ( empty($_POST['volume']) ) {
    //                $volume = 'NULL';
    //                    } else {
    //                           $volume = "'".sqlite_escape_string($_POST['volume'])."'";
    //                               }
    $sql = "INSERT INTO $et (id,kEntryId,description,name,email)
            VALUES (NULL,'$kEntryId','$description',NULL,NULL);";
    //     echo "sql = $sql<br />"; // un-comment for debugging
    $result = sqlite_query($dh, $sql) or die("Error in query: ".sqlite_error_string(sqlite_last_error($dh)));
    //echo "<p><i>Record successfully inserted!</i></p>";
    }
  else
  {
     echo "<p><i>Incomplete form input. Record not inserted! Go Back</i></p>";
     }
  }

//if this is a GET, retreive all records and output a javascript object
if (isset($_GET))
{
  if (!sqlite_is_empty($dh))
  {
      $sql = "SELECT * FROM ".$et ;
      $result = sqlite_query($dh, $sql);
      if (sqlite_num_rows($result) > 0)
      {
        echo "description = [";

        while (sqlite_has_more($result)) 
        {
          $row = sqlite_fetch_single($result);
          echo "{'kEntryId':'"
            .$row['kEntryId']
            ."','description':'"
            .$row['description']."'},";
          }
        echo "]";
        }
      else
      {
        echo 'Create DB first!<br />';
        }
      }
  }

sqlite_close($dh);
?>
