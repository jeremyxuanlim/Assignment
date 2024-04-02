<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<?php include("php/con_db.php");?>
<?php 
function splitName($admin_name){
  $part = explode(" ",$admin_name);
  if(count($part) > 1){
    $admin_lastName = array_pop($part);
    $admin_firstName = implode(" ",$part);
  }else{
    $admin_lastName = " ";
    $admin_firstName = $part;
  }

  return array($admin_firstName, $admin_lastName); // Add this line to return the values
}
if(isset($_POST['submit'])){
  $admin_id = $_GET['Id'];
  $admin_name = $_POST['admin-name'];
  $admin_email = $_POST['admin-email'];
  $admin_password = $_POST['admin-password'];

  list($admin_firstName, $admin_lastName) = splitName($admin_name); // Assign the returned values to the variables

  $query = mysqli_query($con,"UPDATE users SET UserFirstName='$admin_firstName',UserLastName='$admin_lastName', Email='$admin_email',Password='$admin_password' WHERE AdminID = '$_GET[Id]'");

  if($query){
    echo "<div class='message'>
      <p>Admin Updated Successfully!</p>
    </div> <br>";
    echo "<a href='index.php'><button class='btn'>Go Back</button>";
  }else{
    echo "<div class='message error'>
      <h1>Oops!</h1>
      <p>Failed to update admin!</p>
    </div> <br>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
  }
}else{
  $admin_id = $_GET['Id'];
  $query = mysqli_query($con,"SELECT * FROM users WHERE AdminID = '$admin_id'");
  while($result = mysqli_fetch_assoc($query)){
    $res_name = $result['UserFirstName']." ".$result['UserLastName'];
    $res_email = $result['Email'];
    $res_password = $result['Password'];
  }?>
<main class="admin-main">
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="admin-id">ID:</label>
      <input type="text" id="admin-id" name="admin-id" value="<?php echo $_GET['Id'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="admin-name">Admin Name:</label>
      <input type="text" id="admin-name" name="admin-name" value="<?php echo $res_name;?>" required>
    </div>
    <div class="form-group">
      <label for="admin-email">Email:</label>
      <input type="email" id="admin-email" name="admin-email" value="<?php echo $res_email;?>" required>
    </div>
    <div class="form-group">
      <label for="admin-password">Password:</label>
      <input id="admin-password" name="admin-password" type="text" value="<?php echo $res_password;?>" required>
    </div>
    <div class="form-group">
      <input type="submit" id="member-submit" name="submit" value="Edit">
      <input type="button" id="member-submit" name="cancel" value="Cancel" onclick="window.location.href='index.php'">
    </div>
  </form>
</main>

<?php include('includes/footer.php');
include('includes/scripts.php');
}?>