<div class="container-fluid">

    <a href="<?=base_url('pencari')?>">
        <buatton class="btn btn-danger"><i class="fas fa-arrow-circle-left"> </i> Back</buatton>
    </a>

    <center>
        <div id="carouselExampleControls" class="carousel slide mt-2" data-ride="carousel">
            <div class="carousel-inner">

                <?php $i = 1;?>
                <?php foreach ($foto_kos as $item): ?>

                <div class="carousel-item <?=($i == 1) ? "active" : ""?>">
                    <label for="" class="btn btn-primary"><?=$item->tempat?></label>
                    <img class="d-block w-100"
                        src="<?=base_url('asset_admin/assets_kosan/foto_kosan/') . $item->nama_file?>" alt="Mantap"
                        style="height: 500px;">
                </div>

                <?php $i++?>
                <?php endforeach?>


            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </center>



    <!-- DataTales Example -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 mt-3 text-gray-800">Data Kost</h1>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Keterangan Kos</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-md-3">
                    <img src="<?=base_url('asset_admin/upload_kos/' . $kos->foto);?>" alt="" width="100%">
                </div>
                <div class="col">
                    <div class="table-responsive">
                        <table class="table" width="100%" cellspacing="0">
                            <tr>
                                <th width="20%">Kode Kos</th>
                                <th><?=$kos->kode_kos?></th>
                            </tr>
                            <tr>
                                <td>Nama Kos</td>
                                <td><?=$kos->nama_kos?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?=$kos->alamat?></td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td><?=$kos->deskripsi?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kosan</td>
                                <td><?=$kos->jenis_kosan?></td>
                            </tr>
                            <tr>
                                <td>Nomor HP Pemilik</td>
                                <td><?=$kos->no_telp?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
        </div>


    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
            <!-- Example single danger button -->
            <div class="btn-group mt-2">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Jangka Waktu
                </button>
                <?php $segment3 = $this->uri->segment(3)?>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?=base_url('pencari/view_data_kos/') . $segment3?>/smester">6
                        Bulan</a>
                    <a class="dropdown-item" href="<?=base_url('pencari/view_data_kos/') . $segment3?>/tahunan">1
                        Tahun</a>

                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="card-columns">

                <?php
$no = 0;
// var_dump();
foreach ($result as $r): ?>
                <div class="card">
                    <img class="card-img-top" src="<?=base_url('asset_admin/upload_kos/')?><?=$r->foto;?>"
                        alt="<?=$r->foto;?>">
                    <div class="card-body">
                        <h3 class="card-title">No. <?=$r->kode_kamar?></h3>
                        <p class="card-text">Deskripsi : <?=$r->deskripsi;?></p>

                        <?php if ($this->uri->segment(4) == "tahunan"): ?>
                        <p class="card-text">Harga : Rp. <?=$r->harga;?>/tahun</p>
                        <?php else: ?>
                        <p class="card-text">Harga : Rp. <?=$r->harga_smesteran;?>/bulan</p>
                        <?php endif;?>

                        <p class="card-text">Status : <?=$r->status;?></p>
                        <p class="card-text">Tersedia Dari Tanggal : <?=$r->tgl_tersedia;?></p>
                        <a href="" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModalCenter<?=$r->kode_kamar?>">Booking Sekarang</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter<?=$r->kode_kamar?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Booking Kamar No.
                                        <?=$r->kode_kamar?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Perhatian!</strong> Untuk pembayaran bisa kirim ke rekening
                                    </div>

                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Perhatian!</strong> Untuk pembayaran bisa dilakukan DP 20% atau
                                        pembayaran Full
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>



                                    <form class="form" action="<?=base_url('pencari/pesan_kamar')?>" method="post"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="mb-2">
                                                <label for="exampleFormControlInput1">Nama Penghuni</label>
                                                <input type="tuext" class="form-control" placeholder="Nama Penghuni"
                                                    name="nama_penghuni">
                                            </div>
                                            <div class="mb-2">
                                                <label for="exampleFormControlInput1">Jangka Waktu</label>
                                                <select class="custom-select" id="jangka_waktu" name="jangka_waktu">
                                                    <option selected>Choose...</option>
                                                    <option value="6 Bulan">6 Bulan</option>
                                                    <option value="1 Tahun">1 Tahun</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="exampleFormControlInput1">Tanggal Mulai Menghuni</label>
                                                <!-- <input type="date" class="form-control DateForm" name="tgl_masuk"
                                                    id="datepicker"> -->
                                                <input type="text" class="form-control datepicker"
                                                    placeholder="yy/mm/dd" name="tgl_masuk" autocomplete="off">

                                            </div>
                                            <input type="hidden" name="kode_kamar" value="<?=$r->id_kamar;?>">
                                            <input type="hidden" name="id_pencari" value="<?=$nama->id_pencari;?>">
                                            <input type="hidden" name="id_pemilik" value="<?=$kos->id_pemilik;?>">
                                            <input type="hidden" name="kode_kos" value="<?=$kos->kode_kos?>">


                                        </div>
                                        <div class="col">

                                        </div>
                                        <!-- <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Sampai Tanggal</label>
                                                <input type="date" class="form-control" name="tgl_keluar">
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Pesan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endforeach;?>

                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

                <script>
                $('.datepicker').datepicker({
                    minDate: 0,
                    maxDate: '+1w',
                    dateFormat: 'yy/mm/dd'
                });
                </script>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -
->


































</div>
<!-- End of Main Content -->

































































































































</div>
<!-- End of Content Wrapper
-->

</div>






<!-- End of Page Wrapper -->