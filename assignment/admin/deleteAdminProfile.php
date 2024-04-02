<?php if(isset($_POST['delete'])){
  $admin_id = $_GET['Id'];
  include('php/con_db.php'); // Include the database connection file
  $query = mysqli_query($con,"DELETE FROM users WHERE AdminID = '$admin_id'");

  if($query){
    echo "<script>alert('Admin deleted successfully');
    window.location.href='index.php';</script>";
    exit();
}else{
    echo "<script>alert('Failed to delete admin');
    window.location.href='index.php'</script>";
    exit();
  }
}else{
  include("includes/header.php");
  include("includes/sideNav.php");
  include("php/con_db.php");
  $admin_id = $_GET['Id'];
  $query = mysqli_query($con,"SELECT * FROM users WHERE AdminID = '$admin_id'");?>
  <main class="admin-main">
  <?php while($result = mysqli_fetch_assoc($query)){?>
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="admin-id">ID:</label>
      <input type="text" id="admin-id" name="admin-id" value="<?php echo $result['AdminID'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="admin-name">Admin Name:</label>
      <input type="text" id="admin-name" name="admin-name" value="<?php echo $result['UserFirstName']." ".$result['UserLastName'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="admin-email">Email:</label>
      <input type="email" id="admin-email" name="admin-email" value="<?php echo $result['Email'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="admin-password">Password:</label>
      <input id="admin-password" name="admin-password" type="text" value="<?php echo $result['Password'];?>" readonly>
    </div>
    <div class="form-group">
      <input type="submit" id="member-submit" name="delete" value="Delete">
      <input type="button" id="member-submit" name="cancel" value="Cancel" onclick="window.location.href='index.php'">
    </div>
  </form>
  <?php } ?>
</main>

<?php 
include("includes/footer.php");
include("includes/scripts.php");
  }
?>