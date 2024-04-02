<?php
if(isset($_POST['delete'])){
  include('php/con_db.php');
  $id = $_GET['Id'];
  $query = mysqli_query($con, "DELETE FROM events WHERE EventID = '$id'");
  if($query){
    echo "<script>alert('Event deleted successfully');
    window.location.href='event.php';</script>";
    exit();
    
  }else{
    echo "<script>alert('Failed to delete event');
    window.location.href='event.php'</script>";
    exit();
  }
}else{
  include('includes/header.php');
  include('includes/sideNav.php');
  include('php/con_db.php');
  $event_id = $_GET['Id'];
  $query = mysqli_query($con, "SELECT * FROM events WHERE EventID = '$event_id'");
  ?>
  <main class="event-main">
    <?php while($result = mysqli_fetch_assoc($query)){?>
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="event-id">Event ID:</label>
      <input type="text" id="event-id" name="event-id" value="<?php echo $result['EventID'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-name">Event Name:</label>
      <input type="text" id="event-name" name="event-name" value="<?php echo $result['Title'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-date">Date:</label>
      <input type="date" id="event-date" name="event-date" value="<?php echo $result['Date'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-time-start">Time Start:</label>
      <input type="time" id="event-time-start" name="event-time-start" value="<?php echo $result['Time_Start'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-time-end">Time End:</label>
      <input type="time" id="event-time-end" name="event-time-end" value="<?php echo $result['Time_End'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-location">Location:</label>
      <input type="text" id="event-location" name="event-location" value="<?php echo $result['Venue'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-description">Description:</label>
      <textarea id="event-description" name="event-description" rows="4" readonly><?php echo $result['Description'];?></textarea>
    </div>
    <div class="form-group">
      <label for="event-capacity">Capacity:</label>
      <input type="number" id="event-capacity" name="event-capacity" min="1" value="<?php echo $result['Capacity'];?>" readonly>
    </div>
    <div class="form-group">
      <label for="event-ticket">Ticket Quantity:</label>
      <input type="number" id="event-ticket" name="event-ticket" min="1" value="<?php echo $result['Ticket_Quantity'];?>" readonly>
    </div>
    <div class="form-group">
      <input type="submit" id="event-submit" name="delete" value="Delete">
      <input type="button" id="event-submit" name="cancel" value="Cancel" onclick="window.location.href='event.php'">
    </div>
  </form>
  <?php }?>
</main>

<?php include('includes/footer.php');
include('includes/scripts.php');
}?>