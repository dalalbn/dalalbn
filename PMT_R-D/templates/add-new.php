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
                    <a href="userlist.php">
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
                             <li><a href="edituser.php"><ion-icon name="settings"></ion-icon><b>modifier</b> </a></li> <center><hr color="#f48220"  width="120px"></center>
                             <li><a href="#"><ion-icon name="help-outline"></ion-icon><b>help</b></a></li> <center><hr color="#f48220"  width="120px"></center>
                             <li><a href="./logout.php"><ion-icon name="log-in"></ion-icon><b>Logout</b></a></li> <center><hr color="#f48220"  width="120px"></center>
                             
                             
                         </ul>
                    </details>                       
                </div>
            </div>

            <!-- ======================= adduser ================== -->
            <?php

             include 'database.php';
             if (!isset($_SESSION["id"])) {
                header("Location: login.php");
             }
             $user_id= $_SESSION['id'];


             if (isset($_POST["submit"])) {
                $full_name = $_POST['full_name'];
                $matr = $_POST['matr'];
                $mdp = $_POST['mdp'];
             
                $sql = "INSERT INTO `users`(`id`, `full_name`, `matr`, `password`) VALUES (NULL,'$full_name','$matr','$mdp')";
             
                $result = mysqli_query($conn, $sql);
             
                if ($result) {
                   header("Location: userlist.php?msg=New record created successfully");
                } else {
                   echo "Failed: " . mysqli_error($conn);
                }
             }
             
            ?>
            <br><br><br>

            <div class="container-adduser">
               <div class="text-center mb-4">
                  <h3>Add New User</h3>
                  <p class="text-muted"><b>Complete the form below to add a new user</b></p>
               </div>

               <div class="container-adduser-fb">
                  <form action="" method="post" >
                     <div class="row mb-3">
                        <div class="col">
                           <label class="form-label">Full Name:</label>
                           <input type="text" class="form-control" name="full_name" >
                        </div>
         
                        <div class="col">
                        <label class="form-label">matricule:</label>
                           <input type="text" class="form-control" name="matr" >
                        </div>
                     </div>
         
                     <div class="mb-3">
                        <label class="form-label">password:</label>
                        <input type="text" class="form-control" name="mdp" >
                     </div>
                     
         
                     
         
                     <div>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="userlist.php" class="btn btn-danger">Cancel</a>
                     </div>
                  </form>
               </div>
            </div>

   


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






