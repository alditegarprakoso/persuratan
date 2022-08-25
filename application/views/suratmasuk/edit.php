<h1 class="h3 mb-4 text-gray-800">Edit Data Surat Masuk</h1>
<p><a href="<?= base_url('home/suratMasuk'); ?>" class="btn btn-sm btn-secondary">Kembali</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Form edit data</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('home/editSuratMasuk?id=' . $data['id']); ?>" method="POST">
            <!-- <?= set_value('id') ? set_value('id') : $data['id'] ?> -->
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <div class="form-group">
                <label for="no_agenda">Nomor Agenda Direktorat</label>
                <input type="text" name="no_agenda" id="no_agenda" class="form-control" value="<?= set_value('no_agenda') ? set_value('no_agenda') : $data['no_agenda_direktorat']; ?>" required autofocus>
                <?php echo form_error('no_agenda', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="no_surat">Nomor Surat</label>
                <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?= set_value('no_surat') ? set_value('no_surat') : $data['no_surat']; ?>" required>
                <?php echo form_error('no_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="asal_surat">Asal Surat</label>
                <input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?= set_value('asal_surat') ? set_value('asal_surat') : $data['asal_surat']; ?>" required>
                <?php echo form_error('asal_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="perihal">Perihal</label>
                <textarea name="perihal" id="perihal" cols="30" rows="3" class="form-control"><?= set_value('perihal') ? set_value('perihal') : $data['perihal']; ?></textarea>
                <?php echo form_error('perihal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="<?= set_value('tanggal_surat') ? set_value('tanggal_surat') : date($data['tanggal_surat']); ?>" required>
                <?php echo form_error('tanggal_surat', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= set_value('tanggal') ? set_value('tanggal') : date($data['tanggal']); ?>" required>
                <?php echo form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Edit Data</button>
        </form>
    </div>
</div>