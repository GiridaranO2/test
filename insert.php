<?php
$email = $_POST['email'];
$password = $_POST['pwd'];

if (!empty($email) || !empty($pwd)){
    $host = "sql12.freemysqlhosting.net";
    $dbUsername = "sql12341068";
    $dbPassword = "VWkjQ7s2gz";
    $dbname = "sql12341068";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());

    }else{
        $SELECT = "SELECT email from test Where email = ? Limit 1";
        $INSERT = "INSERT Into test (email, pwd) values(?, ?)";

        //pepare statement 
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ss", $email, $pwd);
            $stmt->execute();
            echo "new data inserted successfully";
        }else {
            echo "already email registered";
        }
        $stmt->close();
        $conn->close();

    }
}else{
    echo "all fields are required";
    die();
}
?>