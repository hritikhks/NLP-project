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
echo "<script> location.href='index.php'; </script>";

?>