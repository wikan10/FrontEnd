<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lokasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('layout/header'); ?>

    <div class="container mt-5">
    <?php if (isset($message)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h1 class="mb-4">Tambah Lokasi</h1>

    <!-- Form tambah lokasi -->
    <?php echo form_open('lokasi/simpan'); ?>
        <div class="mb-3">
            <label for="namaLokasi" class="form-label">Nama Lokasi</label>
            <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" required>
        </div>
        <div class="mb-3">
            <label for="negara" class="form-label">Negara</label>
            <input type="text" class="form-control" id="negara" name="negara" required>
        </div>
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    <?php echo form_close(); ?>
    </div>
    <!-- Footer -->
    <?php $this->load->view('layout/footer'); ?>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
