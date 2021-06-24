<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tamu</h6>
            <?php $id_pencari = $this->session->userdata('id_pencari');

?>
        </div>
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Perhatian!</strong> maksimal pembayaran DP adalah 2x24, lebih dari itu pesanan akan dibatalkan!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <!-- <?php print_r($result)?> -->
                    <thead>
                        <tr>

                            <th>Nama Kos</th>
                            <th>Alamat Kos</th>
                            <th>Kode Kamar</th>
                            <th>Nama Penghuni</th>
                            <!--<th>Sisa Pembayaran</th>-->
                            <th>Total Bayar</th>
                            <th>Sisa Bayar</th>

                            <th>Status</th>
                            <th>Action</th>
                            <!-- <th>Sisa Pembayaran</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $r): ?>
                        <tr>


                            <?php
echo $id_pencari = $this->session->userdata('id_pencari');

?>
                            <td><?=strtoupper($r->nama_kos)?></td>
                            <td><?=strtoupper($r->alamat)?></td>
                            <td><?=$r->kode_kamar?></td>
                            <td><?=$r->nama_penghuni?></td>
                            <!--<td><?=$r->sisa_pembayaran?></td>-->

                            <?php if ($r->jangka_waktu == "1 Tahun"): ?>
                            <?php $total_bayar = "Rp " . number_format($r->harga, 2, ',', '.');?>
                            <?php elseif ($r->jangka_waktu == "6 Bulan"): ?>
                            <?php $total_bayar = "Rp " . number_format($r->harga_smesteran, 2, ',', '.');?>
                            <?php endif;?>

                            <?php $sisa_bayar = "Rp " . number_format($r->sisa_pembayaran, 2, ',', '.');?>

                            <td><?=$total_bayar?></td>
                            <td><?=$sisa_bayar?></td>
                            <td>
                                <?php if ($r->status_transaksi == 0): ?>
                                <button type="anchor" class="btn btn-warning" disabled>
                                    Belum diproses Pemilik Kos
                                </button>
                                <?php elseif ($r->status_transaksi == 1): ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal<?=$r->id_pesan;?>">
                                    Bayar Pelunasan
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?=$r->id_pesan;?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">


                                                <div class="alert alert-primary" role="alert">
                                                    Rekening pemilik kosan : <b class="text-info"><?=$r->no_rek?></b>
                                                    (<?=$r->bank?>) <br>
                                                    <b>a.n <?=$r->nama_pemilik?></b>
                                                </div>

                                                <div class="alert alert-warning alert-dismissible fade show"
                                                    role="alert">
                                                    <strong>Perhatian!</strong> Pelunasan harus sudah selesai dilakukan
                                                    sebelum penghuni menempati kost.
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>



                                                <form id="bukti" action="<?=base_url('pencari/pembayaran_pelunasan')?>"
                                                    method="post" enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nominal Bayar</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" name="sisa_bayar1" readonly
                                                            value="<?="Rp " . number_format($r->sisa_pembayaran, 2, ',', '.')?>">

                                                        <input type="hidden" class="form-control"
                                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                                            name="sisa_bayar" readonly value="<?=$r->sisa_pembayaran?>">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">File Upload</label>
                                                        <input type="file" class="form-control" name="depe" id="depe">
                                                    </div>

                                                    <input type="hidden" name="id_pesan" value="<?=$r->id_pesan?>">
                                                    <input type="hidden" name="id_pemilik" value="<?=$r->id_user?>">
                                                    <input type="hidden" name="sisa_bayar_dp"
                                                        value="<?=$r->sisa_pembayaran?>">


                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="document.getElementById('bukti').submit();">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif ($r->status_transaksi == 2): ?>
                                <button type="anchor" class="btn btn-success" disabled>
                                    Lunas
                                </button>
                                <button class="btn btn-warning"><a href="<?php echo base_url('pencari/mailbox') ?>?from=<?=$r->id_pemilik?>&msg=Kode kos <?=$r->kode_kos?>
                  , Nama Kos <?=$r->nama_kos?>" class="btn btn-warning">
                                        <i class="fa fa-comments"></i>
                                    </a></button>
                                <?php else: ?>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#dp<?=$r->id_pesan?>">
                                    Lakukan DP / Pelunasan
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="dp<?=$r->id_pesan?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                    <?=$r->id_pesan?></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="<?=base_url('pencari/pembayaran_upload_dp')?>"
                                                    method="post" enctype="multipart/form-data">

                                                    <div class="alert alert-primary" role="alert">
                                                        Rekening pemilik kosan : <b
                                                            class="text-info"><?=$r->no_rek?></b> (<?=$r->bank?>) <br>
                                                        <b>a.n <?=$r->nama_pemilik?></b>
                                                    </div>

                                                    <?php
$keterangan_dp = 0;
if ($r->jangka_waktu == "1 Tahun") {
    $keterangan_dp = 20 / 100 * $r->harga;
} else {
    $keterangan_dp = 20 / 100 * $r->harga_smesteran;
}?>

                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        <strong>Perhatian!</strong> Pembyaran <b>DP 2X24 Jam</b>
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        <strong>Perhatian!</strong> bayar DP harus 20% dari harga kamar
                                                        (senilai
                                                        <b><?="Rp " . number_format($keterangan_dp, 2, ',', '.');?></b>
                                                        ).
                                                        Jika kurang, maka pihak admin akan menghubungi pemesan kost
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>


                                                    <input type="hidden" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" name="uang_muka"
                                                        value="<?=$r->sisa_pembayaran * 20 / 100?>">

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Nomor KTP</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" name="nomor_ktp" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Nomor HP</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" name="nomor_hp" required>
                                                    </div>

                                                    <input type="hidden" name="id_kamar" value="<?=$r->id_kamar?>">





                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">File Upload</label>
                                                        <input type="file" class="form-control" name=" depe" id="depe">
                                                    </div>

                                                    <input type="hidden" name="id_pesan" value="<?=$r->id_pesan?>">
                                                    <input type="hidden" name="kode_kamar" value="<?=$r->id_kamar?>">
                                                    <input type="hidden" name="id_pencari" value="<?=$r->id_pencari?>">
                                                    <input type="hidden" name="sisa_bayar"
                                                        value="<?=$r->sisa_pembayaran?>">

                                                    <div class="custom-control custom-checkbox mb-2 text-justify"
                                                        style="font-size: 10px;">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1" required>
                                                        <label class="custom-control-label" for="customCheck1">Syarat
                                                            dan ketentuan</label> <br>
                                                        Informasi yang terdapat dalam Situs Kami ditampilkan sesuai
                                                        keadaan kenyataan untuk tujuan informasi umum. Kami berusaha
                                                        untuk selalu menyediakan dan menampilkan informasi yang terbaru
                                                        dan akurat, namun Kami tidak menjamin bahwa segala informasi
                                                        sesuai dengan ketepatan waktu atau relevansi dengan kebutuhan
                                                        Anda
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                <?php endif;?>
                            </td>
                            <td>

                                <?php if ($r->status_transaksi == 0): ?>
                                <!-- <button class="btn btn-info">Download Kwitansi DP</button> -->
                                <?php elseif ($r->status_transaksi == 5): ?>
                                <div class=" col mt-1">
                                    <a href="pembatalan_pesanan/<?=$r->id_pesan . '/' . $r->id_kamar?>">
                                        <button class="btn btn-danger w-100" onclick="jadiatautidak()">
                                            <i class="fas fa-times-circle"></i> Batalkan
                                        </button>
                                    </a>

                                </div> <!-- bayar dp dulu -->
                                <?php else: ?>
                                <div class=" col mt-1">
                                    <a href="pembatalan_pesanan/<?=$r->id_pesan . '/' . $r->id_kamar?>">
                                        <button class="btn btn-danger w-100" onclick="jadiatautidak()">
                                            <i class="fas fa-times-circle"></i> Batalkan
                                        </button>
                                    </a>

                                </div>

                                <div class=" col mt-1">
                                    <a href="<?=base_url('pencari/cetakKwitansi')?>" target="_blank">
                                        <button class="btn btn-info w-100">
                                            <i class="fas fa-download"></i> Download Kwitansi
                                        </button>
                                    </a>

                                </div>
                                <?php endif;?>

                                <script>
                                function jadiatautidak() {
                                    confirm("Yakin membatalkan pesanan?");
                                }
                                </script>


                                <div class="col mt-1">

                                    <button type="button" class="btn btn-primary w-100" data-toggle="modal"
                                        data-target="#detail_pesanan<?=$r->id_pesan?>">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </button>

                                </div>

                            </td>
                        </tr>




                        <?php endforeach;?>
                    </tbody>
                    <tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
foreach ($result as $r): ?>


<!-- Modal -->
<div class="modal fade" id="detail_pesanan<?=$r->id_pesan?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title <?=$r->id_pesan?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card  h-75 mt-2">
                    <img src="<?=base_url('asset_admin/upload_kos/') . $r->ksFoto?>" alt="" height="450">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Detail Kosan</h5>
                        <p class="card-text font-weight-bold">
                            <?="Kosan " . $r->nama_kos . " yang ber-alamat di " . $r->alamat?>
                        </p>
                        <p class="card-text">Tipe kos <b> <?=$r->jenis_kosan?></b></p>
                    </div>
                </div>

                <div class="card  text-black h-75 mt-5">
                    <img src="<?=base_url('asset_admin/upload_kos/') . $r->kFoto?>" alt="" height="450">
                    <!-- <img src="<?=base_url('asset_admin/upload_kos/') . $r->kFoto?>" class="card-img" alt="..." height="100%"> -->
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Detail Kamar</h5>
                        <p class="card-text font-weight-bold">
                            <?="Kode Kamar " . $r->kode_kamar . " dengan " . $r->kDesc?>
                        </p>
                        <?php $harga_kamar = "Rp " . number_format($r->harga, 2, ',', '.');?>
                        <p class="card-text">Harga mulai dari <b> <?=$harga_kamar?></b></p>
                    </div>
                </div>





                <div class="card mt-2">
                    <div class="card-header">
                        Detail Pesanan
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Penghuni</th>
                                    <th scope="col">Tanggal Pesan</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>

                                    <th scope="col">Bukti Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$r->nama_penghuni?></td>
                                    <td><?=date_format(date_create($r->tanggal_pesan), "d-M-Y")?></td>
                                    <td><?=date_format(date_create($r->tanggal_masuk), "d-M-Y")?></td>
                                    <td><?=date_format(date_create($r->tanggal_keluar), "d-M-Y")?></td>
                                    <td><img src="<?=base_url('asset_admin/bukti_bayar/') . $r->bukti_bayar?>" alt=""
                                            width="150">
                                    </td>
                                </tr>

                            </tbody>
                        </table>



                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



































































<?php endforeach;?>


</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->




<?php if ($this->session->flashdata('alert')): ?>\

<?=$this->session->flashdata('alert');?>






<?php endif;?>
