<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<div class="card mb-4">
  <button class="btn" onclick="window.location.href='addEvent.php'">Add Event</button>
  <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Event List
  </div>
  <div class="card-body">
    <?php include('php/con_db.php');?>
      <table id="datatablesSimple">
        <?php 
        $header = array(
          "EventID" => "ID",
          "Title" => "Event Name",
          "Date" => "Date",
          "Time_Start" => "Time",
          "Venue" => "Location",
          "Description" => "Description",
          "Capacity" => "Capacity",
          "Ticket_Quantity" => "Ticket Quantity",
        );
        $sort = isset($_GET['sort']) ? $_GET['sort'] : "EventID"; 
        $order = isset($_GET['order']) ? $_GET['order'] : "asc"; ?>
        <thead>
          <tr>
              <?php 
              foreach($header as $key => $value){
              printf("<th><a href='event.php?sort=%s&order=%s'>%s</a></th>",$key,$key == $sort ? ($order == "asc" ? "desc" : "asc") : "asc", $value);
              }
              ?>
          </tr>
        </thead>
        <tbody>
        <?php
          $query = mysqli_query($con, "SELECT * FROM events ORDER BY ".$sort." ".$order);
          if(mysqli_num_rows($query) != 0){
            while($result = mysqli_fetch_assoc($query)){ ?>
          <tr>
            <?php
              foreach ($header as $key => $value) {
                if($key == 'Time_Start'){
                  echo '<td>'.$result['Time_Start'].' - '.$result['Time_End'].'</td>';
                }else{
                  if($key == 'Date'){
                    $date = date_create($result['Date']);
                    $result[$key] = date_format($date, 'F d, Y');}

                    echo '<td>' . htmlspecialchars($result[$key]) . '</td>';
                }}?>
              <td><button onclick="window.location.href='editEvent.php?Id=<?php echo $result['EventID'];?>'">Edit</button></td>
              <td><button onclick="window.location.href='deleteEvent.php?Id=<?php echo $result['EventID'];?>'">Delete</button></td>
          </tr>
          <?php } 
          }?>
        </tbody>
    </table>
  </div>
</div>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>