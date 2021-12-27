<?php $this->load->view('layouts/header'); ?>

<h1 class="h3 mb-4 text-gray-800">Disposisi</h1>
<?= $this->session->flashdata('message'); ?>
<div class="card">
    <div class="card-header">
        <strong class="text-primary">Data Disposisi</strong>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered text-center text-gray-900" id="mytable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Agenda</th>
                    <th>Nomor Surat</th>
                    <th>Asal Surat</th>
                    <th>Perihal</th>
                    <th>Kepada</th>
                    <th>Tgl Surat</th>
                    <th>Tgl Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
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
                        <label class="col-sm-4 ">Nomor Agenda Direktorat</label>
                        <div class="col-sm-8">
                            <input type="text" id="no_agenda" name="no_agenda" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 ">Nomor Surat</label>
                        <div class="col-sm-8">
                            <input type="text" id="no_surat" name="no_surat" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 ">Asal Surat</label>
                        <div class="col-sm-8">
                            <input type="text" id="asal_surat" name="asal_surat" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 ">Perihal</label>
                        <div class="col-sm-8">
                            <textarea name="perihal" id="perihal" cols="30" rows="3" class="form-control" readonly></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 ">Kepada</label>
                        <div class="col-sm-8">
                            <input type="text" id="kepada" name="kepada" class="form-control" readonly>
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

<?php $this->load->view('layouts/footer'); ?>
<?php $this->load->view('disposisi/script'); ?>