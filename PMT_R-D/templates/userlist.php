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
    
    <link rel="stylesheet" href="../static/css/style_index.css">


    

</head>

<body >
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

            <!-- ======================= userlist ================== -->
            <?php
               include 'database.php';
               if (!isset($_SESSION["id"])) {
                 header("Location: login.php");
               }
               $user_id= $_SESSION['id'];
            ?>




  

            <div class="container-userlist">
             <?php
             if (isset($_GET["msg"])) {
               $msg = $_GET["msg"];
               echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
               ' . $msg . '
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
             }
             ?>
             
             <a class="add" href="add-new.php" ><ion-icon name="person-add"></ion-icon>Add New</a>
             <br><br>
             <br>
             <center>
             <table >
               <thead >
                 <tr>
                   <th scope="col">ID</th>
                   <th scope="col">full Name</th>
                   <th scope="col">matricule</th>
                   <th scope="col">mdp</th>
                   <th scope="col">Action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                 $sql = "SELECT * FROM `users`";
                 $result = mysqli_query($conn, $sql);
                 while ($row = mysqli_fetch_assoc($result)) {
                 ?>
                   <tr>
                     <td><?php echo $row["id"] ?></td>
                     <td><?php echo $row["full_name"] ?></td>
                     <td><?php echo $row["matr"] ?></td>
                     <td><?php echo $row["password"] ?></td>
                     
                     <td>
                       <a href="edit.php?id=<?php echo $row["id"] ?>"><ion-icon class="mod" name="create"></ion-icon></a>
                       <a href="delete.php?id=<?php echo $row["id"] ?>"><ion-icon class="sup" name="trash"></ion-icon></a>
                     </td>
                   </tr>
                   </div>  
                 <?php
                 }
                 ?>
               </tbody>
             </table>
             </center>
           </div>

 



            <!-- ================ Order Details List ================= -->
             
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../static/js/main_index.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>



