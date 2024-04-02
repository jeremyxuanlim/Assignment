<?php if(isset($_POST['submit'])){
  $member_id = $_GET['Id'];
  $member_name = $_POST['member-name'];
  $member_email = $_POST['member-email'];
  $member_gender = $_POST['member-gender'];
  $member_age = $_POST['member-age'];
  $member_password = $_POST['member-password'];
  
  include('../php/config.php');
  $query = mysqli_query($con, "UPDATE users SET Username='$member_name', Email='$member_email', Gender='$member_gender', Age='$member_age', Password='$member_password' WHERE StudentID='$member_id'");

  if($query){
    echo "<div class='message'>
      <p>Member Updated Successfully!</p>
    </div> <br>";
    echo "<a href='memberProfile.php'><button class='btn'>Go Back</button>";
  }else{
    echo "<div class='message error'>
      <h1>Oops!</h1>
      <p>Failed to update member!</p>
    </div> <br>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
  }
}else{
include('includes/header.php');
include('includes/sideNav.php');
include('../php/config.php');
$query = mysqli_query($con,"SELECT * FROM users WHERE StudentID = '{$_GET["Id"]}'");?>
<main class="member-main">
  <?php while($result = mysqli_fetch_assoc($query)){?>
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="member-id">ID:</label>
      <input type="text" id="member-id" name="member-id" value="<?php echo $result['StudentID'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-name">Username:</label>
      <input type="text" id="member-name" name="member-name" value="<?php echo $result['Username'];?>"required>
    </div>
    <div class="form-group">
      <label for="member-email">Email:</label>
      <input type="email" id="member-email" name="member-email" value="<?php echo $result['Email'];?>"required>
    </div>
    <div class="form-group">
      <label for="member-gender">Gender:</label>
      <div class="flex-group">
      <input type="radio" id="member-gender" name="member-gender" value="M" <?php echo $result['Gender'] == 'M' ? 'checked' : ''; ?>>
      <label for="male">Male</label>
      <input type="radio" id="member-gender" name="member-gender" value="F" <?php echo $result['Gender'] == 'F' ? 'checked' : ''; ?>>
      <label for="female">Female</label>
      </div>
    </div>
    <div class="form-group">
      <label for="member-age">Age:</label>
      <input type="number" id="member-age" name="member-age" value="<?php echo $result['Age'];?>" required>
    </div>
    <div class="form-group">
      <label for="member-password">Password:</label>
      <input id="member-password" name="member-password" type="text" value="<?php echo $result['Password'];?>" required>
    </div>
    <div class="form-group">
      <input type="submit" id="member-submit" name="submit" value="Edit">
      <input type="button" id="member-submit" name="cancel" value="Cancel" onclick="window.location.href='memberProfile.php'">
    </div>
  </form>
  <?php }?>
</main>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php'); ob_end_fluhs();?>
<?php }?>