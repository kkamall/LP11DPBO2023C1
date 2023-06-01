<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function addPasienById($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$query = "INSERT INTO pasien (nik, nama, tempat, tl, gender, email, telp) VALUES ('$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp')";
		return $this->execute($query);
	}

	function deletePasienById($id)
	{
		$query = "DELETE FROM pasien WHERE id = '$id'";
		return $this->execute($query);
	}
	
	function editPasienById($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$query = "UPDATE pasien SET nik = '$nik', nama = '$nama', tempat = '$tempat', tl = '$tl', gender = '$gender', email = '$email', telp = '$telp' WHERE id = '$id'";
		return $this->execute($query);
	}
}
