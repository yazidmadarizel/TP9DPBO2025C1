<?php

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Mahasiswa.class.php");
include("model/TabelMahasiswa.class.php");

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

// Interface atau gambaran dari presenter akan seperti apa
interface KontrakPresenter
{
	public function prosesDataMahasiswa();
	public function getId($i);
	public function getNim($i);
	public function getNama($i);
	public function getTempat($i);
	public function getTl($i);
	public function getGender($i);
	public function getEmail($i);    // Tambahkan kontrak untuk email
	public function getTelp($i);     // Tambahkan kontrak untuk telepon
	public function getSize();
	
	// Fungsi CRUD
	public function tambahMahasiswa($nim, $nama, $tempat, $tl, $gender, $email, $telp);
	public function editMahasiswa($id, $nim, $nama, $tempat, $tl, $gender, $email, $telp);
	public function hapusMahasiswa($id);
	public function detailMahasiswa($id);
}