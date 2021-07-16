<div class="container-fluid">
    <!-- DataTales Example -->

    <!-- <button></button> -->
    <!-- <div class="btn-group mb-3 ">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Pilih Kosan
        </button>
        <div class="dropdown-menu">



        </div>
    </div> -->



    <ul class="nav nav-tabs mb-3">
        <li class="nav-item dropdown mr-2">
            <a class="nav-link dropdown-toggle active bg-primary text-white" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="true" aria-expanded="false">Pilih Kosan</a>
            <div class="dropdown-menu">
                <?php $uri2 = $this->uri->segment(2)?>
                <?php foreach ($list_kosan as $l): ?>
                <a class="dropdown-item" href="<?=base_url('pemilik/') . $uri2 . '/' . $l->kode_kos?>">Kost
                    <?=$l->nama_kos?></a>
                <?php endforeach;?>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link <?=$nav1?>" href="<?=base_url('pemilik/booking/')?>">Riwayat Pemesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$nav2?>" href="<?=base_url('pemilik/booking_pesanan/')?>">Data Pemesanan</a>
        </li>

    </ul>



    <div class="card shadow mb-4">
        <div class="card-header">

            <!-- <div class="btn-group mb-3 float-right">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Jenis Pemesanan
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?=base_url('pemilik/booking/')?>">Riwayat Pemesanan</a>

                    <a class="dropdown-item" href="<?=base_url('pemilik/booking_pesanan/')?>">Data Pemesanan</a>


                </div>
            </div> -->

            <?php if ($this->uri->segment(2) == "booking"): ?>

            <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Kos <b><?=$nama_kosan?></b></h6>
            <?php else: ?>
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Kos <b><?=$nama_kosan?></b></h6>
            <?php endif;?>


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
                            <th>Jangka Waktu</th>
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
                            <td><?=$r->jangka_waktu?></td>
                            <td>
                                <?php if ($r->status_transaksi == 0): ?>


                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Proses
                                </button>
                                <div class="dropdown-menu">
                                    <a class="badge-xl badge-success dropdown-item"
                                        href="<?=base_url('pemilik/proses_pesanan/terima/') . $r->id_pencari . "/" . $r->id_pesan?>"><i
                                            class="fas fa-check-circle"></i>
                                        Terima
                                        Pesanan (Lunas)</a>

                                    <a class="badge-xl badge-warning dropdown-item mt-1"
                                        href="<?=base_url('pemilik/proses_pesanan/pelunasan/') . $r->id_pencari . "/" . $r->id_pesan?>"><i
                                            class="fas fa-money-bill-wave-alt"></i>
                                        Proses Pelunasan</a>

                                    <a class="badge-xl badge-info dropdown-item mt-1"
                                        href="<?=base_url('pemilik/bukti_pelunasan/') . $r->id_pesan?>"><i
                                            class="fas fa-file-invoice"></i> Cek
                                        Bukti Pelunasan</a>

                                    <a class="badge-xl badge-danger dropdown-item mt-1 text-white" data-toggle="modal"
                                        data-target="#exampleModal3" id="batal_pesan" data-idpesan="<?=$r->id_pesan?>"
                                        data-idkamar="<?=$r->id_kamar?>" data-idpencari="<?=$r->id_pencari?>">
                                        <i class="fas fa-times-circle"></i>
                                        Tolak pesanan
                                    </a>
                                    <a class="badge-xl badge-info dropdown-item mt-1" target="_blank"
                                        href="https://api.whatsapp.com/send?phone=<?=$r->no_telp?>"><i
                                            class="fab fa-whatsapp"></i> Hubungi Penghuni</a>








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
                                <input type="text" class="form-control mt-2" value="<?=$r->keterangan_pembatalan?>"
                                    readonly>
                                <?php endif;?>
                                <!-- <?=$r->status_transaksi?> -->

                                <button type="button" class="btn btn-primary " data-toggle="modal"
                                    data-target="#detail_pesanan<?=$r->id_pesan?>">
                                    <i class="fas fa-info-circle"></i> Detail Transaksi
                                </button>

                                <?php if ($r->harga == $r->harga - $r->sisa_pembayaran): ?>

                                <a class="btn btn-info" href="<?=base_url('MOU/mou_pencari/' . $r->mou)?>">
                                    <i class=" fas fa-info-circle"></i> Lihat MOU
                                </a>

                                <?php endif?>

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
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$r->nama_penghuni?></td>
                                    <td><?=date_format(date_create($r->tanggal_masuk), "d-M-Y")?></td>
                                    <td><?=date_format(date_create($r->tanggal_keluar), "d-M-Y")?></td>



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


<!-- href="<?=base_url('pemilik/proses_pesanan/penolakan/') . $r->id_pesan . "/" . $r->id_kamar?>" -->

<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penolakan Pemesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('pemilik/tolak_pesanan')?>" method="POST">
                <div class="modal-body" id="modalBody">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alasan Penolakan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required
                            name="alasan_penolakan"></textarea>
                    </div>

                    <input type="hidden" id="idpesanan" name="idpesanan">
                    <input type="hidden" id="idkamar" name="idkamar">
                    <input type="hidden" id="idpencari" name="id_pencari">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tolak Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>


<script type="text/javascript">
$(document).on("click", "#batal_pesan", function() {
    // alert('clicked')
    var idpesan = $(this).data('idpesan');
    var idkamar = $(this).data('idkamar');
    var idpencari = $(this).data('idpencari');

    $("#modalBody #idpesanan").val(idpesan);
    $("#modalBody #idkamar").val(idkamar);
    $("#modalBody #idpencari").val(idpencari);


});
</script>














































































<!-- End of Content Wrapper -->

<?=$this->session->flashdata('alert')?>


</div>






<!-- End of Page Wrapper -->