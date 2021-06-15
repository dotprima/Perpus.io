<?= $this->extend('wrapper') ?>

<?= $this->section('content') ?>
<div class="page-body">
    <?= $this->include('/template/page_title') ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Peminjaman Buku </h5>
                            </div>
                            <div class="card-body">

                                <?php if(session()->getFlashData('error')):?>
                                <div class="alert alert-danger" role="alert"><?=session()->getFlashData('error')?></div>
                                <?php endif?>
                                <?php if(session()->getFlashData('success')):?>
                                <div class="alert alert-success" role="alert"><?=session()->getFlashData('success')?>
                                </div>
                                <?php endif?>
                                <form class="theme-form" method="post" action="">
                                    <div class="mb-2">
                                        <div class="col-form-label">Users</div>
                                        <div class="mb-2">
                                            <select name="id_user" class="js-example-disabled-results col-sm-12">
                                                <?php foreach($content['users'] as $user):?>
                                                <option name="id_user" value="<?=$user['id']?>"><?=$user['email']?> ->
                                                    <?=$user['name']?></option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-form-label">Buku</div>
                                        <div class="mb-2">
                                            <select name="id_buku" class="js-example-disabled-results col-sm-12">
                                                <?php foreach($content['buku'] as $book):?>
                                                <option name="id_buku" value="<?=$book['id']?>"><?=$book['judul']?> ->
                                                    <?=$book['penerbit']?></option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-form-label">Tanggal Pengembalian</label>
                                        <div class="mb-2">
                                            <div class="input-group date" id="dt-minimum" data-target-input="nearest">
                                                <input name="pengembalian"
                                                    class="form-control datetimepicker-input digits" type="text"
                                                    data-target="#dt-minimum">
                                                <div class="input-group-text" data-target="#dt-minimum"
                                                    data-toggle="datetimepicker"><i class="fa fa-calendar"> </i></div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-footer text-end">
                                <input type="hidden" name="harga_new" value="<?=$book['harga']?>">
                                <input class="btn btn-primary" type="submit" value="Buat Pesanan">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('extra-js') ?>
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>
<script src="../assets/js/tooltip-init.js"></script>
<script src="../assets/js/datepicker/date-time-picker/moment.min.js"></script>
<script src="../assets/js/datepicker/date-time-picker/tempusdominus-bootstrap-4.min.js"></script>
<script src="../assets/js/datepicker/date-time-picker/datetimepicker.custom.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-time-picker.css">
<?= $this->endSection() ?>