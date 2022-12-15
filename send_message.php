<?php
require_once("../classes/conn.php");
require_once("../classes/parent.php");
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='1'){
    header('Location: ../index.php');
}
$par = unserialize($_SESSION['user']);
$par->conn = $conn;
$par->childs_ids = array();
if(isset($_POST['submit'])){
    if($par->send_message($_POST['t_id'],$_POST['msg'])){
        header('Location: send_message.php?success');
    }else{
        header('Location: send_message.php?error');
    }
}
?>
<html>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Index.css">
    <body>
        <div class="hzh">
            <h1 data-text="PUZZLE">PUZZLE</h1>
            <form action="index.php" method="get" >
                <input type="submit" value="Home" id="button1">
            </form>
            <div class=forma>
            <table border="2px">
                <tr>
                    <th>ID</th>
                    <th>fname</th>
                    <th>lname</th>
                </tr>
                <?php
                $sql = "SELECT id,fname,lname FROM users WHERE type=2;";
                $res = mysqli_query($conn,$sql);

                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td></tr>";
                    }
                }else{
                    echo "<tr><td>No Teachers</td></tr>";
                }
                ?>
            </table>
                <h2>Send Message to Teacher!</h2>
                <form action="" method="POST">
                    Teacher ID<input type="text" name="t_id"><br>
                    Message<input type="text" name="msg"><br>
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </body>
</html>