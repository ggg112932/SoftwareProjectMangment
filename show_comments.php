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
                <h2>Show Comments!</h2>
            <table border="2px">
                <tr>
                    <th>student id</th>
                    <th>comment</th>
                    <th>teacher id</th>
                </tr>
                <?php
                $sql = "SELECT c_id FROM parents WHERE p_id=".$par->id.";";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $sql2 = "SELECT * FROM comment WHERE c_id=".$row['c_id']." ;";
                        $res2 = mysqli_query($conn,$sql2);
                        if(!empty($res) && $res->num_rows > 0){
                            while($row2 = mysqli_fetch_assoc($res2)){
                                echo "<tr><td>".$row['c_id']."</td><td>".$row2['comment']."</td><td>".$row2['t_id']."</td></tr>"; 
                            }
                        }
                    }
                }else{
                    echo "<tr><td>No Comments</td></tr>";
                }
                ?>
            </table>
            </div>
        </div>
    </body>
</html>