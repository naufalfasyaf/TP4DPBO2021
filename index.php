<?php

/*Praktikum DPBO*/
/*1905166 Naufal Fasya Faddillah*/

include("conf.php"); // Mengkoneksikan ke dalam Database
include("includes/Template.class.php"); // Menghubungkan kelas Template untuk tampilan
include("includes/DB.class.php"); // Menghubungkan kelas DB untuk menampung database
include("includes/Task.class.php"); // Menghubungkan kelas Task untuk menampung masukkan

// Membuat Task baru dari kelas Task
$start_task = new Task($db_host, $db_user, $db_password, $db_name);

// Buka task
$start_task->open();

// Menginisialisasikan Method yang berada pada kelas Task
if(isset($_POST['subject'])){
	$start_task->getTaskSubject();
}else if(isset($_POST['priority'])){
	$start_task->getTaskPriority();
}else if(isset($_POST['deadline'])){
	$start_task->getTaskDeadline();
}else if(isset($_POST['status'])){
	$start_task->getTaskStatus();
}else if(isset($_POST['reset'])){
	$start_task->getTask();
}else{
	$start_task->getTask();
}

/*Memulai memasukkan data ke dalam Database*/
// Inisialisasi data awal
$data = null;
$no = 1;
// Mulai memasukkan data
if(isset($_POST['add'])){
	$start_task->insertTask($_POST);
	header("Location:index.php");
}
/*Tampilan*/
while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $start_task->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

/*Proses menghapus data yang diinginkan dengan mencari ID_Task yang akan dihapus*/
// Proses hapus ID_Task
if(isset($_GET['id_hapus'])){
	$id_task = $_GET['id_hapus'];
	$start_task->deleteTask($id_task);
	unset($_GET['id_hapus']);
	header("Location: index.php");
}
// Proses hapus ID_Status
if(isset($_GET['id_status'])){
	$id_status = $_GET['id_status'];

	$start_task->updateTask($id_status);

	unset($_GET['id_status']);
	
	header("Location: index.php");
}

// Tutup database
$start_task->close();

// Membaca template skin.html
$tampilan = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tampilan->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tampilan->write();