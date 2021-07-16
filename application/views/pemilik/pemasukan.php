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
            <h6 class="m-0 font-weight-bold text-primary">Grafik Pemasukan</h6>
        </div>
        <div class="card-body">
            <canvas id="chBar" height="100"></canvas>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if (is_null($this->uri->segment(4))): ?>
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan Bulan <?=date('F')?></h6>
            <?php else: ?>
            <h6 class="m-0 font-weight-bold text-primary">Pemasukan Bulan <?=$bulan[$this->uri->segment(4) - 1]?></h6>
            <?php endif;?>

            <!-- Example split danger button -->
            <div class="btn-group float-right" style="margin-top: -20px;">
                <button type="button" class="btn btn-info">Pilih Tahun</button>
                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Pilih Tahun</span>
                </button>
                <div class="dropdown-menu">
                    <?php
$no = 1;
foreach ($thn as $t): ?>
                    <a class="dropdown-item"
                        href="<?=base_url('pemilik/pemasukan/') . $kode_kosss . '/' . 0 . '/' . $t?>"><?=$t?></a>
                    <?php endforeach;?>
                    <!--
                    <h1><?=$bulan[3 - 1]?></h1> -->

                </div>
            </div>








            <!-- Example split danger button -->
            <div class="btn-group float-right mr-2" style="margin-top: -20px;">
                <button type="button" class="btn btn-info">Pilih Bulan</button>
                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Pilih Bulan</span>
                </button>
                <div class="dropdown-menu">
                    <?php
$no = 1;
foreach ($bulan as $b): ?>
                    <a class="dropdown-item"
                        href="<?=base_url('pemilik/pemasukan/') . $kode_kosss . '/' . $no++?>"><?=$b?></a>
                    <?php endforeach;?>
                    <!--
                    <h1><?=$bulan[3 - 1]?></h1> -->

                </div>
            </div>

        </div>
        <!-- <h1><?=date('m')?></h1> -->
        <div class="card-body">
            <div class="table-responsive">
                <!-- <?php print_r($result)?> -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kamar</th>
                            <th>Jenis Sewa</th>
                            <th>Masa Tenggat Sewa</th>
                            <th>Tanggal Pendapatan</th>
                            <th>Status</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <?php
$no = 1;
foreach ($result as $r): ?>
                    <tbody>


                        <td><?=$no++?></td>
                        <td><?=$r->kode_kamar?></td>
                        <td><?=$r->jangka_waktu?></td>
                        <td><?=date("d-F-Y", strtotime($r->tanggal_keluar))?></td>
                        <td><?=date("d-F-Y", strtotime($r->tanggal_pesan))?></td>
                        <?php
if ($r->jangka_waktu = "6 Bulan") {
    $sisa_pembayaran = $r->harga_smesteran * 20 / 100;
    $sisa = $r->harga_smesteran - $sisa_pembayaran;
} else {

    $sisa_pembayaran = $r->harga * 20 / 100;
    $sisa = $r->harga - $sisa_pembayaran;
}

?>
                        <?php if ($r->sisa_pembayaran == 0): ?>

                        <td>Lunas</td>
                        <td> <?="Rp " . number_format($r->harga, 2, ',', '.');?></td>
                        <?php else: ?>
                        <td>DP</td>
                        <td> <?="Rp " . number_format($r->jumlah_dp, 2, ',', '.');?></td>

                        <?php endif;?>



                    </tbody>
                    <?php endforeach;?>

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