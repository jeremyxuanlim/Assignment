
<?php 
session_start();
if(!isset($_SESSION['valid-admin'])){
        header("Location: login.php");
        exit();
}else{
    include("includes/header.php");
    include("includes/sideNav.php");
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <button class='btn' onclick="window.location.href='addAdminProfile.php';">Add Admin Profile</button>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Admin Profile
            </div>
            <?php 
            $header = array(
                "AdminID" => "ID",
                "UserFirstName" => "Username",
                "Email" => "Email",
                "Password" => "Password"
            );

            $sort = isset($_GET['sort']) ? $_GET['sort'] : "AdminID";
            $order = isset($_GET['order']) ? $_GET['order'] : "asc";
            ?>
            <div class="card-body">
                <?php include("php/con_db.php");
                $query = mysqli_query($con,"SELECT * FROM users Order By ".$sort." ".$order);?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <?php foreach($header as $key => $value){ 
                                printf("<th><a href='index.php?sort=%s&order=%s'>%s</a></th?>", $key, $key == $sort ? ($order == "asc" ? "desc" : "asc") : "asc", $value);}
                                ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if(mysqli_num_rows($query) != 0){
                            while($row = mysqli_fetch_assoc($query)){
                                ?>
                        <tr>
                            <td><?php echo $row['AdminID']; ?></td>
                            <td><?php echo $row['UserFirstName']." ".$row['UserLastName']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Password']; ?></td>
                            <td><button onclick="window.location.href='editAdminProfile.php?Id=<?php echo $row['AdminID'];?>'">Edit</button></td>
                            <td><button onclick="window.location.href='deleteAdminProfile.php?Id=<?php echo $row['AdminID'];?>'">Delete</button></td>
                        </tr>
                        <?php
                            }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
  include("includes/footer.php");
  include("includes/scripts.php");
};
?>