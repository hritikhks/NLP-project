<?php 
$servername = "localhost";
$username = "hritik";
$password = "Hritik@6811";

// Create connection
//$conn1 = new mysqli($servername, $username, $password);
$conn1 = mysqli_connect($servername, $username, $password);
// Check connection
if ($conn1->connect_error) {
	echo "Not Connected";
    die("Connection failed: " . $conn->connect_error);
} 
// Create database
$sql = "CREATE DATABASE chemword";
if (mysqli_query($conn1, $sql)) {
    echo "Database created successfully";
} else {
    // echo "Error creating database: " . mysqli_error($conn1);
}

include_once "crttbl.php";
mysqli_close($conn1);

?>

<html>

  <div id="navbar">
   <img src="imglogo.png" height="100" width="175" alt="Image">

    <h1 align="center">IIT Dharwad Translator</h1>
  </div>


  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="https://www.google.com/jsapi">
    </script>
    <script type="text/javascript">

      // Load the Google Transliterate API
      google.load("elements", "1", {
            packages: "transliteration"
          });

      function onLoad() {
        var options = {
            sourceLanguage:
                google.elements.transliteration.LanguageCode.ENGLISH,
            destinationLanguage:
                [google.elements.transliteration.LanguageCode.HINDI],
            shortcutKey: 'ctrl+b',
            transliterationEnabled: true
        };
        // Create an instance on TransliterationControl with the required
        // options.
        var control =
            new google.elements.transliteration.TransliterationControl(options);

        // Enable transliteration in the textbox with id
        // 'transliterateTextarea'.
        control.makeTransliteratable(['transliterateTextarea']);
      }
      google.setOnLoadCallback(onLoad);
    </script>
  </head>




  <body>
    <div class ="container">
     <div class="content">
  <h1 align="center"> English to Hindi Translation </h1>
  <form id="Translate" action="" method="post">
                        English Word:<input type="text" value="" name='ineng'>
    <!--                     Pronounciation in Hindi :<input type="text" value="" name='Hinglish'>
                        Meaning in Hindi:<input type= "text" value="" name='Hindi'> -->
                        <button id="sub">Translate</button>
</form>
<img src="image1.gif" alt="Image">



 <?php

 include "credential.php";
 $result = mysqli_query($connection,"SELECT * FROM Words");

$all_property = array(); 
 $ineng =$_POST['ineng'];
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    $file = 'output.txt';
    $prnt = $row["english"] ;
    $hin = $row["Hindi"];
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
// file_put_contents($file, $prnt."\t", FILE_APPEND | LOCK_EX);
// file_put_contents($file, $row["Hinglish"]."\t", FILE_APPEND | LOCK_EX);
// file_put_contents($file, $hin."\n", FILE_APPEND | LOCK_EX);


    // -------------
    $a = $row["english"];
    if(strtolower($a) == strtolower($ineng)){
      echo '<h2>';
      echo $row["english"];
      echo '</h2>';
      echo '<h3>';
      echo $row["Hinglish"];
      echo '</h3>';
      echo '<h3>';
      echo $row["Hindi"];
      echo '</h3>';
    }

    else {
      //echo "Given word is not present in database";
    }

    echo '</tr>';
}

mysqli_close($connection);

?>

<?php

include "credential.php";
$sen_res = mysqli_query($connection,"SELECT * FROM sentence");

$all_property = array(); 
 $ineng =$_POST['ineng'];

//showing all data
while ($s_row = mysqli_fetch_array($sen_res)) {

  $a = $s_row["english"];
  if(strtolower($a) == strtolower($ineng)){
    echo '<h3>';
    echo $s_row["sntc"];
    echo '</h3>';
    echo "<br>";

  }
}
mysqli_close($connection);

?>

 </div>

</div>

<div class="sample">
  <h1 align="center"> Hindi to English Translation </h1>
  <form id="hintoeng" action="" method="post">
                        Hindi Word:<input type="text" value="" name='inhin'>
                        <button id="sub">Translate</button>

</form>


 <?php

 include "credential.php";
 $result = mysqli_query($connection,"SELECT * FROM Words");

$all_property = array(); 
 $inhin =$_POST['inhin'];


$find = 0;
$arr=array();
//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    $b = $row["Hinglish"];
    if(strtolower($b) == strtolower($inhin)){
      $find = 1;
      
      echo '<h2>';
      echo $row["english"];
      echo '</h2>';
      echo '<h3>';
      echo $row["Hinglish"];
      echo '</h3>';
      echo '<h3>';
      echo $row["Hindi"];
      echo '</h3>';
      break;
    }

    else if(strtolower($inhin[0]) == strtolower($b[0]) && $inhin !=""){
      $b_len = strlen($inhin);
      if($b_len > strlen($b)){

        $b_len = strlen($b);
      }
      $count = 1;
      
      for ($x = 1; $x < $b_len-1 ; $x++) {
        if($inhin[$x] == $b[$x] || $$inhin[$x] == $b[$x -1] || $inhin[$x] == $b[$x+1]){
          $count = $count + 1;
        }
        //echo $b[$x];
      }
      if($count >2){
        array_push($arr, $b);
      }
    }

  }
  if($find == 0 && sizeof($arr) > 0){
    echo "<h3>";
    echo "Entered word is not present ";
    echo "<br>";
    echo "Few suggested words are -";
    echo "<br>";
    echo "<br>";
    for($z = 0; $z < sizeof($arr); $z++){
      echo $arr[$z];
      echo "<br>";
    }
    echo "</h3>";
  }
 
  if($find == 0 && $inhin !=""){
    echo "<br>";
    echo "To see transliteration click on the text box below";
    echo "<br>";
    echo ' <textarea id="transliterateTextarea" style="width:500px;height:100px"></textarea>';
    echo "<br>";
    echo "<script>document.getElementById('transliterateTextarea').value += '" .$inhin . "'  </script>";
  }

  mysqli_close($connection);

?>


</div>
<div class ="addword">
   <h1 align="center"> Add words to databases </h1>
  <form id="myform" action="add.php" method="post">
                        English Word:<input type="text" value="" name='English'>
                        Pronounciation in Hindi :<input type="text" value="" name='Hinglish'>
                        Meaning in Hindi:<input type= "text" value="" name='Hindi'>
                        <button id="sub">ADD</button>
</form>
<br>

 <h1 align="center"> Add Sentences to databases </h1>
  <form id="myform" action="add2.php" method="post">
                        English Word:<input type="text" value="" name='english' > <br> <br>
                        Sentence:<input type="text" value="" name='sntc' style="width:500px;height:100px"> <br>
                        <button id="sub">ADD</button>
</form>
</div>
</body>
<?php
echo "<style>
h2 , h3 {
    text-align: center;
    padding: 16px;
}

#navbar {
  overflow: hidden;
  background-color: #009999;
}

.container{
  display: block;
  justify-content: center;
  background-color : ccebff;
  height:400px;
  width: 100%;
  
}

.addword {
  background-color : #00b3b3;
  height:550px;
  width:100%;
  padding-top: 50px;
  text-align: center;
}

.content {
  float : left;
  padding: 16px;
  display:block;
  background-color : #ccebff;
  color : #000a1a;
  text-align: center;
  height:400px;
  width: 100%;


}

img {
  float : left;
  padding-top: -20px;
}

.sample {
  background-color : #b3ecff;
  color : #000a1a;
  text-align: center;
  height:550px;
  padding-top: 60px;
 

  scroll-snap-align: start;

}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}



</style>";

echo  '<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");

var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>' ;

?>



</html>