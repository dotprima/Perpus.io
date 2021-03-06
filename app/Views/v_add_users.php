<?= $this->extend('wrapper') ?>

<?= $this->section('content') ?>
<!-- Page Sidebar Ends-->
<div class="page-body">
    <?= $this->include('/template/page_title') ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Ajax Generated content for a column start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-3">Tambah Data User</span>
                    </div>
                    <div class="col-md-12 project-list">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                        <div class="nav-item"><a class="nav-link active" id="count" data-bs-toggle="tab"
                                                role="tab" aria-controls="top-home" aria-selected="true"><i
                                                    data-feather="target"></i>User Count <?=count($users)?></a></div>


                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-success float-right" onclick="add_user()"><i
                                            class="glyphicon glyphicon-plus"></i>
                                        Tambah Users</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="table_id">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>NIK</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th style="width:125px;">Action
                                            </p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user):?>
                                    <tr>
                                        <td align="center"><?php echo $user['id']?></td>
                                        <td align="center"><?php echo $user['name']?></td>
                                        <td align="center"><?php echo $user['email']?></td>
                                        <td align="center"><?php echo $user['address']?></td>
                                        <td align="center"><?php echo $user['phone']?></td>
                                        <td align="center"><?php echo $user['nik']?></td>
                                        <td align="center"><?php echo $user['created_at']?></td>
                                        <td align="center"><?php echo $user['updated_at']?></td>
                                        <td>
                                            <button class="btn btn-warning"
                                                onclick="edit_user(<?php echo $user['id'];?>)">Edit</button>
                                            <button class="btn btn-danger"
                                                onclick="delete_user(<?php echo $user['id'];?>)">Delete</button>
                                        </td>
                                    </tr>
                                    <?php endforeach?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>NIK</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th style="width:125px;">Action
                                            </p>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajax Generated content for a column end-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#table_id').DataTable({
        "order": [
            [0, "desc"]
        ]
    });

});
var save_method; //for save method string
var table;

function add_user() {
    save_method = 'add';
    $('#form_add')[0].reset(); // reset form on modals
    $('#modal_add').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Add User'); // Set title to Bootstrap modal title
}

function edit_user(id) {
    save_method = 'update';
    $('#form_update')[0].reset(); // reset form on modals
    <?php header('Content-type: application/json'); ?>
    $.ajax({
        url: "<?=base_url()?>/api/user/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data[0].id);
            $('[name="name"]').val(data[0].name);
            $('[name="email"]').val(data[0].email);
            $('[name="address"]').val(data[0].address);
            $('[name="phone"]').val(data[0].phone);
            $('[name="nik"]').val(data[0].nik);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Users'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            alert('Error get data from ajax');
        }
    });
}

function save() {
    var url = "<?=base_url()?>/api/user"

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form_add').serialize(),
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_add').modal('hide');
            $("#table_id").load("<?=base_url()?>/admin/adduser #table_id");
            $("#count").load("<?=base_url()?>/admin/adduser #count");
            swal("Keren", "Data berhasil di masukan", "success");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#modal_add').modal('hide');
            swal("Upps", "Data Gagal Di hapus / di masukan", "warning");
        }
    });
}

function update(id) {
    var formData = $('#form_update').serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    $.ajax({
        data: $('#form_update').serialize(),
        url: "<?=base_url()?>/api/user/" + formData.id,
        method: "PUT",
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
            swal("Keren", "Data berhasil di update", "success");
            $("#table_id").load("<?=base_url()?>/admin/adduser #table_id");

        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#modal_form').modal('hide');
            swal("Upps", "Data Gagal di masukan", "warning");
        }
    });
}

function delete_user(id) {
    swal({
            title: "Hapus Account Users",
            text: "Apakah Anda yakin ingin menghapus data",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // ajax delete data from database
                $.ajax({
                    url: "<?=base_url()?>/api/user/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data) {
                        $("#table_id").load("<?=base_url()?>/admin/adduser #table_id");
                        $("#count").load("<?=base_url()?>/admin/adduser #count");
                        swal("Keren", "Data Gagal di hapus", "success");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Upps", "Data Gagal Di hapus", "warning");
                    }
                });
            }
        });
}
</script>
<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_add" class="form-horizontal">
                    <input type="hidden" value="" name="book_id" />
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" id="name" name='name' class="form-control"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telephone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_update" class="form-horizontal">
                    <input type="hidden" value="" name="book_id" />
                    <div class="row">
                        <input type="hidden" id="id" name="id">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" id="name" name='name' class="form-control"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telephone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-muted">*Required</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update(<?php echo $user['id']?>)"
                    class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->endSection() ?>