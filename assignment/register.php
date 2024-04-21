<?php
    // Initialize variables to hold user inputs or empty strings
    $studentId = isset($_POST['studentId']) ? htmlspecialchars($_POST['studentId']) : '';
    $userName = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
    $confirm_password = isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : '';

    // Function to detect errors
    function detectError()
    {
        // Use the global variables.
        global $studentId, $userName, $email, $age, $gender, $password, $confirm_password;

        // For holding error messages.
        $error = array();

        // id /////////////////////////////////////////////////////////////////////
        if ($studentId == '') {
            $error["id"] = 'Please enter <strong>Student ID</strong>.';
        } else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $studentId)) {
            $error["id"] = '<strong>Student ID</strong> is of invalid format. Format: 99XXX99999.';
        }

        // password ///////////////////////////////////////////////////////////////
        if ($password == '') {
            $error["password"] = 'Please enter <strong>Password</strong>.';
        } else if (strlen($password) < 8 || strlen($password) > 15) {
            $error["password"] = '<strong>Password</strong> must be between 8 to 15 characters.';
        }
        // confirm ////////////////////////////////////////////////////////////////
        if ($confirm_password == '') {
            $error["confirm-password"] = 'Please enter <strong>Confirm Password</strong>.';
        } else if ($confirm_password != $password) {
            $error["confirm-password"] = '<strong>Confirm Password</strong> must match the password.';
        }

        // name ///////////////////////////////////////////////////////////////////
        if ($userName == '') {
            $error["name"] = 'Please enter <strong>Student Name</strong>.';
        } else if (strlen($userName) > 30) { // Prevent hacks.
            $error["name"] = '<strong>Student Name</strong> must not be more than 30 characters.';
        } else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $userName)) {
            $error["name"] = 'There are invalid characters in <strong>Student Name</strong>.';
        }

        // gender /////////////////////////////////////////////////////////////////
        if ($gender == '') {
            $error["gender"] = 'Please select a <strong>Gender</strong>.';
        }
        // email //////////////////////////////////////////////////////////////////
        if ($email == '') {
            $error["email"] = 'Please enter <strong>Email Address</strong>.';
        } else if (strlen($email) > 30) { // Prevent hacks.
            $error["email"] = '<strong>Email Address</strong> must not be more than 30 characters.';
        } else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)) {
            $error["email"] = '<strong>Email Address</strong> is in an invalid format.';
        }

        return $error;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login-register.css">
    <title>Register</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php
           include("php/config.php");
           if(isset($_POST['submit'])){
               $studentId = strtoupper(trim($_POST['studentId']));
               $userName = trim($_POST['username']);
               $gender = $_POST['gender'];
               $email = trim($_POST['email']);
               $age = $_POST['age'];
               $password = trim($_POST['password']);
               $confirm_password = trim($_POST['confirm_password']);

               $error = detectError();

               if(empty($error)){//if no error
                   
                   //verifying the unique email
                   $verify_query = mysqli_query($con,"SELECT Email AND StudentID FROM users WHERE Email='$email' AND StudentID='$studentId'");

                   if(mysqli_num_rows($verify_query) !=0 ){
                       echo "<div class='message'>
                               <p>This email is used, Try another One Please!</p>
                           </div> <br>";
                   }
                   else{

                       mysqli_query($con,"INSERT INTO users(StudentID,Username,Email,Gender,Age,Password) VALUES('$studentId','$userName','$email','$gender','$age','$password')") or die("Error Occurred");

                       echo "<div class='message'>
                               <p>Registration successful!</p>
                           </div> <br>";
                       echo "<a href='login.php'><button class='btn'>Login Now</button>";
                   }
               }else{
                   echo "<div class='message error'>
                           <h1>Oops!</h1><p><ul>";
                           foreach ($error as $key => $value)
                           {
                               echo "<li>".$value."</li>";
                               if ($key == 'id' || $key == 'password' || $key == 'confirm-password' || $key == 'name' || $key == 'gender' || $key == 'email') {
                                   echo "<script>document.getElementById('".$key."').classList.add('error');</script>";
                               }
                           }
                           echo "</ul></p>
                       </div> <br>";
               }
           }
        ?>

            <header>Sign Up</header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <div class="field input">
                    <label for="studentId">Student ID</label>
                    <input type="text" name="studentId" id="studentId" autocomplete="off" required value="<?php echo $studentId; ?>">
                    <?php if(isset($error["id"])) { ?><span class="error"><?php echo $error["id"]; ?></span><?php } ?>
                </div>

                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required value="<?php echo $userName; ?>">
                    <?php if(isset($error["name"])) { ?><span class="error"><?php echo $error["name"]; ?></span><?php } ?>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required value="<?php echo $email; ?>">
                    <?php if(isset($error["email"])) { ?><span class="error"><?php echo $error["email"]; ?></span><?php } ?>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required value="<?php echo $age; ?>">
                </div>

                <div class="field input">
                    <label for="gender">Gender</label>
                </div>

                <div class="radio-field">
                        <input type="radio" name="gender" id="gender" value="M"/>
                        <label for="M">Male</label>
                        <input type="radio" name="gender" id="gender" value="F"/>
                        <label for="F">Female</label>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required value="<?php echo $password; ?>">
                    <?php if(isset($error["password"])) { ?><span class="error"><?php echo $error["password"]; ?></span><?php } ?>
                </div>

                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required value="<?php echo $confirm_password; ?>">
                    <?php if(isset($error["confirm-password"])) { ?><span class="error"><?php echo $error["confirm-password"]; ?></span><?php } ?>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                    <input type="button" class="btn" name="reset" value="Reset" onclick="location='<?php echo $_SERVER['PHP_SELF']; ?>'">
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
