<?php 

require 'include/milkprams.php';

$cid = $_POST['cityid'];

$c = $mysqli->query("select * from tbl_product where cityid=".$cid." and status=1");
?>
<?php 

while($row = $c->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['ptitle'];?></option>
	<?php 
}