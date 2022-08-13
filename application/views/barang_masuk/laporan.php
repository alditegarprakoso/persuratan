<h1 class="text-gray-800 mb-4">Laporan Barang Masuk</h1>

<div class="card shadow mb-4">
    <a href="#filterByTanggal" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Filter By Tanggal</h6>
    </a>
    <div class="collapse show" id="filterByTanggal">
        <div class="card-body">
            <form action="<?= base_url('barangmasuk/tanggalFilter'); ?>" method="POST" target="_blank">
                <div class="form-group">
                    <label for="awal">Tanggal Awal</label>
                    <input type="date" name="awal" id="awal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="akhir">Tanggal Akhir</label>
                    <input type="date" name="akhir" id="akhir" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary form-control">Print Laporan</button>
            </form>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <a href="#filterByBulan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Filter By Bulan</h6>
    </a>
    <div class="collapse show" id="filterByBulan">
        <div class="card-body">
            <form action="<?= base_url('barangmasuk/bulanFilter'); ?>" method="POST" target="_blank">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select class="form-control" id="tahun" name="tahun" required>
                        <?php foreach ($dataTahun as $tahun) { ?>
                            <option value="<?= $tahun['tahun']; ?>"><?= $tahun['tahun']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="awal">Bulan Awal</label>
                    <select class="form-control" name="awal" id="awal" required>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="akhir">Bulan Akhir</label>
                    <select class="form-control" name="akhir" id="akhir" required>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary form-control">Print Laporan</button>
            </form>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <a href="#filterByTahun" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Filter By Tahun</h6>
    </a>
    <div class="collapse show" id="filterByTahun">
        <div class="card-body">
            <form action="<?= base_url('barangmasuk/tahunFilter'); ?>" method="POST" target="_blank">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select class="form-control" id="tahun" name="tahun" required>
                        <?php foreach ($dataTahun as $tahun) { ?>
                            <option value="<?= $tahun['tahun']; ?>"><?= $tahun['tahun']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary form-control">Print Laporan</button>
            </form>
        </div>
    </div>
</div>