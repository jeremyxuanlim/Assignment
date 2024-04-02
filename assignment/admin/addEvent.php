<?php
include('php/con_db.php');
if(isset($_POST['submit'])){
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
    window.location.href='addEvent.php';</script>";
    exit();
  }

  $query = mysqli_query($con, "INSERT INTO events(Title, Date, Time_Start, Time_End, Venue, Description, Capacity,Ticket_Quantity) VALUES('$event_name', '$event_date', '$event_time_start', '$event_time_end', '$event_location', '$event_description', '$event_capacity','$event_ticket')");
  if($query){
    echo "<script>alert('Event added successfully');
    window.location.href='event.php'</script>";
    exit();
  }else{
    echo "<script>alert('Failed to add event');
    window.location.href='addEvent.php'</script>";
    exit();
  }
}else{ ?>
<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<main class="event-main">
  <form id="edit-event-form" class="event-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="form-group">
      <label for="event-name">Event Name:</label>
      <input type="text" id="event-name" name="event-name" required>
    </div>
    <div class="form-group">
      <label for="event-date">Date:</label>
      <input type="date" id="event-date" name="event-date" required>
    </div>
    <div class="form-group">
      <label for="event-time-start">Time Start:</label>
      <input type="time" id="event-time-start" name="event-time-start" required>
    </div>
    <div class="form-group">
      <label for="event-time-end">Time End:</label>
      <input type="time" id="event-time-end" name="event-time-end" required>
    </div>
    <div class="form-group">
      <label for="event-location">Location:</label>
      <input type="text" id="event-location" name="event-location" required>
    </div>
    <div class="form-group">
      <label for="event-description">Description:</label>
      <textarea id="event-description" name="event-description" rows="4" required></textarea>
    </div>
    <div class="form-group">
      <label for="event-capacity">Capacity:</label>
      <input type="number" id="event-capacity" name="event-capacity" min="1" required>
    </div>
    <div class="form-group">
      <label for="event-ticket">Ticket Quantity:</label>
      <input type="number" id="event-ticket" name="event-ticket" min="1" required>
    </div>
    <div class="form-group">
      <input type="submit" id="event-submit" name="submit" value="Insert">
      <input type="button" id="event-submit" name="cancel" value="Cancel" onclick="window.location.href='event.php'">
    </div>
  </form>
</main>
<?php } ?>
<?php include('includes/footer.php')?>
<?php include('includes/scripts.php');?>