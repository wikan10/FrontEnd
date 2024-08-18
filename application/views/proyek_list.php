<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyek List</title>
</head>
<body>
    <h1>Daftar Proyek</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Proyek</th>
                <th>Lokasi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($proyek)): ?>
                <?php foreach($proyek as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['namaProyek']; ?></td>
                    <td><?php echo $p['lokasi']['namaLokasi']; ?></td>
                    <td><?php echo $p['tglMulai']; ?></td>
                    <td><?php echo $p['tglSelesai']; ?></td>
                    <td><a href="#">Edit</a> | <a href="#">Delete</a></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada proyek yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php $this->load->view('layouts/footer'); ?>
</body>
</html>
