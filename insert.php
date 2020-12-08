
<?php
$username = $_POST['GuardianName'];
$password = $_POST['Instituteorschoolname'];
$Food = $_POST['Food'];
$Traveling = $_POST['Traveling'];
$email = $_POST['email'];

$phone = $_POST['phone'];
if (!empty($GuardianName) || !empty($Instituteorschoolname) || !empty($Food) || !empty($Traveling) || !empty($email) || !empty($phone)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "data";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From data Where email = ? Limit 1";
     $INSERT = "INSERT Into data (GuardianName,Instituteorschoolname ,Food, Traveling, email, phone) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssi", $GuardianName, $Instituteorschoolname, $Food, $Traveling, $email, $phone);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>