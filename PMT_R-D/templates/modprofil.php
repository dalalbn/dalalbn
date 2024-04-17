<?php
include 'database.php';
session_start();
if (!isset($_SESSION["id"])) {
   header("Location: login.php");
}
$user_id= $_SESSION['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../static/css/style_index.css">
</head>

<body>
    <?php
    $result = mysqli_query($conn,"SELECT * FROM users WHERE id = $user_id");
    $row = mysqli_fetch_assoc($result);
   

    ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                        <img src="../static/image/logo" alt="">
                        </span>
                        <span class="title">SONATRAC</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Statistique</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">

                            <ion-icon name="list-outline"></ion-icon>
                        </span>
                        <span class="title">Personnel</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="calendar-outline"></ion-icon>
                        </span>
                        <span class="title">PMT</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">gestion des comptes</span>
                    </a>
                </li>

                
                <li>
                    <a href="./logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                   <details class="dropdown">
                           <summary role="button">
                             <a class="button"><ion-icon name="person"></ion-icon> <?php echo $row["full_name"]?></a>
                           </summary>
                           <ul>
                             <li><a href="./modprofil.php"><ion-icon name="settings"></ion-icon><b>modifier</b> </a></li> <center><hr color="#f48220"  width="120px"></center>
                             <li><a href="#"><ion-icon name="help-outline"></ion-icon><b>help</b></a></li> <center><hr color="#f48220"  width="120px"></center>
                             <li><a href="./logout.php"><ion-icon name="log-in"></ion-icon><b>Logout</b></a></li> <center><hr color="#f48220"  width="120px"></center>
                             
                             
                         </ul>
                    </details>                       
                </div>
            </div>

            <!-- ======================= modifprofil ================== -->
            <?php


if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    
    $matr = $_POST['matr'];
    
    
    $update_profile = $conn->prepare("UPDATE `users` SET full_name = ?, matr = ? WHERE id = ?");
    $update_profile->execute([$full_name, $matr, $user_id]);

 
 
    $old_pass = $_POST['old_pass'];
    $previous_pass = $_POST['previous_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
 
    if(!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)){
       if($previous_pass != $old_pass){
          $message[] = 'old password not matched!';
       }elseif($new_pass != $confirm_pass){
          $message[] = 'confirm password not matched!';
       }else{
          $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
          $update_password->execute([$confirm_pass, $user_id]);
          $message[] = 'password has been updated!';
          header("Refresh: 5; url=index.php");
       }
    }
 
 }
 
 ?>






<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>




<section class="update-profile-container">

<?php
      $result = mysqli_query($conn,"SELECT * FROM users WHERE id = $user_id");
      $row = mysqli_fetch_assoc($result);
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
      <div class="flex">
         <div class="inputBox">
            <span>username : </span>
            <input type="text" name="full_name" required class="box" placeholder="enter your name" value="<?= $row['full_name']; ?>">
            <span>email : </span>
            <input type="text" name="matr" required class="box" placeholder="enter your matr" value="<?= $row['matr']; ?>">
        </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $row['password']; ?>">
            <span>old password :</span>
            <input type="password" class="box" name="previous_pass" placeholder="enter previous password" >
            <span>new password :</span>
            <input type="password" class="box" name="new_pass" placeholder="enter new password" >
            <span>confirm password :</span>
            <input type="password" class="box" name="confirm_pass" placeholder="confirm new password" >
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" value="update profile" name="update" class="btn">
         <a href="index.php" class="option-btn">go back</a>
      </div>
   </form>

</section>


            <!-- ================ Order Details List ================= -->
             </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../static/js/main_index.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>






