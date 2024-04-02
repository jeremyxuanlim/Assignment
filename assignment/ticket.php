<?php session_start();?>
<?php if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}?>
<?php 
  include('admin/php/con_db.php');
  if(isset($_POST['submit'])){
    $eventId = $_POST['event_id'];
    $studentId = $_POST['student_id'];
    $ticketQuantity = $_POST['ticket_quantity'];
    $result = mysqli_query($con,"SELECT Ticket_Quantity FROM events WHERE EventID = $eventId");

    $row = mysqli_fetch_assoc($result);

    if($row['Ticket_Quantity'] >= $ticketQuantity){
      for($i = 0; $i < $ticketQuantity; $i++){
        mysqli_query($con,"INSERT INTO tickets (EventID,StudentID) VALUES('$eventId','$studentId')");
      }
      mysqli_query($con, "UPDATE events SET Ticket_Quantity = Ticket_Quantity - $ticketQuantity WHERE EventID = $eventId");
      echo "<script>
      alert('The ticket is successfully purchased!!!');
      window.location.href='event.php';
      </script>";
    }else{
      echo "<script>
      alert('The ticket is sold out!!!');
      window.location.href='event.php';
      </script>";
      exit();
    }
  }else{ ?>
<!DOCTYPE html>
<html lang='en'>
  <head>
  <meta charset='utf-8'/>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'/>
  <title>Events</title>
  <link href="style/header.css" rel="stylesheet" />
  <link href="style/footer.css" rel="stylesheet" />
  <link href="style/event_ticket.css" rel="stylesheet"/>
</head>
<body>
<?php include('includes/header.php');
$eventId = $_GET['EventId'];
$studentId = $_SESSION['studentId'];?>
<?php 
  $query = mysqli_query($con, "SELECT Title FROM events WHERE EventID = $eventId");

  while($result = mysqli_fetch_assoc($query)){
    $title = $result['Title'];
  }?>
<div class="ticket">
  <h1>Buy Ticket</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div>
        <label for="event_id">Event ID</label>
        <input type="text" id="event_id" name="event_id" value="<?php echo $eventId; ?>" readonly> <br>
      </div>
      <div>
        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" value="<?php echo $studentId; ?>" readonly> <br>
      </div>
      <div>
        <label for="ticket_quantity">Ticket Quantity</label>
        <input type="number" id="ticket_quantity" class="ticket-quantity" name="ticket_quantity" min="1" max="5" required> <br>
      </div>
      <div>
        <br>
        <input type="submit" name="submit" value="Buy Ticket">
        <input type="button" value="Cancel" onclick="window.location.href='event.php'">
      </div>
    </form>
</div>
<?php include('includes/footer.php'); } ?>
  </body>
  </html>
