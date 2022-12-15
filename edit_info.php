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
    if(isset($_POST['new'])){
        $file = $_FILES['img'];
        $ext = explode('.',$file['name']);
        $act_ext = strtolower(end($ext));
        $allowd = array('gif','jpg','jpeg','png');
        $ok=0;
        if(in_array($act_ext,$allowd)){
            if($file['error'] === 0){
                $file_name = uniqid('',true).".".$act_ext;
                $dest = '../uploads/'.$file_name;
                move_uploaded_file($file['tmp_name'],$dest);
                $ok=1;
            }else{
                header("location:add_child.php?error=file_error");
                exit();
            }
        }else{
            header("location:add_child.php?error=not_allowed");
            exit();
        }
        if($ok==1){
            $par->edit_pic($_POST['id'],$file_name);
        }
    }
    if(isset($_POST['fname']) && isset($_POST['lname'])){
        $par->edit_child($_POST['id'],$_POST['fname'],$_POST['lname']);
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
        </div>
        <div class="forma">
            <table>
                <tr>
                    <th>ID</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>pic</th>
                </tr>
                <?php
                $sql = "SELECT * FROM parents WHERE p_id=".$par->id.";";
                $res = mysqli_query($conn,$sql);

                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $sql2 = "SELECT * FROM child WHERE id=".$row['c_id'].";";
                        $res2 = mysqli_query($conn,$sql2);
                        if(!empty($res) && $res->num_rows > 0){
                            while($row2 = mysqli_fetch_assoc($res2)){
                                echo "<tr> <td>".$row2['id']."</td><td>".$row2['fname']."</td><td>".$row2['lname']."</td><td><img width=\"50px\" src='../uploads/".$row2['pic']."'/></td></tr>";
                            }
                        }
                    }
                }else{
                    echo "<tr><td>No Child</td></tr>";
                }
                ?>
            </table>
            <h1>Edit Student</h1>
            <form action="" method="post" enctype="multipart/form-data">
                Children ID<input type="text" name="id" required><br>
                Children First-Name<input type="text" name="fname"><br>
                Children Last-Name<input type="text" name="lname"><br>
                <label for="new">New Image</label> <input type="radio" name="new" value="1">
                <input type="file" name="img"><br>
                <input type="submit" name="submit">
            </form>
        </div>
    </body>
</html>