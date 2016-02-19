<?php

$db = new mysqli("wm98.wedos.net", "a30267_ondris", "CH9LJbV8", "d30267_ondris");


mysqli_query($db, "SET CHARACTER SET utf8");
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }