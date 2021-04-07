<div class="container-fluid">

    <div class="btn-group mb-3 ">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Pilih Kosan
        </button>
        <div class="dropdown-menu">
            <?php $uri2 = $this->uri->segment(2) ?>
            <?php foreach ($list_kosan as $l) : ?>
            <a class="dropdown-item" href="<?= base_url('pemilik/') . $uri2 . '/' . $l->kode_kos ?>">Kost
                <?= $l->nama_kos ?></a>
            <?php endforeach; ?>



        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <?php print_r($result) ?> -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penghuni</th>
                            <th>Nomor Kamar</th>
                            <th>Jenis Sewa</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$no = 0;
						foreach ($result as $r) :
							$no++ ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $r->nama_penghuni ?></td>
                            <td><?= $r->kode_kamar ?></td>
                            <td><?= $r->jangka_waktu ?></td>
                            <td><?= date('d-F-Y', strtotime($r->tanggal_masuk)); ?></td>
                            <td><?= date('d-F-Y', strtotime($r->tanggal_keluar)); ?></td>
                            <td>
                                <button class="btn btn-info"><i class="fas fa-info-circle"></i> Detail
                                    Penghuni</button>
                            </td>


                        </tr>
                        <?php endforeach; ?>
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








<!-- End of Page Wrapper -->