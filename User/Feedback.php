<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

if(isset($_POST['submit']))
{
	
	$feedback=$_POST['txt_feedback'];
	$insqry="insert into tbl_feedback(feedback_contact) values('".$feedback."'	)";
	if($con->query($insqry))
	{
		?>
        <script>
        alert("Feedback Inserted");
		window.location="Feedback.php";
        </script>
        <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback Form</title>
</head>

<body>
<table width="827" height="236" border="1">
  <tr>
    <td width="142">Feedback</td>
    <td width="669">
      <form id="form1" name="form1" method="post" action="">
        <label for="txt_feedback3"></label>
        <textarea name="txt_feedback" id="txt_feedback3" cols="45" rows="5"></textarea>
        <input type="submit" name="submit" id="submit" value="Submit" />
      </form>
      <?php
      // Display feedback message if set
      if (isset($message)) {
          echo "<p>$message</p>";
      }
      ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
include("Foot.php");
?>