<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        // notifikasi
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <h4>Periksa Entry Form</h4>
                <ul>
                    <?php foreach ($errors as $key => $error) { ?>
                        <li><?= esc($error) ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php

        use PHPUnit\TextUI\Configuration\Variable;

        if (session()->getFlashdata('pesan')) {
            echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> ';
            echo session()->getFlashdata('pesan');
            echo '</h5></div>';
        }
        ?>

        <?php
        echo form_open_multipart('Barang/UpdateData/ ' . $barang['id_barang']);
        ?>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Gambar</label>
                            <img src="<?= base_url('gambar/' . $barang['gambar']) ?>" id="gambar_load" class="img-fluid" width="200" height="200">
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>File Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="preview_gambar" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input class="form-control" name="kode_barang" value="<?= $barang['kode_barang'] ?>" placeholder="Kode Barang">
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input class="form-control" name="nama_barang" value="<?= $barang['nama_barang'] ?>" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control">
                            <option value=" <?= $barang['id_kategori'] ?>"> <?= $barang['nama_kategori'] ?> </option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value['id_kategori'] ?>"> <?= $value['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penanggungjawab</label>
                        <select name="id_pj" class="form-control">
                            <option value=" <?= $barang['id_pj'] ?>"> <?= $barang['nama_pj'] ?> </option>
                            <?php foreach ($pj as $key => $value) { ?>
                                <option value="<?= $value['id_pj'] ?>"> <?= $value['nama_pj'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lokasi Barang</label>
                        <select name="id_lokasi" class="form-control">
                            <option value=" <?= $barang['id_lokasi'] ?>"> <?= $barang['nama_lokasi'] ?> lantai <?= $barang['lantai_lokasi'] ?></option>
                            <?php foreach ($lokasi as $key => $value) { ?>
                                <option value="<?= $value['id_lokasi'] ?>"> <?= $value['nama_lokasi'] ?> lantai <?= $value['lantai_lokasi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah_barang" value="<?= $barang['jumlah_barang'] ?>" placeholder="Jumlah Barang">
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <a href="<?= base_url('Barang') ?>" class="btn btn-secondary"><i class="fas fa-share"> Kembali </i></a>
            <button type="submit" class="btn btn-info"><i class="fas fa-save"> Simpan</i></button>

        </div>
        <?php echo form_close() ?>
    </div>
</div>

<!-- /.card -->