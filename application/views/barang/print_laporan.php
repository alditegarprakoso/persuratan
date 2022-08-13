<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title; ?></title>
    <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

</head>

<body onload="window.print()">
    <h2 class="text-gray-900 mt-5 mb-5 text-center"><?= $title; ?></h2>
    <?php if ($dataLaporan == null) {
    ?>
        <h4 class="text-gray-900 mb-5 text-center">Tidak ada ada laporan pada tanggal tersebut.</h4>
    <?php
    } else {
    ?>
        <div class="container table-responsive">
            <table class="table table-striped table-bordered text-gray-900" id="mytable">
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
                    <?php $no = 1;
                    foreach ($dataLaporan as $data) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['kode_barang']; ?></td>
                            <td><?= $data['nama_barang']; ?></td>
                            <td><?= $data['stok']; ?></td>
                            <td><?= $data['merkName']; ?></td>
                            <td><?= $data['satuanName']; ?></td>
                            <td><?= $data['tgl_pengadaan']; ?></td>
                            <td><?= $data['keterangan']; ?></td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    <?php
    } ?>
</body>

</html>