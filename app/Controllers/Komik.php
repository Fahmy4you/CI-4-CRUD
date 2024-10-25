<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;
  
  public function __construct()
  {
    // $komikModel = new \App\Models\KomikModel();
    
    $this->komikModel = new KomikModel();
  }
  
	public function index()
	{
	  $data = [
	    "title" => "Daftar Komik",
	    "komik" => $this->komikModel->getKomik(),
	   ];
	   
		return view('komik/index', $data);
	}
	
	public function detail($slug)
	{
	  $data = [
	    "title" => 'Detail Komik',
	    "komik" => $this->komikModel->getKomik($slug),
	   ];
	   
	   // Jika Komik Tidak Ada Di Tabel
	   if(empty($data['komik']))
	   {
	     throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik '. $slug . ' Tidak Di Temukan');
	   }
	   
	   return view('komik/detail', $data);
	}
	
	public function create()
	{
	  // session(); Dipindah Ke BaseController
	  $data = [
	    "title" => "Page Create Data Komik",
	    'validation' => \Config\Services::validation(),
	   ];
	   
	   return view('komik/create', $data);
	}
	
	public function save()
	{
	  // Validation Input Create
	  if(!$this->validate([
	    'judul' => [
	      'rules' => 'required|is_unique[komik.judul]',
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	        'is_unique' => '{field} Komik Sudah Ada!',
	       ],
	     ],
	    'penulis' => [
	      'rules' => 'required',
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	       ],
	     ],
	    'penerbit' => [
	      'rules' => 'required',
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	       ],
	     ],
	    'sampul' => [
	      'rules' => 'max_size[sampul,2000]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
	      'errors' => [
	        'max_size' => 'Ukuran Gambar Terlalu Besar',
	        'is_image' => 'Yang Harus Diuploud Hanya File jpg, png, jpeg',
	        'mime_in'  => 'Yang Anda Pilih Bukan Gambar',
	       ],
	     ],
	   ])) {
	   //  $validation = \Config\Services::validation();
	   //  return redirect()->to('/Komik/create')->withInput()->with('validation', $validation);
	   return redirect()->to('/Komik/create')->withInput();
	   }
	  
	  // Ambil Gambar / Kelola Gambar
	  $fileSampul = $this->request->getFile('sampul');
	  // Apakah Tidak Ada File Yang Di Uploud
	  if( $fileSampul->getError() == 4 ) {
	    $namaFileSampul = 'default.jpeg';
	  } else {
	   // Generate Nama Gambar Random
	  $namaFileSampul = $fileSampul->getRandomName();
	  
	  // Pindah File Ke Folder Public Img
	  $fileSampul->move('img', $namaFileSampul);
	  }
	  
	  // Insert Data
	  $slug = url_title($this->request->getVar('judul'), '-', true);
	  
	  $this->komikModel->save([
	    'judul'    => $this->request->getVar('judul'),
	    'slug'     => $slug,
	    'penulis'  => $this->request->getVar('penulis'),
	    'penerbit' => $this->request->getVar('penerbit'),
	    'sampul'   => $namaFileSampul,
	 ]);
	 
	 session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan');
	 
	 return redirect()->to('/komik');
	}
	
	public function delete($id)
	{
	  // Cari Gambar Berdasarkan Id 
	  $komik = $this->komikModel->find($id);
	  
	  // Cek Jika Gambar Nya Default
	  if( $komik['sampul'] != 'default.jpeg') {
	    // Hapus Gambar
	    unlink('img/' . $komik['sampul']);
	  }
	  
	  $this->komikModel->delete($id);
	  session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
	  
	  return redirect()->to('/komik');
	}
	
	public function edit($slug)
	{
	  $data = [
	    "title" => "Page Edit Data Komik",
	    'validation' => \Config\Services::validation(),
	    'komik' => $this->komikModel->getKomik($slug),
	   ];
	   
	   return view('komik/edit', $data);
	}
	
	public function update($id)
	{
	  // Cek Judul 
	  $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
	  if($komikLama['judul'] == $this->request->getVar('judul')) {
	    $rule_judul = 'required';
	  } else {
	    $rule_judul = 'required|is_unique[komik.judul]';
	  }
	  
	  // Validation Input Edit
	  if(!$this->validate([
	    'judul' => [
	      'rules' => $rule_judul,
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	        'is_unique' => '{field} Komik Sudah Ada!',
	       ],
	     ],
	    'penulis' => [
	      'rules' => 'required',
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	       ],
	     ],
	    'penerbit' => [
	      'rules' => 'required',
	      'errors' => [
	        'required' => '{field} Komik Harus Diisi!',
	       ],
	     ],
	    'sampul' => [
	      'rules' => 'max_size[sampul,2000]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
	      'errors' => [
	        'max_size' => 'Ukuran Gambar Terlalu Besar',
	        'is_image' => 'Yang Harus Diuploud Hanya File jpg, png, jpeg',
	        'mime_in'  => 'Yang Anda Pilih Bukan Gambar',
	       ],
	     ],
	   ])) {
	     return redirect()->to('/Komik/edit/'. $this->request->getVar('slug'))->withInput();
	   }	  
	   
    // Kelola Gambar Baru
    $fileSampul = $this->request->getFile('sampul');
    
    // Cek Gambar Berubah Enggak
    if( $fileSampul->getError() == 4 ) {
      $namaSampul = $this->request->getVar('sampulLama');
    } else {
      // Generate Nama File Random 
      $namaSampul = $fileSampul->getRandomName();
      // Pindah Gambar 
      $fileSampul->move('img', $namaSampul);
      // Hapus File Lama 
      unlink('img/'. $this->request->getVar('sampulLama'));
    }
	   
	  $slug = url_title($this->request->getVar('judul'), '-', true);
	  
	  $this->komikModel->save([
	    'id'       => $id,
	    'judul'    => $this->request->getVar('judul'),
	    'slug'     => $slug,
	    'penulis'  => $this->request->getVar('penulis'),
	    'penerbit' => $this->request->getVar('penerbit'),
	    'sampul'   => $namaSampul,
	 ]);
	 
	 session()->setFlashdata('pesan', 'Data Berhasil Di Edit');
	 
	 return redirect()->to('/komik');
	}
	
}
