<h1 class="h3 mb-4 text-gray-800">Add Barang Masuk</h1>
<p><a href="<?= base_url('barangmasuk'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Add Barang Masuk Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('barangmasuk/add'); ?>" method="POST">
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
            <button type="submit" class="btn btn-primary form-control">Add Barang Masuk</button>
        </form>
    </div>
</div>