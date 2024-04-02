<?php include('php/con_db.php');?>
<?php if(isset($_POST['submit'])){
  $event_name = $_POST['event-name'];
  $event_date = $_POST['event-date'];
  $event_time_start = $_POST['event-time-start'];
  $event_time_end = $_POST['event-time-end'];
  $event_location = $_POST['event-location'];
  $event_description = $_POST['event-description'];
  $event_capacity = $_POST['event-capacity'];
  $event_ticket = $_POST['event-ticket'];

  if ($event_ticket > $event_capacity) {
    echo "<script>alert('The number of tickets cannot be more than the event capacity');
    window.location.href='editEvent.php'</script>";
    exit();
  }

  $query = mysqli_query($con, "UPDATE events SET Title='$event_name', Date='$event_date', Time_Start='$event_time_start',Time_End='$event_time_end', Venue='$event_location', Description='$event_description', Capacity='$event_capacity', Ticket_Quantity='$event_ticket' WHERE EventID = '$_GET[Id]'");
  if($query){
    echo "<script>alert('Event updated successfully');
    window.location.href='event.php'</script>";
    exit();
  }else{
    echo "<script>alert('Failed to updated event');
    window.location.href='editEvent.php'</script>";
    exit();
  }
}{
  ?>
<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<main class="event-main">
<?php $query = mysqli_query($con,"SELECT * FROM events WHERE EventID = '$_GET[Id]'");
  
  while($result = mysqli_fetch_assoc($query)){
    $res_id = $result['EventID'];
    $res_name = $result['Title'];
    $res_date = $result['Date'];
    $res_time_start = $result['Time_Start'];
    $res_time_end = $result['Time_End'];
    $res_location = $result['Venue'];
    $res_description = $result['Description'];
    $res_capacity = $result['Capacity'];
    $res_ticket = $result['Ticket_Quantity'];
  }?>
<form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  <div class="form-group">
      <label for="event-id">Event ID:</label>
      <input type="text" id="event-id" name="event-id" value="<?php echo $res_id;?>" readonly>
    </div>
  <div class="form-group">
    <label for="event-name">Event Name:</label>
    <input type="text" id="event-name" name="event-name" value="<?php echo $res_name?>" required>
  </div>
  <div class="form-group">
    <label for="event-date">Date:</label>
    <input type="date" id="event-date" name="event-date" value="<?php echo $res_date?>" required>
  </div>
  <div class="form-group">
    <label for="event-time-start">Time Start:</label>
    <input type="time" id="event-time-start" name="event-time-start" value="<?php echo $res_time_start?>" required>
  </div>
  <div class="form-group">
    <label for="event-time-end">Time End:</label>
    <input type="time" id="event-time-end" name="event-time-end" value="<?php echo $res_time_end?>" required>
  </div>
  <div class="form-group">
    <label for="event-location">Location:</label>
    <input type="text" id="event-location" name="event-location" value="<?php echo $res_location?>" required>
  </div>
  <div class="form-group">
    <label for="event-description">Description:</label>
    <textarea id="event-description" name="event-description" rows="4" required><?php echo $res_description;?></textarea>
  </div>
  <div class="form-group">
    <label for="event-capacity">Capacity:</label>
    <input type="number" id="event-capacity" name="event-capacity" min="1" value="<?php echo $res_capacity?>" required>
  </div>
  <div class="form-group">
    <label for="event-ticket">Ticket Quantity:</label>
    <input type="number" id="event-ticket" name="event-ticket" min="1" value="<?php echo $res_ticket?>" required>
  </div>
  <div class="form-group">
    <input type="submit" id="event-submit" name="submit" value="Edit">
    <input type="button" id="event-submit" name="cancel" value="Cancel" onclick="window.location.href='event.php'">
  </div>
</form>
</main>
<?php } ?>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>