<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Kos
            <!-- <b class="text-info"><?=$nama_kosan?></b> -->
        </h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="background-color: #5F9EA0;"><i class="fas fa-download fa-sm text-white-50"></i> Input Data</a> -->
    </div>

    <div class="btn-group mb-3 ">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Pilih Kosan
        </button>
        <div class="dropdown-menu">

            <?php foreach ($list_kosan as $l): ?>
            <a class="dropdown-item" href="<?=base_url('pemilik/index/') . $l->kode_kos?>">Kost
                <?=$l->nama_kos?></a>
            <?php endforeach;?>



        </div>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tamu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$jumlah_orang?> orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kamar Kosong</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_kamar?> Kamar</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaksi Yang Selesai
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php

?>
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?=$transaksi_selesai['riwayat']?> Pesanan</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: <?=$per['persen']?>%" aria-valuenow="<?=$per['yang_belum']?>"
                                            aria-valuemin="0" aria-valuemax="<?=$per['total_transaksi']?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sedang Diproses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$transaksi_proses['riwayat']?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header col-lg-12 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Penghuni</h6>
                </div>
                <div class="card-body">
                    <canvas id="chBar1" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header col-lg-12 py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Transaksi</h6>
                </div>
                <div class="card-body">
                    <canvas id="chBar" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modal-mou" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload MoU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Jangan lupa upload MoU anda!</p>
                </div>

            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->