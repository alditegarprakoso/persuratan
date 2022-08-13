<h1 class="h3 mb-4 text-gray-800">Add Barang Keluar</h1>
<p><a href="<?= base_url('barangkeluar'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<?= $this->session->flashdata('message'); ?>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Add Barang Keluar Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barangkeluar/add'); ?>" method="POST">
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="barang">Barang</label>
                <select class="form-control" id="barang" name="barang">
                    <option selected disabled>Select Barang</option>
                    <?php foreach ($dataBarang as $barang) { ?>
                        <option data-stok="<?= $barang['stok']; ?>" value="<?= $barang['id']; ?>"><?= $barang['kode_barang']; ?> - <?= $barang['nama_barang']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('barang', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" class="form-control" value="<?= set_value('jumlah') ?>" required>
                <?php echo form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi">
                    <option selected disabled>Select kondisi</option>
                    <?php foreach ($dataKondisi as $kondisi) { ?>
                        <option value="<?= $kondisi['id']; ?>"><?= $kondisi['name']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('kondisi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" required><?php echo set_value('keterangan') ?></textarea>
                <?php echo form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Add Barang Keluar</button>
        </form>
    </div>
</div>