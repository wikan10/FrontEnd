<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <?php $this->load->view('layout/header'); ?>

    <div class="container mt-4 margintop">
        <h2 class="mb-4">Daftar Lokasi</h2>
        <table class="table table-striped">
        <a href="<?php echo site_url('lokasi/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
            <thead>
                <tr>
                    <th scope="col">Nama Lokasi</th>
                    <th scope="col">Negara</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lokasi)): ?>
                    <?php foreach ($lokasi as $index => $value): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($value['namaLokasi'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['negara'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['provinsi'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['kota'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($value['createdAt'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="<?php echo site_url('lokasi/edit/'.$value['id']); ?>">Edit</a>
                                <a class="btn btn-danger btn-sm" href="<?php echo site_url('lokasi/delete/'.$value['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Tidak ada lokasi yang tersedia.</td>
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
