<h1 class="h3 mb-4 text-gray-800">Edit User</h1>
<p><a href="<?= base_url('user'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Edit User Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/edit'); ?>" method="POST">
            <input type="hidden" name="id" value="<?= set_value('id') ? set_value('id') : $data['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value('nama') ? set_value('nama') : $data['nama']; ?>" required>
                <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ? set_value('username') : $data['username']; ?>" required>
                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= set_value('jabatan') ? set_value('jabatan') : $data['jabatan']; ?>" required>
                <?php echo form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="bagian">Bagian</label>
                <input type="text" name="bagian" id="bagian" class="form-control" value="<?= set_value('bagian') ? set_value('bagian') : $data['bagian']; ?>" required>
                <?php echo form_error('bagian', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role">
                    <option disabled>Select Role</option>
                    <?php
                    $selectedAdmin = '';
                    if (set_value('role') === 'admin') {
                        $selectedAdmin = 'selected';
                    } else if ($data['role'] === 'admin') {
                        $selectedAdmin = 'selected';
                    } else {
                        $selectedAdmin = '';
                    }

                    $selectedStaff = '';
                    if (set_value('role') === 'staff') {
                        $selectedStaff = 'selected';
                    } else if ($data['role'] === 'staff') {
                        $selectedStaff = 'selected';
                    } else {
                        $selectedStaff = '';
                    }

                    ?>
                    <option value="admin" <?php echo $selectedAdmin ?>>Admin</option>
                    <option value="staff" <?php echo $selectedStaff ?>>Staff</option>
                </select>
                <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Edit User</button>
        </form>
    </div>
</div>