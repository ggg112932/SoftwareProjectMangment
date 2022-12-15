<?php
require_once("../classes/conn.php");
require_once("../classes/parent.php");
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='1'){
    header('Location: ../index.php');
}
if(isset($_POST['submit'])){
    $par = unserialize($_SESSION['user']);
    $par->conn = $conn;
    $par->childs_ids = array();
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
        $par->add_child($_POST['id'],$_POST['fname'],$_POST['lname'],$file_name);
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
            <h1>Add Student</h1>
            <form action="" method="post" enctype="multipart/form-data">
                Children ID<input type="text" name="id" required><br>
                Children First-Name<input type="text" name="fname" required><br>
                Children Last-Name<input type="text" name="lname" required><br>
                <input type="file" name="img"><br>
                <input type="submit" name="submit">
            </form>
        </div>
    </body>
</html>