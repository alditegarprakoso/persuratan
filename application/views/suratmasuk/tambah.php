<h1 class="h3 mb-4 text-gray-800">Tambah Data Surat Masuk</h1>
<p><a href="<?= base_url('home/suratMasuk'); ?>" class="btn btn-sm btn-secondary">Kembali</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Form tambah data</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('home/tambahSuratMasuk'); ?>" method="POST">
            <div class="form-group">
                <label for="no_agenda">Nomor Agenda Direktorat</label>
                <input type="text" name="no_agenda" id="no_agenda" class="form-control" value="<?= set_value('no_agenda'); ?>" required autofocus>
                <?php echo form_error('no_agenda', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="no_surat">Nomor Surat</label>
                <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?= set_value('no_surat'); ?>" required>
                <?php echo form_error('no_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="asal_surat">Asal Surat</label>
                <input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?= set_value('asal_surat'); ?>" required>
                <?php echo form_error('asal_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="perihal">Perihal</label>
                <textarea name="perihal" id="perihal" cols="30" rows="3" class="form-control"><?php echo set_value('perihal') ?></textarea>
                <?php echo form_error('perihal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat Masuk</label>
                <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" required>
                <?php echo form_error('tanggal_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Input Data</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date("Y-m-d"); ?>" required>
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Tambah Data</button>
        </form>
    </div>
</div>