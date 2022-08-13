<h1 class="h3 mb-4 text-gray-800">Add User</h1>
<p><a href="<?= base_url('user'); ?>" class="btn btn-sm btn-secondary">Back</a></p>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Add User Form</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/add'); ?>" method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value('nama'); ?>" required autofocus>
                <?php echo form_error('nama', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>" required>
                <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                <?php echo form_error('confirmPassword', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?= set_value('jabatan'); ?>" required>
                <?php echo form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="bagian">Bagian</label>
                <input type="text" name="bagian" id="bagian" class="form-control" value="<?= set_value('bagian'); ?>" required>
                <?php echo form_error('bagian', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role">
                    <option selected disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
                <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary form-control">Add User</button>
        </form>
    </div>
</div>