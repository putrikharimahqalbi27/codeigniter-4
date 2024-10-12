<?= $this->extend('v_template_anggota') ?>

<?= $this->section('content') ?>
<h1><?= $judul ?></h1>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
    </div>
<?php endif; ?>

<h2>Data Peminjaman Barang</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Lama Pinjam</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($pengambilanbarang)) : ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data peminjaman.</td>
            </tr>
            <?php foreach ($pengambilanbarang as $peminjaman): ?>
                <div>
                    <h5><?= $peminjaman['nama_barang']; ?></h5>
                    <p>Tanggal Pinjam: <?= $peminjaman['tgl_pinjam']; ?></p>
                    <p>Tanggal Harus Kembali: <?= $peminjaman['tgl_harus_kembali']; ?></p>

                    <form action="<?= base_url('Peminjaman/KembalikanBarang/' . $peminjaman['id_pinjam']); ?>" method="post">
                        <button type="submit" class="btn btn-danger">Kembalikan Barang</button>
                    </form>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>