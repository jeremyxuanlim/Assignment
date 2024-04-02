<?php include('includes/header.php');
include('includes/sideNav.php');
?>
<div class="card-header">
      <i class="fas fa-table me-1"></i>
      Ticket List
</div>
<div class="card-body">
    <?php include('php/con_db.php');?>
      <table id="datatablesSimple">
        <?php 
        $header = array(
          "TicketID" => "ID",
          "EventID" => "Event ID",
          "StudentID" => "Student ID",
          "PurchaseTime" => "Purchase Time",
        );
        $sort = isset($_GET['sort']) ? $_GET['sort'] : "TicketID"; 
        $order = isset($_GET['order']) ? $_GET['order'] : "asc"; ?>
        <thead>
          <tr>
              <?php 
              foreach($header as $key => $value){
              printf("<th><a href='viewTicket.php?sort=%s&order=%s'>%s</a></th>",$key,$key == $sort ? ($order == "asc" ? "desc" : "asc") : "asc", $value);
              }
              ?>
          </tr>
        </thead>
        <tbody>
        <?php
          $query = mysqli_query($con, "SELECT * FROM tickets ORDER BY ".$sort." ".$order);
          if(mysqli_num_rows($query) != 0){
            while($result = mysqli_fetch_assoc($query)){ ?>
          <tr>
            <?php
              foreach ($header as $key => $value) {
                    echo '<td>' . htmlspecialchars($result[$key]) . '</td>';
                }?>
          </tr>
          <?php } 
          }?>
        </tbody>
    </table>
  </div>
</div>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
