<?php 

/*Praktikum DPBO*/
/*1905166 Naufal Fasya Faddillah*/
class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskSubject(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY subject_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskPriority(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY priority_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskDeadline(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY deadline_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getTaskStatus(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY status_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertTask($data){
		$tname = $data['tname'];
		$tdetails = $data['tdetails'];
		$tsubject = $data['tsubject'];
		$tpriority = $data['tpriority'];
		$tdeadline = $data['tdeadline'];
		$tstatus = "Belum";

		$query = "INSERT INTO tb_to_do (name_td, details_td, subject_td, priority_td, deadline_td, status_td) VALUES ('$tname', '$tdetails', '$tsubject', '$tpriority', '$tdeadline', '$tstatus')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function deleteTask($id_task){
		$query = "DELETE FROM tb_to_do WHERE id=$id_task";

		return $this->execute($query);
	}

	function updateTask($id){
		$query = "UPDATE tb_to_do SET status_td = 'Sudah' WHERE id = $id";

		return $this->execute($query);
	}
	
}



?>
