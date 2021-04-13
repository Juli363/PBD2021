<?php

require("koneksi.php");
$hub = open_connection();
if ($hub) 
{
    echo ("KONEKSI SUKSES");
} 
else
{
    echo ("KONEKSI GAGAL");
}

mysqli_close($hub);
?>