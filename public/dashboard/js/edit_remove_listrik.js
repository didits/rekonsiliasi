type = ['', 'info', 'success', 'warning', 'danger'];
datamaster = ["Gardu Induk", "Trafo GI", "Penyulang", "GD", "PCT", "Pelanggan TM"];
tasks = ['gi', 't_gi', 'penyulang', 'gd', 'pct', 'p_tm'];
var url_edit;
var url_delete;
var title_;
var task_;

edit_datamaster = {
    showSwal: function (type, id_) {
        if (type == 'trafo_gi') {
            title_ = "Edit " + datamaster[1];
            task_ = tasks[1];

        } else if (type == 'penyulang') {
            title_ = "Edit " + datamaster[2];
            task_ = tasks[2];

        } else if (type == 'gd') {
            title_ = "Edit " + datamaster[3];
            task_ = tasks[3];

        } else if (type == 'pct') {
            title_ = "Edit " + datamaster[4];
            task_ = tasks[4];

        } else if (type == 'p_tm') {
            title_ = "Edit " + datamaster[5];
            task_ = tasks[5];

        }

        swal({
                title: title_,
                html:
                '<label>Nama</label>' +
                '<input id="edit_nama" class="form-control">',
                showCancelButton: true,
                closeOnConfirm: false,
                allowOutsideClick: false,
                showLoaderOnConfirm: true
            },
            function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post(url_edit,
                    {
                        task: task_,
                        id: id_,
                        nama: $('#edit_nama').val(),
                    }, function(data, status){
                    if (status == "success" && data == "1")
                        swal({
                            title: "Data telah diubah",
                            type: "success"
                        }, location.reload());
                });
            })
    }
};

hapus_datamaster = {
        showSwal: function (type, id_org_, id_) {
            if (type == 'trafo_gi') {
                title_ = "Hapus " + datamaster[1];
                task_ = tasks[1];

            } else if (type == 'penyulang') {
                title_ = "Hapus " + datamaster[2];
                task_ = tasks[2];

            } else if (type == 'gd') {
                title_ = "Hapus " + datamaster[3];
                task_ = tasks[3];

            } else if (type == 'pct') {
                title_ = "Hapus " + datamaster[4];
                task_ = tasks[4];

            } else if (type == 'p_tm') {
                title_ = "Hapus " + datamaster[5];
                task_ = tasks[5];

            }

            swal({
                    title: title_,
                    text: "Master akan dihapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn btn-info btn-fill",
                    confirmButtonText: "Hapus",
                    cancelButtonClass: "btn btn-danger btn-fill",
                    closeOnConfirm: false
                },
                function () {
                    $.get(url_delete + "/" + id_org_ + "/" + task_ + "/" + id_,
                        function(data, status){
                            if (status == "success" && data == "1")
                                swal({
                                    title: "Master telah dihapus!",
                                    type: "success"
                                }, location.reload());
                        });
                })
        }
    }