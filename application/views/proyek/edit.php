<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >
<?php $this->load->view('layout/header'); ?>

<?php echo form_open('proyek/update/' . $proyek['id']); ?>

<div class="container mt-4 margintop margintop">
        <h2 class="mb-4">Edit Proyek</h2>

<div class="form-group">
    <label for="namaProyek">Nama Proyek:</label>
    <input type="text" class="form-control" name="namaProyek" value="<?php echo set_value('namaProyek', $proyek['namaProyek']); ?>">
</div>

<div class="form-group">
    <label for="tglMulai">Tanggal Mulai:</label>
    <input type="datetime-local" class="form-control" name="tglMulai" 
           value="<?php echo set_value('tglMulai', $proyek['tglMulai'] ? date('Y-m-d\TH:i', strtotime($proyek['tglMulai'])) : ''); ?>">
</div>

<div class="form-group">
    <label for="tglSelesai">Tanggal Selesai:</label>
    <input type="datetime-local" class="form-control" name="tglSelesai" 
           value="<?php echo set_value('tglSelesai', $proyek['tglSelesai'] ? date('Y-m-d\TH:i', strtotime($proyek['tglSelesai'])) : ''); ?>">
</div>

<div class="form-group">
    <label for="pimpinanProyek">Pimpinan Proyek:</label>
    <input type="text" class="form-control" name="pimpinanProyek" value="<?php echo set_value('pimpinanProyek', $proyek['pimpinanProyek']); ?>">
</div>

<div class="form-group">
    <label for="keterangan">Keterangan:</label>
    <textarea class="form-control" name="keterangan"><?php echo set_value('keterangan', $proyek['keterangan']); ?></textarea>
</div>

<div class="form-group">
    <label for="createdAt">Created At:</label>
    <input type="datetime-local" class="form-control" name="createdAt" 
           value="<?php echo set_value('createdAt', $proyek['createdAt'] ? date('Y-m-d\TH:i', strtotime($proyek['createdAt'])) : ''); ?>">
</div>


<button type="submit" class="btn btn-primary">Update</button>
<a href="<?php echo site_url('proyek'); ?>" class="btn btn-secondary">Batal</a>


</div>

<?php echo form_close(); ?>


</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>