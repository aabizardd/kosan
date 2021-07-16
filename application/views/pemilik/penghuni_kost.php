<div class="container-fluid">
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Penghuni Kosan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <?php print_r($result)?> -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penghuni</th>
                            <th>Nomor Kamar</th>
                            <th>Jenis Sewa</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Kategori Penghuni</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
$no = 0;
foreach ($result as $r):
    $no++?>

                        <?php
    $date1 = new DateTime(date('Y-m-d', strtotime($r->tanggal_masuk)));
    $date2 = new DateTime(date('Y-m-d'));
    $interval = $date1->diff($date2);
//     echo "difference " . $interval->y . " years, " . $interval->m . " months, " . $interval->d . " days ";

// // shows the total amount of days (not divided into years, months and days like above)
    //     echo "difference " . $interval->days . " days ";

//     var_dump($interval->m);die();
    ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$r->nama_penghuni?></td>
                            <td><?=$r->kode_kamar?></td>
                            <td><?=$r->jangka_waktu?></td>
                            <td><?=date('d-F-Y', strtotime($r->tanggal_masuk));?></td>
                            <td><?=date('d-F-Y', strtotime($r->tanggal_keluar));?></td>

                            <td>
                                <?=($interval->m > 1) ? "Penghuni Lama" : "Penghuni Baru"?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-info mt-2" data-toggle="modal"
                                    data-target="#detail_penghuni<?=$r->id_pencari?>">
                                    <i class="fas fa-info-circle"></i> Detail Penghuni
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
<!-- End of Content Wrapper -->

</div>
<?php
foreach ($result as $r): ?>
<!-- Modal -->
<div class="modal fade" id="detail_penghuni<?=$r->id_pencari?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Penghuni
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mt-2">
                    <div class="card-header">
                        Detail Penghuni
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Penghuni</th>
                                    <th scope="col">No KTP</th>
                                    <th scope="col">No Hp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$r->nama_penghuni?></td>
                                    <td><?=$r->nomor_ktp?></td>
                                    <td><?=$r->nomor_hp?></td>
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









<!-- End of Page Wrapper -->