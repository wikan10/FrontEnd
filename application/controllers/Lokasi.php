<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Input $input
 */
class Lokasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
    
    }

    public function index() {
        $apiUrl = 'http://localhost:8080/api/lokasi'; // Ganti dengan URL API yang sesuai

        // Initialize cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== FALSE) {
            $data['lokasi'] = json_decode($response, true);
        } else {
            $data['lokasi'] = [];
        }

        $this->load->view('lokasi/lokasi_list', $data);
    }

    public function tambah() {
        $this->load->view('lokasi/tambah');
    }

    public function simpan() {
        // Ambil data dari input form
        $data = array(
            'namaLokasi' => $this->input->post('namaLokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'createdAt' => date('c') // Format ISO 8601
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
        $response = file_get_contents('http://localhost:8080/api/lokasi', false, $context);

        if ($response) {
            // Jika berhasil, kembalikan ke halaman daftar lokasi
            $data['message'] = "Lokasi berhasil ditambahkan";
            $this->index(); // Anda dapat mengubah ini jika memiliki daftar lokasi
        } else {
            // Jika gagal, tetap di halaman tambah dan tampilkan pesan error
            $data['message'] = "Gagal menambahkan lokasi";
            $this->load->view('lokasi/tambah', $data);
        }
    }

    public function edit($id) {
        // Fetch the location details from the API
        $ch = curl_init('http://localhost:8080/api/lokasi/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        if (!$response) {
            show_error('Failed to retrieve location data.');
        }
    
        $data['lokasi'] = json_decode($response, true);
    
        $this->load->view('lokasi/lokasi_edit', $data);
    }

    public function update($id) {
        // Retrieve input data
        $namaLokasi = $this->input->post('namaLokasi');
        $negara = $this->input->post('negara');
        $provinsi = $this->input->post('provinsi');
        $kota = $this->input->post('kota');
        $createdAt = $this->input->post('createdAt');
    
        // Validate input data
        if (empty($namaLokasi) || empty($negara) || empty($provinsi) || empty($kota)) {
            $data['error'] = 'Semua field wajib diisi.';
            $this->load->view('lokasi/lokasi_edit', $data);
            return;
        }
    
        // Prepare data to send to the API
        $data = [
            'namaLokasi' => $namaLokasi,
            'negara' => $negara,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'createdAt' => $createdAt
        ];
    
        // Convert data to JSON
        $json_data = json_encode($data);
    
        // Initialize cURL
        $ch = curl_init('http://localhost:8080/api/lokasi/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    
        // Execute the PUT request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
            // Redirect to location list with success message
            redirect('lokasi');
        } else {
            // Handle errors or reload the form with an error message
            $data['error'] = 'Failed to update location. Please try again.';
            $this->load->view('lokasi/lokasi_edit', $data);
        }
    }

    public function delete($id) {
        // Initialize cURL
        $ch = curl_init('http://localhost:8080/api/lokasi/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
        // Execute the DELETE request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
            // Redirect to location list with success message
            redirect('lokasi');
        } else {
            // Handle errors or redirect with an error message
            redirect('lokasi');
        }
    }
}

    
