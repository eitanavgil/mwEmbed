<?php
// setup db
trigger_error("db.php is running", E_USER_WARNING);
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
    echo "<p><i>Record successfully inserted!</i></p>";
    }
  else
  {
     echo "<p><i>Incomplete form input. Record not inserted! Go Back</i></p>";
     }
  }

//if this is a GET, retreive all records and output a javascript object
if (isset($_GET['pull']))
{
  if (!sqlite_is_empty($dh))
  {
      $sql = "SELECT * FROM users" ;
      $result = sqlite_query($dh, $sql);

        echo "descriptions = '[{".
        while($result->valid()) //{($row=$result->fetch(SQLITE_NUM))
        {
          $row=$result->current();
          echo "'kEntryId':'".$row['kEntryId']."','description':'".$row['description']."'},";
          $result->next();
          }
        echo "]";
        }
        
      else
      {
        echo 'Create DB first!<br />';
        }
    }


?>



<?php
sqlite_close($dh);
?>
