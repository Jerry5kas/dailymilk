<?php 

require 'include/milkprams.php';

$cid = $_POST['catid'];

$c = $mysqli->query("select * from tbl_subcat where cid=".$cid." and status=1");
?>
<option value="">Select A Subcategory</option>
<?php 

while($row = $c->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}