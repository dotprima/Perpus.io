<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>codeigniter 4 ajax crud with datatables and bootstrap modals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://bootstrapmade.com/demo/templates/Bikin/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="index.html">Bikin</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link " href="/">Home</a></li>
                    <li><a class="nav-link active disabled" href="/admin">Admin</a></li>
                    <li><a class="nav-link " href="/about">About US</a></li>
                    <li><a class="getstarted nav-link" href="/login">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main id="main">
        <section>
            <div class="container" style='padding-top:30px'>
                <button class="btn btn-success float-right" onclick="add_book()"><i
                        class="glyphicon glyphicon-plus"></i>
                    Tambah Users</button>
                <br>
                <br>
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
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

            <link rel="stylesheet" type="text/css"
                href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript">
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                $('#table_id').DataTable();
            });
            var save_method; //for save method string
            var table;

            function add_book() {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('#modal_form').modal('show'); // show bootstrap modal
                //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
            }

            function edit_user(id) {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                <?php header('Content-type: application/json'); ?>
                //Ajax Load data from ajax
                $.ajax({
                    url: "<?php echo site_url('public/index.php/book/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);

                        $('[name="book_id"]').val(data.book_id);
                        $('[name="book_isbn"]').val(data.book_isbn);
                        $('[name="book_title"]').val(data.book_title);
                        $('[name="book_author"]').val(data.book_author);
                        $('[name="book_category"]').val(data.book_category);

                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Book'); // Set title to Bootstrap modal title

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        alert('Error get data from ajax');
                    }
                });
            }

            function save() {
                var url;
                if (save_method == 'add') {
                    url = "<?php echo site_url('public/index.php/book/book_add')?>";
                } else {
                    url = "<?php echo site_url('public/index.php/book/book_update')?>";
                }

                // ajax adding data to database
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function(data) {
                        //if success close modal and reload ajax table
                        $('#modal_form').modal('hide');
                        location.reload(); // for reload a page
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
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
                                url: "<?php echo site_url('http://localhost:8080/api')?>/" + id,
                                type: "DELETE",
                                dataType: "JSON",
                                success: function(data) {
                                    $("#table_id").load("http://localhost:8080/admin #table_id");
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

            <!-- Bootstrap modal -->
            <div class="modal fade" id="modal_form" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="book_id" />
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Book ISBN</label>
                                        <div class="col-md-9">
                                            <input name="book_isbn" placeholder="Book ISBN" class="form-control"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Book Title</label>
                                        <div class="col-md-9">
                                            <input name="book_title" placeholder="Book_title" class="form-control"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Book Author</label>
                                        <div class="col-md-9">
                                            <input name="book_author" placeholder="Book Author" class="form-control"
                                                type="text">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Book Category</label>
                                        <div class="col-md-9">
                                            <input name="book_category" placeholder="Book Category" class="form-control"
                                                type="text">

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
            <!-- End Bootstrap modal -->
        </section>
    </main>
</body>

</html>