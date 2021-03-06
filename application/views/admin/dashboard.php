        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                    style="background-color: #5F9EA0;"><i class="fas fa-download fa-sm text-white-50"></i> Input
                    Data</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah
                                        Pemilik Kos
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?=$jumlah_pemilik?> Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-alt fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah
                                        Pencari Kos
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$jumlah_pencari?> Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-search fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Kosan
                                        Terdaftar</div>
                                    <div class="row no-gutters align-items-center">
                                        <?php

?>
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?=$jumlah_kosan?> Kost</div>
                                        </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah
                                        Keseluruhan Kamar</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?=$jumlah_kamar?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-person-booth fa-2x text-gray-300"></i>
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
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pencari</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="chBar" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header col-lg-12 py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pemilik</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="chBar1" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>





        <!-- End of Main Content -->
