<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;
		$action = isset($_GET['action']) ? $_GET['action'] : "";
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		
		// Proses berdasarkan action
		if ($action == "add") {
			$this->tampilFormTambah();
			return;
		} else if ($action == "edit" && !empty($id)) {
			$this->tampilFormEdit($id);
			return;
		} else if ($action == "delete" && !empty($id)) {
			$this->prosesmahasiswa->hapusMahasiswa($id);
			return;
		} else if ($action == "detail" && !empty($id)) {
			$this->tampilDetail($id);
			return;
		}
		
		// Proses form tambah data
		if (isset($_POST['add'])) {
			$nim = $_POST['nim'];
			$nama = $_POST['nama'];
			$tempat = $_POST['tempat'];
			$tl = $_POST['tl'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			
			$this->prosesmahasiswa->tambahMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
			return;
		}
		
		// Proses form edit data
		if (isset($_POST['update'])) {
			$id = $_POST['id'];
			$nim = $_POST['nim'];
			$nama = $_POST['nama'];
			$tempat = $_POST['tempat'];
			$tl = $_POST['tl'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			$telp = $_POST['telp'];
			
			$this->prosesmahasiswa->editMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
			return;
		}

		// Tampilkan data mahasiswa dalam tabel
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			$id = $this->prosesmahasiswa->getId($i);
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelp($i) . "</td>
			<td>
				<a href='index.php?action=detail&id=$id' class='btn btn-info btn-sm'>Detail</a>
				<a href='index.php?action=edit&id=$id' class='btn btn-warning btn-sm'>Edit</a>
				<a href='index.php?action=delete&id=$id' class='btn btn-danger btn-sm' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'>Hapus</a>
			</td>
			</tr>";
		}
		
		// Membuat tombol tambah data
		$addButton = "
		<div class='text-left mb-4'>
			<a href='index.php?action=add' class='btn btn-primary'>Tambah Data</a>
		</div>";
		
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);
		$this->tpl->replace("DATA_BUTTON_ADD", $addButton);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	
	function tampilFormTambah()
	{
		// Form tambah data
		$form = "
		<div class='container mt-4'>
			<div class='card'>
				<div class='card-header bg-primary text-white'>
					<h5 class='mb-0'>Tambah Data Mahasiswa</h5>
				</div>
				<div class='card-body'>
					<form method='post' action='index.php'>
						<div class='form-group'>
							<label for='nim'>NIM</label>
							<input type='text' class='form-control' id='nim' name='nim' required>
						</div>
						<div class='form-group'>
							<label for='nama'>Nama</label>
							<input type='text' class='form-control' id='nama' name='nama' required>
						</div>
						<div class='form-group'>
							<label for='tempat'>Tempat Lahir</label>
							<input type='text' class='form-control' id='tempat' name='tempat' required>
						</div>
						<div class='form-group'>
							<label for='tl'>Tanggal Lahir</label>
							<input type='date' class='form-control' id='tl' name='tl' required>
						</div>
						<div class='form-group'>
							<label>Gender</label>
							<div class='form-check'>
								<input class='form-check-input' type='radio' name='gender' id='laki' value='Laki-laki' checked>
								<label class='form-check-label' for='laki'>Laki-laki</label>
							</div>
							<div class='form-check'>
								<input class='form-check-input' type='radio' name='gender' id='perempuan' value='Perempuan'>
								<label class='form-check-label' for='perempuan'>Perempuan</label>
							</div>
						</div>
						<div class='form-group'>
							<label for='email'>Email</label>
							<input type='email' class='form-control' id='email' name='email' required>
						</div>
						<div class='form-group'>
							<label for='telp'>Telepon</label>
							<input type='text' class='form-control' id='telp' name='telp' required>
						</div>
						<button type='submit' class='btn btn-primary' name='add'>Simpan</button>
						<a href='index.php' class='btn btn-secondary'>Kembali</a>
					</form>
				</div>
			</div>
		</div>";
		
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin_form.html");
		
		// Mengganti kode DATA_FORM dengan form tambah data
		$this->tpl->replace("DATA_FORM", $form);
		$this->tpl->replace("DATA_TITLE", "Tambah Data Mahasiswa");
		
		// Menampilkan ke layar
		$this->tpl->write();
	}
	
	function tampilFormEdit($id)
	{
		// Ambil data mahasiswa berdasarkan id
		$data = $this->prosesmahasiswa->detailMahasiswa($id);
		if ($data) {
			$checked_laki = ($data['gender'] == 'Laki-laki') ? 'checked' : '';
			$checked_perempuan = ($data['gender'] == 'Perempuan') ? 'checked' : '';
			
			// Form edit data
			$form = "
			<div class='container mt-4'>
				<div class='card'>
					<div class='card-header bg-warning text-white'>
						<h5 class='mb-0'>Edit Data Mahasiswa</h5>
					</div>
					<div class='card-body'>
						<form method='post' action='index.php'>
							<input type='hidden' name='id' value='" . $data['id'] . "'>
							<div class='form-group'>
								<label for='nim'>NIM</label>
								<input type='text' class='form-control' id='nim' name='nim' value='" . $data['nim'] . "' required>
							</div>
							<div class='form-group'>
								<label for='nama'>Nama</label>
								<input type='text' class='form-control' id='nama' name='nama' value='" . $data['nama'] . "' required>
							</div>
							<div class='form-group'>
								<label for='tempat'>Tempat Lahir</label>
								<input type='text' class='form-control' id='tempat' name='tempat' value='" . $data['tempat'] . "' required>
							</div>
							<div class='form-group'>
								<label for='tl'>Tanggal Lahir</label>
								<input type='date' class='form-control' id='tl' name='tl' value='" . $data['tl'] . "' required>
							</div>
							<div class='form-group'>
								<label>Gender</label>
								<div class='form-check'>
									<input class='form-check-input' type='radio' name='gender' id='laki' value='Laki-laki' $checked_laki>
									<label class='form-check-label' for='laki'>Laki-laki</label>
								</div>
								<div class='form-check'>
									<input class='form-check-input' type='radio' name='gender' id='perempuan' value='Perempuan' $checked_perempuan>
									<label class='form-check-label' for='perempuan'>Perempuan</label>
								</div>
							</div>
							<div class='form-group'>
								<label for='email'>Email</label>
								<input type='email' class='form-control' id='email' name='email' value='" . $data['email'] . "' required>
							</div>
							<div class='form-group'>
								<label for='telp'>Telepon</label>
								<input type='text' class='form-control' id='telp' name='telp' value='" . $data['telp'] . "' required>
							</div>
							<button type='submit' class='btn btn-warning' name='update'>Update</button>
							<a href='index.php' class='btn btn-secondary'>Kembali</a>
						</form>
					</div>
				</div>
			</div>";
			
			// Membaca template skin.html
			$this->tpl = new Template("templates/skin_form.html");
			
			// Mengganti kode DATA_FORM dengan form edit data
			$this->tpl->replace("DATA_FORM", $form);
			$this->tpl->replace("DATA_TITLE", "Edit Data Mahasiswa");
			
			// Menampilkan ke layar
			$this->tpl->write();
		} else {
			// Redirect jika data tidak ditemukan
			header("location:index.php");
		}
	}
	
	function tampilDetail($id)
	{
		// Ambil data mahasiswa berdasarkan id
		$data = $this->prosesmahasiswa->detailMahasiswa($id);
		if ($data) {
			// Tampilkan detail data
			$detail = "
			<div class='container mt-4'>
				<div class='card'>
					<div class='card-header bg-info text-white'>
						<h5 class='mb-0'>Detail Mahasiswa</h5>
					</div>
					<div class='card-body'>
						<table class='table table-bordered'>
							<tr>
								<th width='30%'>NIM</th>
								<td>" . $data['nim'] . "</td>
							</tr>
							<tr>
								<th>Nama</th>
								<td>" . $data['nama'] . "</td>
							</tr>
							<tr>
								<th>Tempat Lahir</th>
								<td>" . $data['tempat'] . "</td>
							</tr>
							<tr>
								<th>Tanggal Lahir</th>
								<td>" . $data['tl'] . "</td>
							</tr>
							<tr>
								<th>Gender</th>
								<td>" . $data['gender'] . "</td>
							</tr>
							<tr>
								<th>Email</th>
								<td>" . $data['email'] . "</td>
							</tr>
							<tr>
								<th>Telepon</th>
								<td>" . $data['telp'] . "</td>
							</tr>
						</table>
						<a href='index.php' class='btn btn-secondary'>Kembali</a>
					</div>
				</div>
			</div>";
			
			// Membaca template skin.html
			$this->tpl = new Template("templates/skin_form.html");
			
			// Mengganti kode DATA_FORM dengan detail data
			$this->tpl->replace("DATA_FORM", $detail);
			$this->tpl->replace("DATA_TITLE", "Detail Mahasiswa");
			
			// Menampilkan ke layar
			$this->tpl->write();
		} else {
			// Redirect jika data tidak ditemukan
			header("location:index.php");
		}
	}
}