<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tamu</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <!-- <?php print_r($result)?> -->
                    <thead>
                        <tr>

                            <th>Nama Kos</th>
                            <th>Alamat Kos</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- <th>Sisa Pembayaran</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($keranjangs as $item): ?>
                        <tr>

                            <td><?=$item->nama_kos?></td>
                            <td><?=$item->alamat?></td>
                            <td><?=$item->dk_kamar?></td>
                            <td><?=$item->status?></td>
                            <td style="width: 200px;">

                                <a href="<?=base_url('pencari/hapus_keranjang/' . $item->id_keranjang)?>"
                                    class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>

                                <?php if ($item->status == "Tersedia"): ?>

                                <a href="<?=base_url('pencari/view_data_kos/' . $item->kode_kos)?>"
                                    class="btn btn-primary"><i class="fas fa-plus"></i> Booking</a>

                                <?php endif;?>




                            </td>

                        </tr>
                        <?php endforeach?>






                    </tbody>
                    <tfoot>
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


<?php if ($this->session->flashdata('alert')): ?>

<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
    style="position: fixed; top: 0; right: 0;">
    <div class="toast-header">
        <span style="font-size: 1.5em; color: #34ad5b; margin-right: 10px;">
            <i class="fas fa-smile"></i>
        </span>
        <strong class="mr-auto text-success">Perhatian!</strong>
        <small>Baru Saja</small>
        <butto n type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </butto>
    </div>
    <div class="toast-body">
        <?=$this->session->flashdata('alert')?>
    </div>
</div>





<?php endif;?>