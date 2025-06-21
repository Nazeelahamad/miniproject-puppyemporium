
<?php
include('../connection/connection.php');
	  $selqry="select *from tbl_place where district_id='".$_GET['did']."'";
 		$result=$con->query($selqry);
 	  while($row= $result->fetch_assoc())
    {
		?>
        
    
      <option value="<?php echo $row['place_id']?>"><?php echo $row['place_name']?></option>
      <?php
	}
	  ?>