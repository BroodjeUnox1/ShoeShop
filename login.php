<?php  
	$connection = new mysqli("localhost", "root", "", "winkelusers");
	if (isset($_POST['submit'])) {
    session_start();
    $username = $_POST['username']; 
    $password = md5($_POST['password']); 
    $sql = "SELECT * from users where password = '$password' AND username = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    
    if($row == null){
        echo("Wrong password or username!");
    }else{
        
        if($count == 1){
            $_SESSION['login_email'] = $username;
            header("Location: index.html");
        }else{
            echo("Wrong password!");
        }
        
    }
}else{
    session_start();
    if(isset($_SESSION['login_email'])){
        header("Location: index.html");
    }else{
        
    }
}
?>

<?php 
 	if (isset($_POST['signup'])) {
 		$password = md5($_POST['password']);
 		$cpassword = md5($_POST['cpassword']);
 		$username = $_POST['username'];
 		$email = $_POST['email'];
 		if ($password==$cpassword) {
				$connection = new mysqli("localhost", "root", "", "winkelusers");
				$sql = "INSERT INTO users (username, email, password)VALUES('$username', '$email', '$password')";
				if ($connection->query($sql) === TRUE) {
   					 echo "Password match account has been made";
					} else {
   						 echo "Error: " . $sql . "<br>" . $connection->error;
					}
 			}else{
 				echo "Password doesn't match.";
 			}
		}
?>