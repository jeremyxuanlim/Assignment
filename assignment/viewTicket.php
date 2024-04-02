<?php session_start();?>
<?php if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}else{?>
<?php 
  include('admin/php/con_db.php');
  $query = mysqli_query($con, "SELECT * FROM tickets WHERE StudentID = '".$_SESSION['studentId']."'");?>
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
echo '<h1>Your Tickets</h1>';
 while($ticket = mysqli_fetch_assoc($query)){
  ?>
      <div class="ticket">
          <p>Ticket ID: <?php echo $ticket['TicketID']; ?></p>
          <p>Event ID: <?php echo $ticket['EventID']; ?></p>
          <p>Student ID: <?php echo $ticket['StudentID']; ?></p>
          <p>Purchase Time: <?php echo $ticket['PurchaseTime']; ?></p>
      </div>
  <?php
    }
    include('includes/footer.php');
  }
  ?>
</body>
</html>