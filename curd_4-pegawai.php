<?php
require("../CRUD/koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
	case "create":
		create_prodi();
		break;
	case "update":
		update_prodi();
		break;
	case "delete":
		delete_prodi();
		break;
}
switch ($a) {
	case "list":
		read_data();
		break;
	case "input":
		input_data();
		break;
	case "edit":
		edit_data($id);
		break;
	case "hapus":
		hapus_data($id);
		break;
	default:
		read_data();
		break;
}
mysqli_close($hub);
?>

<?php
function read_data() {
	global $hub;
	$query = "select * from dt_prodi";
	$result = mysqli_query($hub, $query); ?>
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
<div class="container"
<div class="card">
<div class="card-header">	<h2><center>Read Data Program Studi</center></h2></div>
</div>





</head>
<body>
<div class="container">
<div class="panel">
<div class="panel panel-info">
<table class= "table">
		<tr>
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITASI</td>
			
		</tr>
		<?php while($row = mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $row['idprodi']; ?></td>
			<td><?php echo $row['kdprodi']; ?></td>
			<td><?php echo $row['nmprodi']; ?></td>
			<td><?php echo $row['akreditasi']; ?></td>
</div>
</div>
</div>
		<?php } ?>
	</table>
	</div>
</body>
<?php } ?>