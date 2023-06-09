<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>
				<a href='index.php?action=add&id=" . $this->prosespasien->getId($i) . "'><button type='button' class='btn btn-success'>Edit</button></a>
            	<a href='index.php?action=hapus&id=" . $this->prosespasien->getId($i) . "'><button type='button' class='btn btn-danger'>Delete</button></a>
          	</td>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function form($id)
	{
		$form = null;
		if ($id) {
			$this->prosespasien->prosesDataPasien();
			for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
				if ($id == $this->prosespasien->getId($i)) {
					$form .=
						"<input hidden name='action' value='editPasien'>
		<input hidden name='id' value='" . $this->prosespasien->getId($i) . "'>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>NIK</label>
		  <input type='text' class='form-control' name='nik' placeholder='Masukkan nik pasien...' value='" . $this->prosespasien->getNik($i) . "'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Nama</label>
		  <input type='text' class='form-control' name='nama' placeholder='Masukkan nama pasien...' value='" . $this->prosespasien->getNama($i) . "'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Tempat</label>
		  <input type='text' class='form-control' name='tempat' placeholder='Masukkan tempat pasien...' value='" . $this->prosespasien->getTempat($i) . "'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Tanggal Lahir</label>
		  <input type='date' name='tl' class='form-control' value='" . $this->prosespasien->getTl($i) . "'>
		</div>
		<div class='form-group'>
			<label for='exampleFormControlSelect1'>Gender</label>
		  <select name='gender' class='form-control' id='exampleFormControlSelect1'>
			<option>Laki-laki</option>
			<option>Perempuan</option>
		  </select>
		</div>
		<div class='form-group'>
			<label for='exampleFormControlInput1'>Email address</label>
			<input type='email' name='email' class='form-control' placeholder='name@example.com' value='" . $this->prosespasien->getEmail($i) . "'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Nomor Telepon</label>
		  <input type='text' name='telp' class='form-control' placeholder='Masukkan nomor telepon pasien pasien...' value='" . $this->prosespasien->getTelp($i) . "'>
		</div>";
					break;
				}
			}
		} else {
			$form .=
				"<input hidden name='action' value='addPasien'>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>NIK</label>
		  <input type='text' class='form-control' name='nik' placeholder='Masukkan nik pasien...'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Nama</label>
		  <input type='text' class='form-control' name='nama' placeholder='Masukkan nama pasien...'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Tempat</label>
		  <input type='text' class='form-control' name='tempat' placeholder='Masukkan tempat pasien...'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Tanggal Lahir</label>
		  <input type='date' name='tl' class='form-control'>
		</div>
		<div class='form-group'>
			<label for='exampleFormControlSelect1'>Gender</label>
		  <select name='gender' class='form-control' id='exampleFormControlSelect1'>
			<option>Laki-laki</option>
			<option>Perempuan</option>
		  </select>
		</div>
		<div class='form-group'>
			<label for='exampleFormControlInput1'>Email address</label>
			<input type='email' name='email' class='form-control' placeholder='name@example.com'>
		</div>
		<div class='form-group'>
		  <label for='exampleFormControlInput1'>Nomor Telepon</label>
		  <input type='text' name='telp' class='form-control' placeholder='Masukkan nomor telepon pasien pasien...'>
		</div>";
		}

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		$this->tpl->replace("FORM", $form);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function addData($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$this->prosespasien->addDataPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp);
		header("location:index.php");
	}

	function editData($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$this->prosespasien->editDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
		header("location:index.php");
	}

	function delete($id)
	{
		$this->prosespasien->deleteDataPasien($id);
		header("location:index.php");
	}
}
