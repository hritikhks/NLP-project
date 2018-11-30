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


mysqli_close($connectq);
echo "<script> location.href='index.php'; </script>";

?>