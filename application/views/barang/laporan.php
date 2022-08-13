<h1 class="text-gray-800 mb-4">Laporan Data Barang</h1>
<div class="card mb-5">
    <div class="card-header">
        <strong class="text-primary">Data Barang Saat Ini</strong>
    </div>
    <div class="card-body">
        <p><a href="<?= base_url('barang/print_laporan'); ?>" target="_blank" class="btn btn-primary btn-sm">Print Laporan Barang</a></p>
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-gray-900" id="mytable2">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Merk</th>
                        <th>Satuan</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
    </div>
</div>