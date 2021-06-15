<?= $this->extend('wrapper') ?>

<?= $this->section('content') ?>
<div class="page-body">
    <?= $this->include('/template/page_title') ?>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <?php if(session()->getFlashData('error')):?>
                        <div class="alert alert-danger" role="alert"><?=session()->getFlashData('error')?></div>
                        <?php endif?>
                        <?php if(session()->getFlashData('success')):?>
                        <div class="alert alert-success" role="alert"><?=session()->getFlashData('success')?>
                        </div>
                        <?php endif?>
                        <div class="row">
                            <?php foreach($order as $key):?>
                            <div class="col-xxl-4 col-md-6">
                                <?php $time = strtotime($key['pengembalian'])-time()?>
                                <div class="prooduct-details-box">
                                    <div class="media"><img style="margin-left:10px;"
                                            class="align-self-center img-fluid img-60" src="<?=$key['url']?>" alt="#">
                                        <div class="media-body ms-3">
                                            <div class="product-name">
                                                <h6><a href="#"><?=$key['judul']?></a></h6>
                                            </div>
                                            <div class="product-name">
                                                <h7><a href="#"><?=$key['name']?></a></h7>
                                            </div>
                                            <div class="product-name">
                                                <p><a href="#"><?=$key['email']?></a></p>
                                            </div>
                                            <div class="price d-flex">
                                                <div class="text-muted me-2">Harga</div>:
                                                Rp.<?=number_format($key['harga_new'])?>
                                            </div>
                                            <div class="avaiabilty">
                                                <div class="text-success">
                                                    <p>Tanggal Peminjaman
                                                        :<span><?=date( "m/d/Y", strtotime($key['created_at']))?></span>
                                                    </p>
                                                </div>
                                                <div class="text-success">
                                                    <p>Tanggal Pengembalian
                                                        :<span><?=date( "m/d/Y", strtotime($key['pengembalian']))?></span>
                                                    </p>
                                                </div>
                                                <div class="text-success">
                                                    <?php  if($time <= 0 ):?>
                                                    <span class="badge badge-danger">Terlambat</span>
                                                    <?php else :?>
                                                    <span class="badge badge-primary">Tepat Waktu</span>
                                                    <?php endif?>
                                                </div>
                                                <br>
                                            </div>
                                            <form class="theme-form" method="post" action="">
                                                <input type="hidden" name="id" value="<?=$key['id_order']?>">
                                                <?php  if($time <= 0 ):?>
                                                <input class="btn btn-danger btn-xs" type="submit" value="Terima Buku">
                                                <?php else :?>
                                                <input class="btn btn-primary btn-xs" type="submit" value="Terima Buku">
                                                <?php endif?>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
<?= $this->endSection() ?>