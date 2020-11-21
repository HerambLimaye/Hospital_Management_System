<?php

session_start();

require_once "pdo.php";


if(isset($_POST['log'])){
  if(isset($_POST['pass']) && isset($_POST['userid'])){

    $stmta = $pdo->query("SELECT * FROM admin");
    $rowsa = $stmta->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rowsa as $row) {
    if($_POST['userid']==$row['UserId'] && $_POST['pass']==$row['Pass']){
      $_SESSION['userid']=$_POST['userid'];
 		 header('Location: dashboard_admin.php');
 		 return;
    }
}

      $stmt = $pdo->query("SELECT * FROM hosplog");
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {
       if(($_POST['userid']==$row['UserId']) && ($_POST['pass']==$row['Pass'])){
         $_SESSION['userid']=$row['UserIDd'];
         header('Location: dashboard.php');
         return;

    }
  }
    $_SESSION['error1']="Access Denied";
  	header('Location: login.php');
  	return;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Niconne&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Niconne&display=swap" rel="stylesheet">

    <title>Login Form</title>
</head>

<body>
  <h3 align="center" style="color:red; background:white;">
      <?php
        if(isset($_SESSION['error1'])){
          echo $_SESSION['error1'];
          unset($_SESSION['error1']);
        }

        ?>
      </h3>
<style>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    background: url('hospital,_green.jpg');

      background-size: cover;
  background-repeat: no-repeat;

}

.container {
    height: 400px;
    width: 650px;
    box-shadow: 0px 30px 40px black;
    display: flex;
    border-radius: 10px;
}

.image {
    flex: 50%;
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('hospital,_green.jpg');
    background-size: cover;
    text-align: center;
    color: white;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.image h1 {
    margin-top: 50%;
    padding-left: 20px;
    padding-right: 20px;
    letter-spacing: 2px;
    margin-bottom: 10px;
}

span {
    color: chartreuse;
}

.content {
    flex: 50%;
    background-color: white;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
}

.content h1 {
    padding: 40px;
    padding-top: 30px;
    font-family: 'Niconne', cursive;
    font-size: 40px;
    color: #c446c9;
}

#txt {
    margin: 10px;
    padding: 5px;
    border: none;
    background-color: rgba(156, 77, 156, 0.3);
    border-radius: 10px;
    font-weight: bold;
    font-size: small;
    font-family: 'Montserrat', sans-serif;
    color: #aa38a4;
}

label {
    font-weight: bold;
    font-size: small;
}

#txt:focus {
    outline: none;
}

.fp {
    text-decoration: none;
    font-weight: bold;
    font-size: small;
    transition: 0.3s;
}

.fp:hover {
    color: #c446c9;
}

button {
    padding: 10px 40px;
    margin-top: 20px;
    border: none;
    background: linear-gradient(to right, #4568DC, #B06AB3);
    border-radius: 20px;
    transition: 0.3s;
}

button:hover {
    transform: scale(1.2);
}

button a {
    text-decoration: none;
    color: white;
}</style>
    <div class="container">
        <div class="image">
            <h1>Welcome  <span></span></h1>
        </div>

        <div class="content">
          <form method="post">
            <h1>Login</h1>
            <div class="form-group">
                <label for="">User ID</label>
                <br>
                <input type="text" class="form-control" name="userid" id="txt" aria-describedby="helpId" placeholder="UserId">

            </div>
            <div class="form-group">
                <label for="">Password</label>
                <br>
                <input type="password" class="form-control" name="pass" id="txt" placeholder="Password">
            </div>

            <br>

          <button name="log" class="btn" style="color:white; font-weight:bold;">LOGIN</button>
        </form>
        </div>

    </div>
</body>

</html>
