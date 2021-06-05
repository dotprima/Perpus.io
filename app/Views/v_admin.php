<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>codeigniter 4 ajax crud with datatables and bootstrap modals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://bootstrapmade.com/demo/templates/Bikin/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <button class="btn btn-success float-right" onclick="add_user()"><i
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

            function add_user() {
                save_method = 'add';
                $('#form')[0].reset(); // reset form on modals
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Add User'); // Set title to Bootstrap modal title
            }

            function edit_user(id) {
                save_method = 'update';
                $('#form')[0].reset(); // reset form on modals
                <?php header('Content-type: application/json'); ?>
                $.ajax({
                    url: "<?php echo site_url('http://localhost:8080/api')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        document.getElementById("myText").value = data[0].name;
                        $('[name="user_id"]').val(data.id);
                        $('[name="book_isbn"]').val(data.book_isbn);
                        $('[name="book_title"]').val(data.book_title);
                        $('[name="book_author"]').val(data.book_author);
                        $('[name="book_category"]').val(data.book_category);

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
                        $('#modal_form').modal('hide');
                        swal("Upps", "Data Gagal Di hapus / di masukan", "warning");
                    }
                });
            }

            function adduser() {
                var url = 'http://localhost:8080/api'

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
                            <h5 class="modal-title" id="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" value="" name="book_id" />
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama</label>
                                            <input type="email" id="myText" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">NIK</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Telephone</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <small id="emailHelp" class="form-text text-muted">*Required</small>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="adduser()" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- End Bootstrap modal -->
        </section>
        <!-- ======= Footer ======= -->
    </main>
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Bikin</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="9cf5f2faf3dcf9e4fdf1ecf0f9b2fff3f1">[email&#160;protected]</a><br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </footer><!-- End Footer -->
</body>

</html>