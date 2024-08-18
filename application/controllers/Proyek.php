<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Input $input
 */

class Proyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('curl');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
    
    }

    public function index() {
        // Menampilkan daftar proyek
        $apiUrl = 'http://localhost:8080/api/proyek'; // Ganti dengan URL API yang sesuai
        $response = file_get_contents($apiUrl);
        if ($response !== FALSE) {
            $data['proyek'] = json_decode($response, true);
        } else {
            $data['proyek'] = [];
        }
        $this->load->view('proyek/list', $data);
    }

    public function tambah() {
        $apiUrl = 'http://localhost:8080/api/lokasi';
        $response = file_get_contents($apiUrl);
        
        if ($response !== FALSE) {
            $data['lokasi'] = json_decode($response, true);
        } else {
            $data['lokasi'] = [];
        }

        // // Debug data
        // echo '<pre>';
        // print_r($data['lokasi']);
        // echo '</pre>';
        $this->load->view('proyek/tambah', $data);
    }
    
    
    public function simpan() {
        // Ambil data dari input form
        $data = array(
            'namaProyek' => $this->input->post('namaProyek'),
            'tglMulai' => $this->input->post('tglMulai'),
            'tglSelesai' => $this->input->post('tglSelesai'),
            'pimpinanProyek' => $this->input->post('pimpinanProyek'),
            'keterangan' => $this->input->post('keterangan'),
            'createdAt' => $this->input->post('createdAt'),
            'lokasi' => array(
                'namaLokasi' => $this->input->post('namaLokasi'),
                'negara' => $this->input->post('negara'),
                'provinsi' => $this->input->post('provinsi'),
                'kota' => $this->input->post('kota'),
                'createdAt' => $this->input->post('createdAtLokasi')
            )
        );

        // Menggunakan file_get_contents untuk mengirim POST request ke API
        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );
        $context  = stream_context_create($options);
        $response = file_get_contents('http://localhost:8080/api/proyek', false, $context);

        if ($response) {
            // Jika berhasil, kembalikan ke halaman daftar proyek
            $data['message'] = "Proyek berhasil ditambahkan";
            $this->index(); // Panggil method index untuk menampilkan daftar proyek
        } else {
            // Jika gagal, tetap di halaman tambah dan tampilkan pesan error
            $data['message'] = "Gagal menambahkan proyek";
            $this->load->view('tambah', $data);
        }

    }
    
    
    

    public function edit($id) {
        // Fetch the project details from the API
        $ch = curl_init('http://localhost:8080/api/proyek/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        if (!$response) {
            show_error('Failed to retrieve project data.');
        }
    
        $proyek = json_decode($response, true);
    
        // Fetch locations for dropdown
        $ch = curl_init('http://localhost:8080/api/lokasi');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $lokasi_response = curl_exec($ch);
        curl_close($ch);
    
        if (!$lokasi_response) {
            show_error('Failed to retrieve location data.');
        }
    
        $data['proyek'] = $proyek;
        $data['lokasi'] = json_decode($lokasi_response, true);
    
        $this->load->view('proyek/edit', $data);
    }

    public function update($id) {
        // Retrieve input data
        $namaProyek = $this->input->post('namaProyek');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpinanProyek = $this->input->post('pimpinanProyek');
        $keterangan = $this->input->post('keterangan');
        $createdAt = $this->input->post('createdAt');
    
        // Validate input data
        if (empty($namaProyek) || empty($tglMulai) || empty($tglSelesai) || empty($pimpinanProyek) || empty($keterangan)) {
            $data['error'] = 'Semua field wajib diisi.';
            $this->load->view('proyek/edit', $data);
            return;
        }
    
        // Prepare data to send to the API
        $data = [
            'namaProyek' => $namaProyek,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'pimpinanProyek' => $pimpinanProyek,
            'keterangan' => $keterangan,
            'createdAt' => $createdAt
        ];
    
        // Convert data to JSON
        $json_data = json_encode($data);
    
        // Initialize cURL
        $ch = curl_init('http://localhost:8080/api/proyek/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    
        // Execute the PUT request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
            // Redirect to project list with success message
            redirect('proyek');
        } else {
            // Handle errors or reload the form with an error message
            $data['error'] = 'Failed to update project. Please try again.';
            $this->load->view('proyek/edit', $data);
        }
    }

    public function delete($id) {
        // Initialize cURL
        $ch = curl_init('http://localhost:8080/api/proyek/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
        // Execute the DELETE request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
        // Redirect to project list with success message
        redirect('proyek?status=success');
    } else {
        // Redirect to project list with error message
        redirect('proyek?status=error');
    }
    }
    
    

    
}