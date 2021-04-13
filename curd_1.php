<?php
require ("../pertemuan 1/koneksi.php");
$hub = open_connection();
read_data();
mysqli_close($hub);

?>
<?php

function read_data()
{
	global $hub;
	$query = "select * from dt_prodi";
	$result = mysqli_query ($hub,$query); ?>
	<h2>Read Data Program Studi</h2>
	<table border=1 cellpadding=2>
	<tr>
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITASI</td>
			<td>AKSI</td>
	</tr>

	<?php while ($row=mysqli_fetch_array($result,)) { ?>
	<TR>
		<TD><?php echo $row['idprodi'];?></TD>
		<TD><?php echo $row['kdprodi'];?></TD>
		<TD><?php echo $row['nmprodi'];?></TD>
		<TD><?php echo $row['akreditasi'];?></TD>
		<TD>Edit Hapus</TD>
	</TR>
		<?php } ?>
	</table>
<?php } ?>
