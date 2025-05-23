<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/homestyle.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <title>Change Profile</title>
</head>
<?php include('includes/header.php');?>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['studentId'];

                $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE StudentId='$id' ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['studentId'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE StudentId='$id' ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_Gender = $result['Gender'];
                }

            ?>
            <header>Change Profile</header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label for="gender">Gender</label>
                    <input type="radio" name="gender" id="gender" value="M" <?php echo $res_Gender == 'M' ? 'checked' : '' ?>>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="gender" value="F" <?php echo $res_Gender == 'F' ? 'checked' : '' ?>>
                    <label for="female">Female</label>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                    <input type="button" class="btn" value="Cancel" onclick="window.location.href='home.php'">
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
      <?php include('includes/footer.php');?>
</body>
</html>