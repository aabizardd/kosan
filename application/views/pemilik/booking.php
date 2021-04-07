<div class="container-fluid">
    <!-- DataTales Example -->

    <!-- <button></button> -->
    <div class="btn-group mb-3 ">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Pilih Kosan
        </button>
        <div class="dropdown-menu">
            <?php $uri2 = $this->uri->segment(2)?>
            <?php foreach ($list_kosan as $l): ?>
            <a class="dropdown-item" href="<?=base_url('pemilik/') . $uri2 . '/' . $l->kode_kos?>">Kost
                <?=$l->nama_kos?></a>
            <?php endforeach;?>



        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header">

            <div class="btn-group mb-3 float-right">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Jenis Pemesanan
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?=base_url('pemilik/booking/')?>">Riwayat Pemesanan</a>

                    <a class="dropdown-item" href="<?=base_url('pemilik/booking_pesanan/')?>">Data Pemesanan</a>


                </div>
            </div>

            <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Kos <b><?=$nama_kosan?></b></h6>




        </div>

        <!-- Example single danger button -->

        <div class="card-body">



            <div class="table-responsive">



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Kode Kamar</th>
                            <th>Harga Kamar</th>
                            <th>Jumlah DP</th>
                            <th>Bukti DP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $r): ?>
                        <tr>
                            <td><?=$r->nama_pencari?></td>
                            <td><?=$r->tanggal_pesan?></td>
                            <td><?=$r->kode_kamar?></td>

                            <td><?="Rp " . number_format($r->harga, 2, ',', '.');?></td>



                            <td><?="Rp " . number_format($r->harga - $r->sisa_pembayaran, 2, ',', '.');?></td>
                            <td>
                                <img src="<?=base_url('asset_admin/bukti_bayar/') . $r->bukti_bayar?>" alt=""
                                    height="200">
                            </td>
                            <td>
                                <?php if ($r->status_transaksi == 0): ?>


                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Proses
                                </button>
                                <div class="dropdown-menu">
                                    <a class="badge-xl badge-success dropdown-item"
                                        href="<?=base_url('pemilik/proses_pesanan/terima/') . $r->id_pesan?>"><i
                                            class="fas fa-check-circle"></i>
                                        Terima
                                        Pesanan (Lunas)</a>

                                    <a class="badge-xl badge-warning dropdown-item mt-1"
                                        href="<?=base_url('pemilik/proses_pesanan/pelunasan/') . $r->id_pesan?>"><i
                                            class="fas fa-money-bill-wave-alt"></i>
                                        Proses Pelunasan</a>

                                    <a class="badge-xl badge-info dropdown-item mt-1"
                                        href="<?=base_url('pemilik/bukti_pelunasan/') . $r->id_pesan?>"><i
                                            class="fas fa-file-invoice"></i> Cek
                                        Bukti Pelunasan</a>

                                    <a class="badge-xl badge-danger dropdown-item mt-1"
                                        href="<?=base_url('pemilik/proses_pesanan/penolakan/') . $r->id_pesan . "/" . $r->id_kamar?>"><i
                                            class="fas fa-times-circle"></i> Tolak
                                        pesanan</a>


                                </div>

                                <?php elseif ($r->status_transaksi == 1): ?>
                                <button type="anchor" class="btn btn-primary mt-2" disabled>
                                    Menunggu Pembayaran
                                </button>

                                <button type="button" class="btn btn-warning dropdown-toggle mt-2"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Proses
                                </button>
                                <div class="dropdown-menu">


                                    <a class="badge-xl badge-primary dropdown-item mt-1"
                                        href="<?=base_url('pemilik/bukti_pelunasan/') . $r->id_pesan?>"><i
                                            class="fas fa-file-invoice"></i> Cek
                                        Bukti Pelunasan</a>


                                    <a class="badge-xl badge-info dropdown-item mt-1" target="_blank"
                                        href="https://api.whatsapp.com/send?phone=<?=$r->no_telp?>"><i
                                            class="fab fa-whatsapp"></i> Hubungi Penghuni</a>

                                </div>




                                <?php elseif ($r->status_transaksi == 2): ?>
                                <button type="anchor" class="btn btn-success" disabled>
                                    Lunas
                                </button>
                                <?php elseif ($r->status_transaksi == 3): ?>
                                <button type="anchor" class="btn btn-danger" disabled>
                                    Dibatalkan
                                </button>
                                <?php elseif ($r->status_transaksi == 4): ?>
                                <button type="anchor" class="btn btn-danger" disabled>
                                    Pesanan ditolak
                                </button>
                                <?php endif;?>
                                <!-- <?=$r->status_transaksi?> -->

                                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                    data-target="#detail_pesanan<?=$r->id_pesan?>">
                                    <i class="fas fa-info-circle"></i> Detail Transaksi
                                </button>


                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>


<?php
foreach ($result as $r): ?>


<!-- Modal -->
<div class="modal fade" id="detail_pesanan<?=$r->id_pesan?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi ID PESANAN <?=$r->id_pesan?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">







                <div class="card mt-2">
                    <div class="card-header">
                        Detail Pesanan
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Penghuni</th>
                                    <th scope="col">Tanggal Pesan</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>
                                    <th scope="col">Jumlah DP</th>
                                    <th scope="col">Sisa Pembayaran</th>
                                    <th scope="col">Bukti Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$r->nama_penghuni?></td>
                                    <td><?=date_format(date_create($r->tanggal_pesan), "d-M-Y")?></td>
                                    <td><?=date_format(date_create($r->tanggal_masuk), "d-M-Y")?></td>
                                    <td><?=date_format(date_create($r->tanggal_keluar), "d-M-Y")?></td>

                                    <?php
$jumlahDP = "Rp " . number_format($r->jumlah_dp, 2, ',', '.');
$sisa = "Rp " . number_format($r->sisa_pembayaran, 2, ',', '.');?>

                                    <td><?=$jumlahDP?></td>
                                    <td><?=$sisa?></td>
                                    <td><img src="<?=base_url('asset_admin/bukti_bayar/') . $r->bukti_bayar?>" alt=""
                                            width="200" height="200"></td>
                                </tr>

                            </tbody>
                        </table>



                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php endforeach;?>

















































































<!-- End of Content Wrapper -->

<?=$this->session->flashdata('alert')?>


</div>
<!-- End of Page Wrapper -->
