<?= $this->extend('wrapper') ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div id="count" class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Users Count</span>
                        <span class="info-box-number"><?=count($users)?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">

            </div>
            <div class="col-md-6 col-sm-6 col-12" style="margin-top:20px;">

                <button class="btn btn-success float-right" onclick="add_user()"><i
                        class="glyphicon glyphicon-plus"></i>
                    Tambah Users</button>
            </div>


        </div>

        <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                        <button class="btn btn-warning" onclick="edit_user(<?php echo $user['id'];?>)">Edit</button>
                        <button class="btn btn-danger" onclick="delete_user(<?php echo $user['id'];?>)">Delete</button>
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
</section>
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
        url: "<?php echo site_url('http://localhost:8080/api/user')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data[0].id);
            $('[name="name"]').val(data[0].name);
            $('[name="email"]').val(data[0].email);
            $('[name="address"]').val(data[0].address);
            $('[name="phone"]').val(data[0].phone);
            $('[name="nik"]').val(data[0].nik);
            $('[name="password"]').val(data[0].password);
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
    var url = "http://localhost:8080/api/user"

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form_add').serialize(),
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_add').modal('hide');
            $("#table_id").load("http://localhost:8080/admin #table_id");
            $("#count").load("http://localhost:8080/admin #count");
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
        url: "<?php echo site_url('http://localhost:8080/api/user')?>/" + formData.id,
        method: "PUT",
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
            swal("Keren", "Data berhasil di update", "success");
            $("#table_id").load("http://localhost:8080/admin #table_id");

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
                    url: "<?php echo site_url('http://localhost:8080/api/user')?>/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    success: function(data) {
                        $("#table_id").load("http://localhost:8080/admin #table_id");
                        $("#count").load("http://localhost:8080/admin #count");
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
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