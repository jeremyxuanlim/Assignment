<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<div class="card mb-4">
    <button class="btn" onclick="window.location.href='addMemberProfile.php'">Add Member Profile</button>
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Member Profile
    </div>
    <div class="card-body">
        <?php include("../php/config.php");?>
        <table id="datatablesSimple">
            <?php 
            $header = array(
                "StudentID" => "ID",
                "Username" => "Member Name",
                "Email" => "Email",
                "Gender" => "Gender",
                "Age" => "Age",
                "Password" => "Password",
            );
            $sort = isset($_GET['sort']) ? $_GET['sort'] : "StudentID";
            $order = isset($_GET['order']) ? $_GET['order'] : "asc"; ?>
            <thead>
                <tr>
                    <?php foreach($header as $key => $value){
                        printf("<th><a href='memberProfile.php?sort=%s&order=%s'>%s</a></th>",$key,$key == $sort ? ($order == "asc" ? "desc" : "asc") : "asc",$value);
                    } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($con,"SELECT * FROM users ORDER BY ".$sort." ".$order);
                if(mysqli_num_rows($query) != 0){
                    while($row = mysqli_fetch_assoc($query)){
                        ?>
                <tr>
                    <?php foreach($header as $key => $value){?>
                        <td><?php echo $row[$key];?></td>
                    <?php }?>
                    <td><button onclick="window.location.href='editMemberProfile.php?Id=<?php echo $row['StudentID'];?>'">Edit</button></td>
                    <td><button onclick="window.location.href='deleteMemberProfile.php?Id=<?php echo $row['StudentID'];?>'">Delete</button></td>
                </tr>
                <?php
                    }
                }?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
