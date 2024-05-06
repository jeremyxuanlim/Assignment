<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

include('admin/php/con_db.php');

if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];
    $eventQuery = mysqli_query($con, "SELECT * FROM events WHERE EventID = '$eventId'");
    $event = mysqli_fetch_assoc($eventQuery);
}

if (isset($_POST['book'])) {
    $eventId = $_POST['event_id'];
    $studentId = $_SESSION['studentId'];
    $purchaseTime = date('Y-m-d H:i:s'); 
    $insertQuery = "INSERT INTO tickets (EventID, StudentID, PurchaseTime) VALUES ('$eventId', '$studentId', '$purchaseTime')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        header("Location: payment successful.php?event_id=$eventId");
        exit();
    } else {
        echo "<script>alert('Failed to book ticket. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book Ticket</title>
    <link href="style/header.css" rel="stylesheet" />
    <link href="style/footer.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php'); ?>
<h1>Book Ticket</h1>
<?php if (isset($event)): ?>
    <div>
        <h2>Event Details:</h2>
        <p><strong>Title:</strong> <?php echo $event['Title']; ?></p>
        <p><strong>Date:</strong> <?php echo $event['Date']; ?></p>
        <p><strong>Price:</strong> <?php echo $event['Price']; ?></p>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
        <input type="submit" name="book" value="Book Ticket">
    </form>
<?php else: ?>
    <p>No event selected. Please go back and select an event to book a ticket.</p>
<?php endif; ?>
<?php include('includes/footer.php'); ?>
</body>
</html>
