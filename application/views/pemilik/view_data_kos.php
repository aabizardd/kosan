<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;

}

?>
<div class="container-fluid">
    <?=$this->session->flashdata('berhasil_kos')?>
    <!-- DataTales Example -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kost</h1>

        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" type="button" data-toggle="modal"
            data-target="#myModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kamar</a>
    </div>
    <!-- Content Row -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url()?>pemilik/tambah_kamar" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kode Kamar</label>
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Kode Kamar"
                                name="kode_kamar" aria-label="kodeKamar" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga 6 Bulan</label>
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Harga 6 Bulan"
                                name="harga_smesteran" aria-label="harga" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga 1 Tahun</label>
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Harga 1 Tahun"
                                name="harga" aria-label="harga" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Deskripsi</label>
                            <input type="text" class="form-control bg-light border-1 small" placeholder="Deskripsi"
                                name="deskripsi" aria-label="deskripsi" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Foto</label>
                            <input type="file" class="form-control bg-light border-1 small" placeholder="Foto"
                                name="foto" aria-label="foto" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status</label>
                            <select name="status">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Sedang Terisi">Sedang Terisi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Tersedia</label>
                            <input type="date" class="form-control bg-light border-1 small"
                                placeholder="Tanggal Tersedia" name="tgl_tersedia" aria-label="tanggalTersedia"
                                aria-describedby="basic-addon2">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kode Kos</label>
                            <p><?=$kos->kode_kos?></p>
                            <input type="hidden" value="<?=$kos->kode_kos?>" placeholder="Kode Kos" name="kode_kos"
                                aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Kos</label>
                            <input type="text" value="<?=$kos->nama_kos?>" class="form-control bg-light border-1 small"
                                placeholder="Nama Kos" name="nama_kos" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat</label>
                            <input type="text" value="<?=$kos->alamat?>" class="form-control bg-light border-1 small"
                                placeholder="Alamat" name="alamat" aria-describedby="basic-addon2">
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlInput1">Deskripsi</label>
                            <input type="text" value="<?=$kos->deskripsi?>" class="form-control bg-light border-1 small"
                                placeholder="Deskrips" name="deskripsi" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Saldo Kos</label>
                            <input type="text" value="<?=$kos->saldo_kos?>" class="form-control bg-light border-1 small"
                                placeholder="Saldo" name="saldo_kos" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Foto</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                        aria-describedby="inputGroupFileAddon01" name="foto">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Jenis Kosan</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                </div>
                                <select class="custom-select" id="inputGroupSelect01" name="jenis_kosan">
                                    <option value="Putra">Kosan Putra</option>
                                    <option value="Putri">Kosan Putri</option>
                                    <option value="Campur">Kosan Campur</option>
                                </select>
                                <?=form_error('jenis_kosan', '<small class="text-danger ">', '</small>');?>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
            <?=validation_errors();?>
        </div>
        <?php endif;?>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Keterangan Kos</h6>
        </div>
        <div class="card-body">
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
                        <td>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="button"
                                data-toggle="modal" data-target="#myModal2"><i
                                    class="fas fa-pen fa-sm text-white-50"></i> Edit Kos</a>
                        </td>
                    </tr>

                </table>
            </div>
            <hr>
        </div>




    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Kamar</th>
                            <th>Harga Tahunan</th>
                            <th>Harga 6 Bulan</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Tanggal Tersedia</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $r): ?>
                        <tr>
                            <td><?=$r->kode_kamar;?></td>
                            <td><?=rupiah($r->harga);?></td>
                            <td><?=rupiah($r->harga_smesteran);?></td>
                            <td><?=$r->deskripsi;?></td>
                            <td><?=$r->status;?></td>
                            <td><?=$r->tgl_tersedia;?></td>
                            <td><?=($r->is_aktif == 1) ? "Aktif" : "Tidak Aktif";?></td>
                            <td>
                                <a href="<?php echo base_url("pemilik/hapus_kamar/$r->kode_kamar") ?>"
                                    class="btn btn-danger btn-sm">Hapus</a>
                                <a href="<?php echo base_url("pemilik/edit_kamar/$r->id_kamar") ?>"
                                    class="btn btn-info btn-sm">Edit</a>
                                <?php if ($r->is_aktif == 1 && $r->status == "Tersedia"): ?>

                                <button data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-warning btn-sm non-aktif" data-idkamar="<?=$r->kode_kamar?>">
                                    <i class="fas fa-times-circle"></i>
                                    Non-Aktifkan</button>

                                <?php elseif ($r->is_aktif == 0 && $r->status != "Tersedia"): ?>

                                <a href="<?=base_url('pemilik/aktivasi_kamar/1/' . $r->kode_kamar . '/' . $this->uri->segment(3))?>"
                                    class="btn btn-warning btn-sm"><i class="fas fa-check"></i>
                                    Aktifkan</a>

                                <?php endif?>

                            </td>
                        </tr>

                        <?php endforeach;?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->
<?=$this->session->flashdata('alert')?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?=base_url('pemilik/aktivasi_kamar/0')?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Non-Aktifkan Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="kode_kamar" value="" name="kode_kamar">
                    <input type="hidden" value="<?=$this->uri->segment(3)?>" name="kode_kos">

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alasan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="alasan"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<!-- End of Page Wrapper -->
<script>
$('.non-aktif').on('click', function() {

    var kode_kamar = $(this).data('idkamar');


    $('.modal-body #kode_kamar').val(kode_kamar)

});
</script>