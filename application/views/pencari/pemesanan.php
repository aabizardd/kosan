<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tamu</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <!-- <?php print_r($result) ?> -->
                    <thead>
                        <tr>

                            <th>Nama Kos</th>
                            <th>Alamat Kos</th>
                            <th>Kamar</th>
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



                        <?php foreach ($result as $r) : ?>
                            <tr>

                                <td><?= strtoupper($r->nama_kos) ?></td>
                                <td><?= strtoupper($r->alamat) ?></td>
                                <td><?= $r->kode_kamar ?></td>
                                <td><?= $r->nama_penghuni ?></td>
                                <!--<td><?= $r->sisa_pembayaran ?></td>-->

                                <?php $total_bayar = "Rp " . number_format($r->harga, 2, ',', '.'); ?>
                                <?php $sisa_bayar = "Rp " . number_format($r->sisa_pembayaran, 2, ',', '.'); ?>

                                <td><?= $total_bayar ?></td>
                                <td><?= $sisa_bayar ?></td>
                                <td>
                                    <?php if ($r->status_transaksi == 0) : ?>
                                        <button type="anchor" class="btn btn-warning" disabled>
                                            Belum diproses Pemilik Kos
                                        </button>
                                    <?php elseif ($r->status_transaksi == 1) : ?>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $r->id_transaksi; ?>">
                                            Pembayaran
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $r->id_transaksi; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Nomor Rekening :
                                                        <?= $r->no_rek; ?>
                                                        <form id="bukti" class="form" action="<?= base_url('pencari/simpan_bukti') ?>" method="post" enctype="multipart/form-data">
                                                            <label for="bukti">Masukan bukti pembayaran</label>
                                                            <input class="form-control" type="file" name="foto" value="">
                                                            <input type="hidden" name="id_transaksi" value="<?= $r->id_transaksi ?>">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="document.getElementById('bukti').submit();">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($r->status_transaksi == 2) : ?>
                                        <button type="anchor" class="btn btn-success" disabled>
                                            Lunas
                                        </button>



                                        <!-- <button class="btn btn-warning"><a href="<?php echo base_url('pencari/mailbox') ?>?from=<?= $r->id_pemilik ?>&msg=Kode kos <?= $r->kode_kos ?>
                  , Nama Kos <?= $r->nama_kos ?>" class="btn btn-warning">
                                        <i class="fa fa-comments"></i>
                                    </a></button> -->

                                    <?php elseif ($r->status_transaksi == 3) : ?>
                                        <button type="anchor" class="btn btn-danger" disabled>
                                            Transaksi Batal
                                        </button>

                                    <?php elseif ($r->status_transaksi == 4) : ?>
                                        <button type="anchor" class="btn btn-danger" disabled>
                                            Transaksi Ditolak
                                        </button>
                                        <input type="text" class="form-control mt-2" value="<?= $r->keterangan_pembatalan ?>" readonly>

                                    <?php else : ?>
                                        Maaf Hubungi Pemilik atau Admin
                                    <?php endif; ?>
                                </td>
                                <td>


                                    <div class="col mt-1">

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail_pesanan<?= $r->id_pesan ?>">
                                            <i class="fas fa-info-circle"></i> Detail Riwayat
                                            <!-- <?= $r->id_pencari ?> -->
                                        </button>

                                    </div>

                                </td>
                            </tr>




                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
foreach ($result as $r) : ?>


    <!-- Modal -->
    <div class="modal fade" id="detail_pesanan<?= $r->id_pesan ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card  text-black  mt-2">
                        <img src="<?= base_url('asset_admin/upload_kos/') . $r->ksFoto ?>" alt="" height="500">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Detail Kosan</h5>
                            <p class="card-text font-weight-bold">
                                <?= "Kosan " . $r->nama_kos . " yang ber-alamat di " . $r->alamat ?>
                            </p>
                            <p class="card-text">Tipe kos <b> <?= $r->jenis_kosan ?></b></p>
                        </div>
                    </div>

                    <div class="card  text-black mt-5">
                        <img src="<?= base_url('asset_admin/upload_kos/') . $r->kFoto ?>" alt="" height="500">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Detail Kamar</h5>
                            <p class="card-text font-weight-bold">
                                <?= "Kode Kamar " . $r->kode_kamar . " dengan " . $r->kDesc ?>
                            </p>
                            <?php $harga_kamar = "Rp " . number_format($r->harga, 2, ',', '.'); ?>
                            <p class="card-text">Harga mulai dari <b> <?= $harga_kamar ?></b></p>
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
                                        <th scope="col">Jumlah DP</th>
                                        <th scope="col">Sisa Pembayaran</th>
                                        <th scope="col">Bukti Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $r->nama_penghuni ?></td>
                                        <td><?= date_format(date_create($r->tanggal_pesan), "d-M-Y") ?></td>
                                        <td><?= date_format(date_create($r->tanggal_masuk), "d-M-Y") ?></td>
                                        <td><?= date_format(date_create($r->tanggal_keluar), "d-M-Y") ?></td>

                                        <?php
                                        $jumlahDP = "Rp " . number_format($r->jumlah_dp, 2, ',', '.');
                                        $sisa = "Rp " . number_format($r->sisa_pembayaran, 2, ',', '.'); ?>

                                        <td><?= $jumlahDP ?></td>
                                        <td><?= $sisa ?></td>
                                        <td><img src="" alt=""></td>
                                    </tr>

                                </tbody>
                            </table>



                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


<?php if ($this->session->flashdata('alert')) : ?>\

<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false" style="position: fixed; top: 0; right: 0;">
    <div class="toast-header">
        <span style="font-size: 1.5em; color: Tomato; margin-right: 10px;">
            <i class="fas fa-times-circle"></i>
        </span>
        <strong class="mr-auto text-danger">Perhatian!</strong>
        <small>Baru Saja</small>
        <butto n type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </butto>
    </div>
    <div class="toast-body">
        Pesanan Berhasil Dibatalkan
    </div>
</div>




<?php endif; ?>