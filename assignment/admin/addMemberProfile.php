<?php if(isset($_POST['submit'])){
  $member_id = $_POST['member-id'];
  $member_name = $_POST['member-name'];
  $member_email = $_POST['member-email'];
  $member_gender = $_POST['member-gender'];
  $member_age = $_POST['member-age'];
  $member_password = $_POST['member-password'];

  include('../php/config.php');
  $query = mysqli_query($con, "INSERT INTO users (StudentID, Username, Email,Gender, Age, Password) VALUES('$member_id', '$member_name', '$member_email', '$member_gender', '$member_age', '$member_password')");

  if($query){
    echo "<div class='message'>
      <p>Member Added Successfully!</p>
    </div> <br>";
    echo "<a href='memberProfile.php'><button class='btn'>Go Back</button>";
  }else{
    echo "<div class='message error'>
      <h1>Oops!</h1>
      <p>Failed to add member!</p>
    </div> <br>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
  }
}else{?>
<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<main class="member-main">
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="member-id">ID:</label>
      <input type="text" id="member-id" name="member-id" required>
    </div>
    <div class="form-group">
      <label for="member-name">Username:</label>
      <input type="text" id="member-name" name="member-name" required>
    </div>
    <div class="form-group">
      <label for="member-email">Email:</label>
      <input type="email" id="member-email" name="member-email" required>
    </div>
    <div class="form-group">
      <label for="member-gender">Gender:</label>
      <div class=flex-group>
      <input type="radio" id="member-gender" name="member-gender" value="M">
      <label for="male">Male</label>
      <input type="radio" id="member-gender" name="member-gender" value="F">
      <label for="femaile">Female</label>
      </div>
    </div>
    <div class="form-group">
      <label for="member-age">Age:</label>
      <input type="number" id="member-age" name="member-age" required>
    </div>
    <div class="form-group">
      <label for="member-password">Password:</label>
      <input id="member-password" name="member-password" type="text" required>
    </div>
    <div class="form-group">
      <input type="submit" id="member-submit" name="submit" value="Insert">
      <input type="button" id="member-submit" name="cancel" value="Cancel" onclick="window.location.href='memberProfile.php'">
    </div>
  </form>
</main>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php') ?>
<?php } ?>