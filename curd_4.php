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

<center>
	<h2>Data Program Studi</h2>
</center>
<br>
<br>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
<div class="container">
				
<table class= "table">

</head>
<body>


	</div>
		<tr>
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITASI</td>
			<td>AKSI</td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $row['idprodi']; ?></td>
			<td><?php echo $row['kdprodi']; ?></td>
			<td><?php echo $row['nmprodi']; ?></td>
			<td><?php echo $row['akreditasi']; ?></td>
			<td>
				<a href="curd_4.php?a=edit&id=<?php echo $row ['idprodi']; ?>"class="btn btn-primary btn-xs">EDIT</a>
				<a href="curd_4.php?a=hapus&id=<?php echo $row ['idprodi']; ?>"class="btn btn-danger btn-xs">HAPUS</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<td><a href="curd_4.php?a=input" class="btn btn-success">INPUT DATA</a></td>
	</div>
</body>
<?php } ?>

<?php
function input_data() {
	$row = array(
			"kdprodi" => "",
			"nmprodi" => "",
			"akreditasi" => "-"
		); ?>
<center>
	<h2>Input Data Program Studi</h2>
</center>
<br>
<br>
	<link rel="stylesheet" href="Bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
<div class="container">
	<form action="curd_4.php?a=list" method="post">
		<input type="hidden" name="sql" value="create">
		<label class="col-sm-2 col-form-label">Kode Prodi</label>
		<input type="text" name="kdprodi" placeholder="ID Prodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
		<br>
		<label class="col-sm-2 col-form-label">Nama Prodi</label>
		<input type="text" name="nmprodi" placeholder="Masukan Nama Prodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
		<br>
		<label class="col-sm-2 col-form-label">Akreditasi Prodi</label>

		<input type="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo "";} ?>> 
		<input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\""; } else {echo "";} ?> > A
		<input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\""; } else {echo "";} ?> > B
		<input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\""; } else {echo "";} ?> > C
		<br>
		</div>
		<center>
		<input type="submit" class="btn btn-success btn-xs" name="action" value="Simpan">
		<a href="curd_4.php?a=list" class="btn btn-danger btn-xs">Batal</a>
		</center>
	</form>
<?php } ?>

<?php
function edit_data($id) {
	global $hub;
	$query = "select * from dt_prodi where idprodi = $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>
<center>
	<h2>Edit Data Program Studi</h2>
</center>
<br>
<br>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
<div class="container">
	<form action="curd_4.php?a=list" method="post">
		<input type="hidden" name="sql" value="update">
		<input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">

		<label class="col-sm-2 col-form-label">Kode Prodi</label>

		<input type="text" name="kdprodi" maxlength ="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
		<br>
		<label class="col-sm-2 col-form-label">Nama Prodi</label>
		
		<input type="text" name="nmprodi" maxlength ="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
		<br>
		<label class="col-sm-2 col-form-label">Akreditasi Prodi</label>
		<input type="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=="-" || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
		<input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\""; } else {echo "";} ?> > A
		<input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\""; } else {echo "";} ?> > B
		<input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\""; } else {echo "";} ?> > C
		<br>
		<center>
		<input type="submit" class="btn btn-success btn-xs" name="action" value="Simpan">
		<a href="curd_4.php?a=list" class="btn btn-danger btn-xs">Batal</a>
		</center>
		</div>
	</form>
<?php } ?>

<?php
function hapus_data($id) {
	global $hub;
	$query = "select * from dt_prodi where idprodi = $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>
<center>
	<h2> Hapus Data Program Studi </h2>
</center>
<br>
<br>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<form action="curd_4.php?a=list" method="post">
		<input type="hidden" name="sql" value="delete">
		<input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
		<div class="container">
		
		<label class="col-sm-2 col-form-label">Kode Prodi</label>
		<input type="text" maxlength="6" size="6"type="text" placeholder="<?php echo trim($row["kdprodi"]) ?>" disabled>
		<br>
		<label class="col-sm-2 col-form-label">Nama Prodi</label>
		<input type="text"maxlength="70" size="70" type="text" placeholder="<?php echo trim($row["nmprodi"]) ?>" disabled>
		
		<br>
		<label class="col-sm-2 col-form-label">Akreditasi</label>
		<input type="text" maxlength="70" size="70" type="text" placeholder="<?php echo trim($row["akreditasi"]) ?>" disabled>

		<br>
		<br>
		<center>
		<input type="submit"class="btn btn-success btn-xs" name="action" value="Hapus">
		<a href="curd_4.php?a=list"class="btn btn-danger btn-xs">Batal</a>
		</center>
	</form>
<?php } ?>

<?php
 
function create_prodi() {
	global $hub;
	global $_POST;
	$query = "insert into dt_prodi (kdprodi, nmprodi, akreditasi) 
	value";
	$query .= "('".$_POST["kdprodi"]."', '".$_POST["nmprodi"]."', '".$_POST["akreditasi"]."')";
	mysqli_query($hub, $query) or die(mysqli_error($hub, $query));
}

function update_prodi() {
	global $hub;
	global $_POST;
	$query = "UPDATE dt_prodi";
	$query .= " SET kdprodi='".$_POST["kdprodi"]."', nmprodi='". $_POST["nmprodi"]."', akreditasi='".$_POST["akreditasi"]."'";
	$query .= " WHERE idprodi = ".$_POST["idprodi"];
	mysqli_query($hub, $query) or die(mysqli_error($hub, $query));
}

function delete_prodi() {
	global $hub;
	global $_POST;
	$query = "DELETE FROM dt_prodi";
	$query .= " WHERE idprodi = ".$_POST["idprodi"];
	mysqli_query($hub, $query) or die(mysqli_error($hub, $query));
}
?>