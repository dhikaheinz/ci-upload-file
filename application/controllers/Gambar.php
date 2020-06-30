<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gambar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('GambarModel'); //menload model
    }

    public function index()
    {
        $data['gambar'] = $this->GambarModel->view();
        $this->load->view('view', $data); //membuat view baru degan data
    }

    public function tambah()
    {
        $data = array();

        if ($this->input->post('submit')) { // jika melakukan submit akan melakukan proses upload
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->GambarModel->upload();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php melakukan penyimpanan data
                $this->GambarModel->save($upload);

                redirect('gambar'); // Redirect kembali ke halaman awal / halaman view data
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }

        $this->load->view('form', $data);
    }
}
