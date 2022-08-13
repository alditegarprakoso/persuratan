<h1 class="h3 mb-4 text-gray-800">Add Merk</h1>
<p><a href="<?= base_url('merk'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Add Merk Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('merk/add'); ?>" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name'); ?>" required autofocus>
                <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Add Merk</button>
        </form>
    </div>
</div>