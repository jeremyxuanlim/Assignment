<?php include('../php/config.php');

if(isset($_POST['delete'])){
  $member_id = $_GET['Id'];
  $query = mysqli_query($con,"DELETE FROM users WHERE StudentID = '$member_id'");

  if($query){
    echo "<script>alert('Member deleted successfully');
    window.location.href='memberProfile.php';</script>";
    exit();
  }else{
    echo "<script>alert('Failed to delete member');
    window.location.href='memberProfile.php'</script>";
    exit();
  }
}else{
  include('includes/header.php');
  include('includes/sideNav.php');
  include('../php/config.php');
  $query = mysqli_query($con,"SELECT * FROM users WHERE StudentID = '{$_GET["Id"]}'");?>
  <main class="member-main">
  <?php while($row = mysqli_fetch_assoc($query)){?>
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="member-id">ID:</label>
      <input type="text" id="member-id" name="member-id" value="<?php echo $row['StudentID'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-name">Username:</label>
      <input type="text" id="member-name" name="member-name" value="<?php echo $row['Username'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-email">Email:</label>
      <input type="email" id="member-email" name="member-email" value="<?php echo $row['Email'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-gender">Gendeer:</label>
      <input type="text" id="member-gender" name="member-gender" value="<?php echo $row['Gender'] == 'M' ? 'Male' : 'Female';?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-age">Age:</label>
      <input type="number" id="member-age" name="member-age" value="<?php echo $row['Age'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="member-password">Password:</label>
      <input id="member-password" name="member-password" type="text" value="<?php echo $row['Password'];?>" readonly>
    </div>
    <div class="form-group">
      <input type="submit" id="member-submit" name="delete" value="Delete">
      <input type="button" id="member-submit" name="cancel" value="Cancel" onclick="window.location.href='memberProfile.php'">
    </div>
  </form> <?php } ?>
</main>
<?php }?>
<?php include('includes/footer.php');
include('includes/scripts.php');?>