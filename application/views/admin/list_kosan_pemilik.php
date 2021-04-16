<?php error_reporting(0);?>
<?php if ($_GET['print'] == 2) {echo "<script>print();</script>";}?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kosan Pemilik <b>(<?=$data_pemilik['nama_pemilik']?>)</b>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($_GET['print'] == 1) {?>
                <a target="_BLANK" href="<?=base_url('admin/data_pemilik');?>/print?print=2"
                    class="btn btn-lg btn-warning">Cetak</a>
                <br>
                <br>
                <?php }?>

                <!-- <h1><?=$this->session->userdata('id_user')?></h1> -->

                <?php if ($_GET['print'] == 2) {?>
                Print date : <?=date('d/m/Y');?>
                <?php }?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kosan</th>
                            <th>Alamat</th>
                            <th>Jenis Kosan</th>
                            <th>Deskripsi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
$no = 1;
foreach ($kosan as $item): ?>
                        <tr>


                            <td><?=$no++?></td>
                            <td><?=$item->nama_kos?></td>
                            <td><?=$item->alamat?></td>
                            <td><?=$item->jenis_kosan?></td>
                            <td><?=$item->deskripsi?></td>
                            <!-- <td></td> -->

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





<?=$this->session->flashdata('alert')?>