<h1 class="h3 mb-4 text-gray-800">Edit Barang</h1>
<p><a href="<?= base_url('barang'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Edit Barang Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barang/edit'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= set_value('id') ? set_value('id') : $data['id']; ?>">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?= set_value('kode_barang') ? set_value('kode_barang') : $data['kode_barang'] ?>" required readonly>
                <?php echo form_error('kode_barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= set_value('nama_barang') ? set_value('nama_barang') : $data['nama_barang'] ?>" required>
                <?php echo form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="merk">Merk</label>
                <select class="form-control" id="merk" name="merk">
                    <option selected disabled>Select Merk</option>
                    <?php
                    if (set_value('merk')) {
                    ?>
                        <?php foreach ($dataMerk as $merk) { ?>
                            <?php
                            $selectedMerk = '';
                            if (set_value('merk') === $merk['id']) {
                                $selectedMerk = 'selected';
                            }
                            ?>
                            <option value="<?= $merk['id']; ?>" <?= $selectedMerk; ?>><?= $merk['name']; ?></option>
                        <?php } ?>
                    <?php
                    } else {
                    ?>
                        <?php foreach ($dataMerk as $merk) { ?>
                            <?php
                            $selectedMerk = '';
                            if ($data['id_merk'] === $merk['id']) {
                                $selectedMerk = 'selected';
                            }
                            ?>
                            <option value="<?= $merk['id']; ?>" <?= $selectedMerk; ?>><?= $merk['name']; ?></option>
                        <?php } ?>
                    <?php
                    }
                    ?>

                </select>
                <?php echo form_error('merk', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <select class="form-control" id="satuan" name="satuan">
                    <option selected disabled>Select Satuan</option>
                    <?php
                    if (set_value('satuan')) {
                    ?>
                        <?php foreach ($dataSatuan as $satuan) { ?>
                            <?php
                            $selectedSatuan = '';
                            if (set_value('satuan') === $satuan['id']) {
                                $selectedSatuan = 'selected';
                            }
                            ?>
                            <option value="<?= $satuan['id']; ?>" <?= $selectedSatuan; ?>><?= $satuan['name']; ?></option>
                        <?php } ?>
                    <?php
                    } else {
                    ?>
                        <?php foreach ($dataSatuan as $satuan) { ?>
                            <?php
                            $selectedSatuan = '';
                            if ($data['id_satuan'] === $satuan['id']) {
                                $selectedSatuan = 'selected';
                            }
                            ?>
                            <option value="<?= $satuan['id']; ?>" <?= $selectedSatuan; ?>><?= $satuan['name']; ?></option>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </select>
                <?php echo form_error('satuan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tgl_pengadaan">Tanggal Pengadaan</label>
                <input type="date" name="tgl_pengadaan" id="tgl_pengadaan" class="form-control" value="<?= set_value('tgl_pengadaan') ? date(set_value('tgl_pengadaan')) : date($data['tgl_pengadaan']); ?>" required>
                <?php echo form_error('tgl_pengadaan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"><?php echo set_value('keterangan') ? set_value('keterangan') : $data['keterangan'] ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Edit Barang</button>
        </form>
    </div>
</div>