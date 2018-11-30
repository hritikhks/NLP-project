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

  <div id="navbar"><h1 align="center">IIT Dharwad Translator</h1>
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

  <h1 align="center"> Add words to databases </h1>
  <form id="myform" action="add.php" method="post">
                        English Word:<input type="text" value="" name='English'>
                        Pronounciation in Hindi :<input type="text" value="" name='Hinglish'>
                        Meaning in Hindi:<input type= "text" value="" name='Hindi'>
                        <button id="sub">ADD</button>
</form>

 <h1 align="center"> Add Sentences to databases </h1>
  <form id="myform" action="add2.php" method="post">
                        English Word:<input type="text" value="" name='english'>
                        Sentence:<input type="text" value="" name='sntc'>
                        <button id="sub">ADD</button>
</form>


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
  }

  if($find == 0 && $inhin !=""){
    echo ' <textarea id="transliterateTextarea" style="width:500px;height:150px"></textarea>';
    echo "<script>document.getElementById('transliterateTextarea').value += '" .$inhin . "'  </script>";

  }

echo "<style>
h2 , h3 {
    text-align: center;
    padding: 16px;
}

#navbar {
  overflow: hidden;
  background-color: #66a3ff;
}

.container{
  display: flex;
    justify-content: center;
      background-color : #b3e0ff;

}

}

.content {
  padding: 16px;
  background-color : #b3ecff;
  color : #000a1a;
  text-align: center;
  width: 50%;
  height : 100vh; 
  float: left;

  scroll-snap-align: start;

}

.sample {
  background-color : #b3ecff;
  color : #000a1a;
  text-align: center;
  height : 100vh;
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
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
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

mysqli_close($connection);
?>
</div>

</div>
 <img src="image1.gif" alt="Image">
</body>

