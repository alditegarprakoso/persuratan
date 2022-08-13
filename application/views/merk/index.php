<h1 class="text-gray-800 mb-4">Data Merk</h1>
<?= $this->session->flashdata('message'); ?>
<div class="card mb-5">
    <div class="card-header">
        <strong class="text-primary">Data Merk</strong>
    </div>
    <div class="card-body">
        <p><a href="<?= base_url('merk/add'); ?>" class="btn btn-primary btn-sm">Add Merk</a></p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-gray-900" id="mytable">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
    </div>
</div>

<form id="hapus" method="post">
    <div class="modal fade" id="ModalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus ID <span class="text-primary" id="id_hapus"></span></h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_hapus2" name="id_hapus2" class="form-control" required>
                    <div class="mb-3 row">
                        <label class="col-sm-4 ">Merk Name :</label>
                        <div class="col-sm-8">
                            <input type="text" id="name" name="name" class="form-control" readonly>
                        </div>
                    </div>
                    <strong>Anda yakin mau menghapus record ini ?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" href="javascript:void(0);" onclick="reload_table()" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="konfirmasi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <strong>Data Berhasil Dihapus</strong>
            </div>
        </div>
    </div>
</div>