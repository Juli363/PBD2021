<?php
session_start();
$conn = mysqli_connect('localhost','root','','akademik');
$koneksi = mysqli_connect('localhost','root','','akademik');

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM user where username='$username' AND password = '$password'";
$row = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($row);
$cek = mysqli_num_rows($row);


if($cek > 0){
    if($data['level'] == 'admin'){
        $_SESSION['level'] = 'admin';
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        header('location:curd_4.php');
    }

	else if($data['level'] == 'pegawai'){
        $_SESSION['level'] = 'pegawai';
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        header('location:curd_4-pegawai.php');
	}
}
else
{
    header('location:index.php?pesan=gagal');
}
?>