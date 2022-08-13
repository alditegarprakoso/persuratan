<h1 class="h3 mb-4 text-gray-800">Edit Satuan</h1>
<p><a href="<?= base_url('satuan'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Edit Satuan Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('satuan/edit'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= set_value('id') ? set_value('id') : $data['id']; ?>">
            <div class="form-group">
                <label for="name">Nama Satuan</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name') ? set_value('name') : $data['name']; ?>" required>
                <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Edit Satuan</button>
        </form>
    </div>
</div>