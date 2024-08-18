<!DOCTYPE html>
<html>
<head>
    <title>Edit Lokasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php $this->load->view('layout/header'); ?>
    <div class="container margintop">
        <h1>Edit Lokasi</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="<?php echo site_url('lokasi/update/' . $lokasi['id']); ?>" method="post">
            <div class="form-group">
                <label for="namaLokasi">Nama Lokasi</label>
                <input type="text" class="form-control" id="namaLokasi" name="namaLokasi" value="<?php echo set_value('namaLokasi', $lokasi['namaLokasi']); ?>" required>
            </div>
            <div class="form-group">
                <label for="negara">Negara</label>
                <input type="text" class="form-control" id="negara" name="negara" value="<?php echo set_value('negara', $lokasi['negara']); ?>" required>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo set_value('provinsi', $lokasi['provinsi']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="<?php echo set_value('kota', $lokasi['kota']); ?>" required>
            </div>
            <div class="form-group">
                <label for="createdAt">Created At:</label>
                <input type="datetime-local" class="form-control" name="createdAt" 
                    value="<?php echo set_value('createdAt', $lokasi['createdAt'] ? date('Y-m-d\TH:i', strtotime($lokasi['createdAt'])) : ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
