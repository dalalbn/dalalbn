<?php
session_start();
if (isset($_SESSION["id"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../static/css/pa.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $matr = $_POST["matr"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE matr = '$matr'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($password = $user["password"]) {
                    session_start();
                    
                    $_SESSION["id"] = $user["id"];
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <center>
     <div class="WRAP">
        <form action="login.php" method="post">
        <h1>Connexion</h1>
          <div class="input-box">
              <input type="text" placeholder="Enter Matr:" name="matr" class="form-control">
              <i class='bx bxs-user'></i> 
          </div>
          <div class="input-box">
              <input type="password" placeholder="Enter Password:" name="password" class="form-control">
              <i class='bx bxs-lock-alt' ></i> 
          </div>
          <div class="input-box">
              <input type="submit" value="Login" name="login" class="btn">
          </div>

          
          
          

          </form>
      </div> 
       </center>
    </div>
</body>
</html>