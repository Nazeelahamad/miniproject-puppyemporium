
<?php
include("../assets/Connection/Connection.php");
session_start();




 $selQry = "select * from tbl_chat c inner join tbl_owner b on (b.owner_id=c.chat_tooid) or (b.owner_id=c.chat_fromoid) where b.owner_id='".$_SESSION["oid"]."' order by chat_datetime";
    $rowdis=$con->query($selQry);
     while($datadis=$rowdis->fetch_assoc())
  
    {
        if ($datadis["chat_fromuid"]==$_GET["id"]) {

            $selQry1= "select * from tbl_user where user_id  ='".$_GET["id"]."'";
    $rowdis1=$con->query($selQry1);
     if($datadis1=$rowdis1->fetch_assoc())
  
{
            
?>

<div class="chat-message is-received">
    <!-- <img src="../assets/Files/User/Photo/<?php echo $datadis1["user_photo"] ?>" alt=""> -->
    <div class="message-block">
        <span><?php echo $datadis1["user_name"] ?></span>
        <div class="message-text"><?php echo $datadis["chat_content"] ?></div>
    </div>
</div>
    <div class="chat-message" style="margin: 0px; padding: 0px" >

</div>

<?php
        }

} else {
    
?>
<div class="chat-message is-sent">
    <img src="../assets/Files/Seller/Photo/<?php echo $datadis["owner_photo"] ?>" alt="">
    <div class="message-block">
        <span><?php echo $datadis["owner_name"] ?></span>
        <div class="message-text"><?php echo $datadis["chat_content"] ?></div>
    </div>
</div>
        <div class="chat-message" style="margin: 0px; padding: 0px" >

</div>
<?php
    }

        }
    


?>