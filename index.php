<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='1'){
    header('Location: ../index.php');
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
            <form action="../logout.php" method="get" >
                <input type="submit" value="Logout" id="button1">
            </form>
            <form action="read_feedback.php" method="get" >
                <input type="submit" value="Read-Feedback" id="button1">
            </form>
            <form action="send_message.php" method="get" >
                <input type="submit" value="Send-Message" id="button1">
            </form>
            <form action="show_comments.php" method="get" >
                <input type="submit" value="Show-Comments" id="button1">
            </form>
            <form action="request_meeting.php" method="get" >
                <input type="submit" value="Meeting-Requests" id="button1">
            </form>
            <form action="edit_info.php" method="get" >
                <input type="submit" value="Edit-child" id="button1">
            </form>
            <form action="add_child.php" method="get" >
                <input type="submit" value="Add-Child" id="button1">
            </form>
        </div>
    </body>
</html>