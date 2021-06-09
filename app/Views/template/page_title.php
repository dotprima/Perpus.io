<div class="container-fluid">
    <div class="page-title">
        <div class="row">

            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item <?php if($title=='Dashboard')echo 'active'?>">Admin</li>
                    <li class="breadcrumb-item <?php if($title=='About')echo 'active'?>"> <?=$title?></li>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>