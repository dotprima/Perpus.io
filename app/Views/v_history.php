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
                        <h5 class="mb-3">History Pinjaman</span>
                    </div>
                    <div class="col-md-12 project-list">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                                        <div class="nav-item"><a class="nav-link active" id="count" data-bs-toggle="tab"
                                                role="tab" aria-controls="top-home" aria-selected="true"><i
                                                    data-feather="target"></i> Pinjam Count <?=count($orders)?></a>
                                        </div>
                                    </ul>
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
                                        <th>Nama Peminjam</th>
                                        <th>Email</th>
                                        <th>Judul Buku</th>
                                        <th>Harga</th>
                                        <th>Penerbit</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Tanggal Peminjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order):?>
                                    <tr>
                                        <td align="center"><?php echo $order['id']?></td>
                                        <td align="center"><?php echo $order['name']?></td>
                                        <td align="center"><?php echo $order['email']?></td>
                                        <td align="center"><?php echo $order['judul']?></td>
                                        <td align="center"><?php echo number_format($order['harga_new'])?></td>
                                        <td align="center"><?php echo $order['penerbit']?></td>
                                        <td align="center"><?php echo $order['penulis']?></td>
                                        <td align="center"><?php echo $order['status']?></td>
                                        <td align="center"><?php echo $order['created_at']?></td>
                                    </tr>
                                    <?php endforeach?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pembeli</th>
                                        <th>Email</th>
                                        <th>Judul Buku</th>
                                        <th>Harga</th>
                                        <th>Penerbit</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Tanggal Pembelian</th>
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
</script>
<?= $this->endSection() ?>