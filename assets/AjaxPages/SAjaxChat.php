<?php
include("../Connection/Connection.php");
session_start();

    $insQry="insert into tbl_chat (chat_fromoid,chat_touid,chat_content,chat_datetime) values('".$_SESSION["oid"]."','".$_GET["id"]."','".$_GET["chat"]."',DATE_FORMAT(sysdate(), '%M %d %Y, %h:%i %p'))";
    if($con->query($insQry))
    {
        echo "sended";
    }
    else
    {
        echo "failed";
    }
    
    
?>