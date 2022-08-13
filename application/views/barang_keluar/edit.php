<h1 class="h3 mb-4 text-gray-800">Edit Barang Keluar</h1>
<p><a href="<?= base_url('barangkeluar'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<?= $this->session->flashdata('message'); ?>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Edit Barang Keluar Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barangkeluar/edit'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= set_value('id') ? set_value('id') : $data['id']; ?>">
            <input type="hidden" name="idPreviousBarang" value="<?= set_value('idPreviousBarang') ? set_value('idPreviousBarang') : $data['id_barang']; ?>">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= set_value('tanggal') ? date(set_value('tanggal')) : date($data['tanggal']); ?>" required>
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="barang">Barang</label>
                <select class="form-control" id="barang" name="barang">
                    <option selected disabled>Select Barang</option>
                    <?php
                    if (set_value('barang')) {
                    ?>
                        <?php foreach ($dataBarang as $barang) { ?>
                            <?php
                            $selectedbarang = '';
                            if (set_value('barang') === $barang['id']) {
                                $selectedbarang = 'selected';
                            }
                            ?>
                            <option value="<?= $barang['id']; ?>" <?= $selectedbarang; ?>><?= $barang['nama_barang']; ?></option>
                        <?php } ?>
                    <?php
                    } else {
                    ?>
                        <?php foreach ($dataBarang as $barang) { ?>
                            <?php
                            $selectedbarang = '';
                            if ($data['id_barang'] === $barang['id']) {
                                $selectedbarang = 'selected';
                            }
                            ?>
                            <option value="<?= $barang['id']; ?>" <?= $selectedbarang; ?>><?= $barang['nama_barang']; ?></option>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </select>
                <?php echo form_error('barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" class="form-control" value="<?= set_value('jumlah') ? set_value('jumlah') : $data['jumlah'] ?>" required>
                <?php echo form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi">
                    <option selected disabled>Select Kondisi</option>
                    <?php
                    if (set_value('kondisi')) {
                    ?>
                        <?php foreach ($dataKondisi as $kondisi) { ?>
                            <?php
                            $selectedkondisi = '';
                            if (set_value('kondisi') === $kondisi['id']) {
                                $selectedkondisi = 'selected';
                            }
                            ?>
                            <option value="<?= $kondisi['id']; ?>" <?= $selectedkondisi; ?>><?= $kondisi['name']; ?></option>
                        <?php } ?>
                    <?php
                    } else {
                    ?>
                        <?php foreach ($dataKondisi as $kondisi) { ?>
                            <?php
                            $selectedkondisi = '';
                            if ($data['id_kondisi'] === $kondisi['id']) {
                                $selectedkondisi = 'selected';
                            }
                            ?>
                            <option value="<?= $kondisi['id']; ?>" <?= $selectedkondisi; ?>><?= $kondisi['name']; ?></option>
                        <?php } ?>
                    <?php
                    }
                    ?>
                </select>
                <?php echo form_error('kondisi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"><?php echo set_value('keterangan') ? set_value('keterangan') : $data['keterangan'] ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Edit Barang Keluar</button>
        </form>
    </div>
</div>