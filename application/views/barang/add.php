<h1 class="h3 mb-4 text-gray-800">Add Barang</h1>
<p><a href="<?= base_url('barang'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Add Barang Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barang/add'); ?>" method="POST">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?= set_value('kode_barang') ? set_value('kode_barang') : $kode_barang ?>" required readonly>
                <?php echo form_error('kode_barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= set_value('nama_barang') ?>" required autofocus>
                <?php echo form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" name="stok" id="stok" class="form-control" value="0" required readonly>
            </div>
            <div class="form-group">
                <label for="merk">Merk</label>
                <select class="form-control" id="merk" name="merk">
                    <option selected disabled>Select Merk</option>
                    <?php foreach ($dataMerk as $merk) { ?>
                        <option value="<?= $merk['id']; ?>"><?= $merk['name']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('merk', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <select class="form-control" id="satuan" name="satuan">
                    <option selected disabled>Select Satuan</option>
                    <?php foreach ($dataSatuan as $satuan) { ?>
                        <option value="<?= $satuan['id']; ?>"><?= $satuan['name']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('satuan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tgl_pengadaan">Tanggal Pengadaan</label>
                <input type="date" name="tgl_pengadaan" id="tgl_pengadaan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                <?php echo form_error('tgl_pengadaan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"><?php echo set_value('keterangan') ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Add Barang</button>
        </form>
    </div>
</div>