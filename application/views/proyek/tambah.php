<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="margintop">
    <!-- Navbar -->
    <?php $this->load->view('layout/header'); ?>

    <div class="container mt-4 margintop">
    <h2 class="mb-4">Tambah Proyek</h2>

    <?php echo form_open('proyek/simpan'); ?>
        <div class="mb-3">
            <label for="namaProyek" class="form-label">Nama Proyek</label>
            <input type="text" class="form-control" id="namaProyek" name="namaProyek" required>
        </div>
        <div class="mb-3">
            <label for="tglMulai" class="form-label">Tanggal Mulai</label>
            <input type="datetime-local" class="form-control" id="tglMulai" name="tglMulai" required>
        </div>
        <div class="mb-3">
            <label for="tglSelesai" class="form-label">Tanggal Selesai</label>
            <input type="datetime-local" class="form-control" id="tglSelesai" name="tglSelesai" required>
        </div>
        <div class="mb-3">
            <label for="pimpinanProyek" class="form-label">Pimpinan Proyek</label>
            <input type="text" class="form-control" id="pimpinanProyek" name="pimpinanProyek" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
        </div>
        <div class="mb-3">
            <label for="createdAt" class="form-label">Waktu Dibuat</label>
            <input type="datetime-local" class="form-control" id="createdAt" name="createdAt" required>
        </div>

            <!-- Pilihan lokasi -->
            <div class="form-group">
                <label for="existingLocation" class="form-label">Pilih Lokasi</label>
                <select class="form-control selectpicker" id="existingLocation" name="existingLocation" data-live-search="true" required>
                    <option value="">Pilih lokasi yang ada (atau pilih 'Tambah Lokasi Baru')</option>
                    <?php if (!empty($lokasi) && is_array($lokasi)): ?>
                        <?php foreach ($lokasi as $item): ?>
                            <option value="<?php echo htmlspecialchars($item['id']); ?>" 
                                    data-nama-lokasi="<?php echo htmlspecialchars($item['namaLokasi']); ?>"
                                    data-negara="<?php echo htmlspecialchars($item['negara']); ?>"
                                    data-provinsi="<?php echo htmlspecialchars($item['provinsi']); ?>"
                                    data-kota="<?php echo htmlspecialchars($item['kota']); ?>"
                                    data-created-at="<?php echo htmlspecialchars($item['createdAt']); ?>">
                                <?php echo htmlspecialchars($item['namaLokasi']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Tidak ada lokasi tersedia</option>
                    <?php endif; ?>
                    <option value="add_new">Tambah Lokasi Baru</option>
                </select>
            </div>

            <div id="locationFields">
                <div class="mb-3">
                    <label for="namaLokasi" class="form-label">Nama Lokasi</label>
                    <input type="text" class="form-control" id="namaLokasi" name="namaLokasi">
                </div>
                <div class="mb-3">
                    <label for="negara" class="form-label">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara">
                </div>
                <div class="mb-3">
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi">
                </div>
                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota">
                </div>
                <div class="mb-3">
                    <label for="createdAtLokasi" class="form-label">Waktu Dibuat (Lokasi)</label>
                    <input type="datetime-local" class="form-control" id="createdAtLokasi" name="createdAtLokasi">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo site_url('proyek'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <!-- Footer -->
    <?php $this->load->view('layout/footer'); ?>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            $('#existingLocation').change(function() {
                var selectedOption = $(this).find('option:selected');
                var namaLokasi = selectedOption.data('nama-lokasi');
                var negara = selectedOption.data('negara');
                var provinsi = selectedOption.data('provinsi');
                var kota = selectedOption.data('kota');
                var createdAt = selectedOption.data('created-at');

                if ($(this).val() === 'add_new') {
                    $('#locationFields').find('input').val('');
                    $('#locationFields').show();
                } else {
                    $('#namaLokasi').val(namaLokasi);
                    $('#negara').val(negara);
                    $('#provinsi').val(provinsi);
                    $('#kota').val(kota);
                    $('#createdAtLokasi').val(createdAt ? new Date(createdAt).toISOString().slice(0,16) : '');
                    $('#locationFields').show();
                }
            });

            $('#locationFields').hide();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   
    <!-- Footer -->
    <?php $this->load->view('layout/footer'); ?>
   
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
