<script>
    $(document).ready(function() {
        let today = new Date();

        // datatables
        $('#mytable').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: "<?php echo base_url("barang/getBarang") ?>",
                type: 'post',
                dataType: 'json'
            },
            "oLanguage": {
                sSearch: "Cari :",
                sLengthMenu: "Menampilkan _MENU_ data",
                sInfo: "Menampilkan _START_ - _END_ dari total _TOTAL_ data",
                sInfoEmpty: "Tidak ada data",
                sProcessing: "Tungguin ya...",
                oPaginate: {
                    sPrevious: "<<",
                    sNext: ">>"
                }
            },
            "language": {
                emptyTable: "-- TIDAK ADA DATA --"
            },
            "initComplete": function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            "createdRow": function(row, data, index) {
                // menandai baris data yang baru di input selama 1 menit
                let created_at = new Date(data['created_at']);
                if ((today - created_at) <= 60000) {
                    $(row).css('background-color', '#D5F5E3');
                    $(row).css('color', 'black');
                }
            },
            "columns": [{
                    data: "id",
                    width: "5px",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "kode_barang"
                },
                {
                    data: "nama_barang"
                },
                {
                    data: "stok"
                },
                {
                    data: "merkName"
                },
                {
                    data: "satuanName"
                },
                {
                    data: "tgl_pengadaan"
                },
                {
                    data: "keterangan"
                },
                {
                    data: "Action",
                    orderable: false,
                    width: '30%'
                }
            ]
        });
    });

    $('#mytable').on('click', '.delete_barang', function() {
        let id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url("barang/getDataById") ?>",
            type: 'post',
            dataType: 'json',
            data: {
                "id": id
            },
            success: function(result) {
                $("#id_hapus").html(result.id);
                $("#id_hapus2").val(result.id);
                $("#kode_barang").val(result.kode_barang);
                $("#nama_barang").val(result.nama_barang);
                $("#stok").val(result.stok);
                $("#merk").val(result.merkName);
                $("#satuan").val(result.satuanName);
                $("#tgl_pengadaan").val(result.tgl_pengadaan);
                $("#keterangan").val(result.keterangan);
            },
            complete: function() {
                $('#ModalHapus').modal('show');
            }
        });
    });

    $("#hapus").submit(function(e) {
        e.preventDefault();
        // tangkap id dari input hidden
        let id = $('#id_hapus2').val();
        // delete data
        $.ajax({
            url: "<?php echo base_url("barang/delete") ?>",
            type: 'post',
            dataType: 'json',
            data: {
                "id_hapus3": id
            },
            success: function(result) {
                reload_table();
                $('#ModalHapus').modal('hide');
                $('#konfirmasi').modal('show');
                setTimeout(function() {
                    $("#konfirmasi").modal('hide');
                }, 1500);
            }
        });
    });

    function reload_table() {
        $('#mytable').DataTable().ajax.reload(null, false);
    }

    $(document).ready(function() {
        let today = new Date();

        // datatables
        $('#mytable2').DataTable({
            "serverSide": true,
            "processing": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                url: "<?php echo base_url("barang/getLaporan") ?>",
                type: 'post',
                dataType: 'json'
            },
            "oLanguage": {
                sSearch: "Cari :",
                sLengthMenu: "Menampilkan _MENU_ data",
                sInfo: "Menampilkan _START_ - _END_ dari total _TOTAL_ data",
                sInfoEmpty: "Tidak ada data",
                sProcessing: "Tungguin ya...",
                oPaginate: {
                    sPrevious: "<<",
                    sNext: ">>"
                }
            },
            "language": {
                emptyTable: "-- TIDAK ADA DATA --"
            },
            "initComplete": function() {
                var api = this.api();
                $('#mytable_filter input')
                    .off('.DT')
                    .on('keyup.DT', function(e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            "createdRow": function(row, data, index) {
                // menandai baris data yang baru di input selama 1 menit
                let created_at = new Date(data['created_at']);
                if ((today - created_at) <= 60000) {
                    $(row).css('background-color', '#D5F5E3');
                    $(row).css('color', 'black');
                }
            },
            "columns": [{
                    data: "id",
                    width: "5px",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "kode_barang"
                },
                {
                    data: "nama_barang"
                },
                {
                    data: "stok"
                },
                {
                    data: "merkName"
                },
                {
                    data: "satuanName"
                },
                {
                    data: "tgl_pengadaan"
                },
                {
                    data: "keterangan"
                }
            ]
        });
    });
</script>