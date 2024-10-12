<div class="col-md-12">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><?= $judul ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Barang</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($barang as $value) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('gambar/' . ($value['gambar'])) ?>"
                                                class="img-fluid img-thumbnail"
                                                alt="Gambar Barang"
                                                style="width: 170px; height: 180px;">
                                        </td>

                                        <td>
                                            <h5><?= $value['nama_barang']  ?></h5>
                                            <p>
                                                <b>Nama Peminjam : </b><?= $value['nama_anggota'] ?> <br>
                                                <b>Tanggal Harus Kembali : </b><?= $value['tgl_harus_kembali']  ?><br>
                                                <b>Pj Barang : </b><?= $value['nama_pj'] ?><br>
                                                <b>Lokasi Barang : </b><?= $value['nama_lokasi']  ?> <br>
                                                <b>Jumlah Barang: </b><?= $value['jumlah_barang'] ?><br>

                                            </p>
                                        </td>

                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>