# DevDeclan

<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phoneCode = $_POST['phonecode'];
$phone = $_POST['phone'];

if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || !empty($phoneCode) || !empty($phone)) 
{

//This is my database. You can create your own by using phpmyadmin
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "accounts";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('connection Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (username, password, gender, email, phoneCode, phone) values(?, ?, ?, ?, ?, ?)";
    }

    //Prepare statment
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if ($rnum==0) {
     $stmt->close();
     $stmt = $conn->prepare($INSERT);
     $stmt->bind_param("ssssii", $username, $password, $gender, $email, $phoneCode, $phone);
     $stmt->execute();
     echo "New record inserted sucessfully";
    //If no Connection
} 
    else {
    echo "All Feilds are requierd";
    die();
}

}

?>
