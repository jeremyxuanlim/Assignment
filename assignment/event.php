<?php session_start();?>
<?php if(!isset($_SESSION['valid'])){
    header("Location: login.php");
    exit();
}else{
    $searchTerm = '';
    include('admin/php/con_db.php');
    if (isset($_GET['submit'])) {
        $searchTerm = mysqli_real_escape_string($con, $_GET['search']);
    }?>
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
?>
<div class="container">
        <h1>Tay Badminton Club Events</h1>
        <p>Check out our upcoming events and join us for some fun!</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <input type="text" name="search" placeholder="Search for events">
            <input type="submit" value="Search" name="submit">
            <input type="button" value="Reload" onclick="window.location.href='event.php'">
        </form><?php
        $id = $_SESSION['studentId'];
        $query = mysqli_query($con, "SELECT * FROM events WHERE Title LIKE '%$searchTerm%'");
        while($result = mysqli_fetch_assoc($query)){?>
        <div class="event">
            <h2><?php echo $result['Title'];?></h2>
            <p><strong>Date:</strong><?php echo $result['Date'];?></p>
            <p><strong>Time:</strong><?php echo date('g:i A', strtotime($result['Time_Start'])).' - '.date('g:i A', strtotime($result['Time_End'])); ?></p>
            <p><strong>Location:</strong><?php echo $result['Venue'];?></p>
            <p><strong>Description:</strong><?php echo $result['Description'];?></p>
            <p><strong>Capacity:</strong><?php echo $result['Capacity'];?></p>
            <p><strong>Ticket remaining:</strong><?php echo $result['Ticket_Quantity'];?></p>
            <button class="btn" onclick="window.location.href='ticket.php?StudentId=<?php echo $id;?>&EventId=<?php echo $result['EventID'];?>'">Join Event</button>
        </div>
        <?php } ?>
        <!-- Add more events as needed -->
    </div>
    <?php include('includes/footer.php'); }?>
</body>
</html>
