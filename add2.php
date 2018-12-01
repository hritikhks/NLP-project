<?php

 include "credential.php";
 if ($connectq->connect_error) {
    echo "error";
 }

    $english =$_POST['english'];
    
    $sntc =$_POST['sntc'];
     $my2 ="INSERT INTO sentence(english , sntc) VALUES('$english', '$sntc')";
     $connectq->query($my2);


mysqli_close($connectq);
echo "<h1>";

echo "Thank You for your response";
echo "<br>";
echo "sentence has been added do the database";
echo "</h1>";
mysqli_close($connectq);
header( "refresh:2;url=index.php" );
//echo "<script> location.href='index.php'; </script>";

?>