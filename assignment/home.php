<?php
session_start();
include('php/config.php');
if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Home</title>
</head>
<body>
<script src='script/header.js'></script>
<?php include('includes/header.php'); ?>
  <?php 
            
            $id = $_SESSION['studentId'];// retriving
            $query = mysqli_query($con,"SELECT * FROM users WHERE StudentID = '$id'");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['StudentID'];
            }
            
            
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

            <main>
                <article>
                    <h2>Club Championship Coming Up!</h2>
                    <p>We are excited to announce that our annual club championship will be held on May 15th. Register now to showcase your skills!</p>
                <a href="news1.html">Read More</a>
                        </article>
                        <article>
                <h2>New Coaching Sessions</h2>
                <p>Join our new coaching sessions every Saturday from 10 am to 12 pm. Improve your game with our experienced coaches.</p>
                <a href="news2.html">Read More</a>
                </article>
                <article>
                    <h2>Equipment Sale</h2>
                    <p>Don't miss our equipment sale on April 20th. Get discounts on rackets, shuttles, and more!</p>
                    <a href="news3.html">Read More</a>
                </article>
            </main>

        </div>
    </div>
<?php include('includes/footer.php'); ?>
</body>
</html>

            
