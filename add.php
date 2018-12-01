<?php


 include "credential.php";


 if ($connectq->connect_error) {
    echo "error";
 }

    $English =$_POST['English'];
    $Hinglish =$_POST['Hinglish'];
    $Hindi =$_POST['Hindi'];
  
     $my ="INSERT INTO Words(english,Hinglish,Hindi) VALUES('$English', '$Hinglish', '$Hindi')";
     $connectq->query($my);
echo "<h1>";

echo "Thank You for your response";
echo "<br>";
echo "Word has been added do the database";
echo "</h1>";
mysqli_close($connectq);
header( "refresh:2;url=index.php" );
// echo "<script> location.href='index.php'; </script>";

?>