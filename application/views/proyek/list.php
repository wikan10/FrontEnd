<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Proyek dan Lokasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body >
    <!-- Navbar -->
    <?php $this->load->view('layout/header'); ?>
    <div class="container mt-4 margintop">
        <h2 class="mb-4">Daftar Proyek</h2>
        <table class="table table-striped">
        <a href="<?php echo site_url('proyek/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>

            <thead>
                <tr>
                    <th>Nama Proyek</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Pimpinan Proyek</th>
                    <th>Keterangan</th>
                    <th>Created At</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($proyek)): ?>
                    <?php foreach ($proyek as $value): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($value['namaProyek'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['tglMulai'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['tglSelesai'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['pimpinanProyek'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['keterangan'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['createdAt'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if (!empty($value['lokasi'])): ?>
                                    <?php echo htmlspecialchars($value['lokasi']['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#lokasiModal<?php echo $value['id']; ?>">
                                        Detail
                                    </button>
                                <?php else: ?>
                                    Tidak tersedia
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('proyek/edit/'.$value['id']); ?>">Edit</a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('proyek/delete/'.$value['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                <?php if ($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>
                                <?php endif; ?>

                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="lokasiModal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="lokasiModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="lokasiModalLabel">Detail Lokasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Lokasi:</strong> <?php echo htmlspecialchars($value['lokasi']['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p><strong>Negara:</strong> <?php echo htmlspecialchars($value['lokasi']['negara'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p><strong>Provinsi:</strong> <?php echo htmlspecialchars($value['lokasi']['provinsi'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p><strong>Kota:</strong> <?php echo htmlspecialchars($value['lokasi']['kota'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p><strong>Created At:</strong> <?php echo htmlspecialchars($value['lokasi']['createdAt'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Tidak ada proyek yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <?php $this->load->view('layout/footer'); ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
