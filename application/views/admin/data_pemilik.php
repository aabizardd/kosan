 <?php error_reporting(0); ?>
 <?php if ($_GET['print'] == 2) {
        echo "<script>print();</script>";
    } ?>
 <div class="container-fluid">
     <?= $this->session->flashdata('pesan') ?>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Pemilik Kost</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <?php if ($_GET['print'] == 1) { ?>
                     <a target="_BLANK" href="<?= base_url('admin/data_pemilik'); ?>/print?print=2" class="btn btn-lg btn-warning">Cetak</a>
                     <br>
                     <br>
                 <?php } ?>

                 <!-- <h1><?= $this->session->userdata('id_user') ?></h1> -->

                 <?php if ($_GET['print'] == 2) { ?>
                     Print date : <?= date('d/m/Y'); ?>
                 <?php } ?>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Username</th>
                             <th>Nama Pemilik</th>
                             <th>Email</th>
                             <th>Jenis Kelamin</th>
                             <th>Foto</th>
                             <th>Status</th>
                             <th>Aksi</th>

                         </tr>
                     </thead>
                     <tbody>

                         <!-- Button trigger modal -->
                         <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                             Launch demo modal
                         </button> -->

                         <?php
                            $no = 1;
                            foreach ($result as $r) : ?>
                             <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= $r->username ?></td>
                                 <td><?= $r->nama_pemilik ?></td>
                                 <td><?= $r->email ?></td>
                                 <td><?= $r->jenis_kelamin ?></td>
                                 <td>
                                     <a href="" data-toggle="modal" data-target="#detailFoto" class="foto_pemilik" data-foto="<?= $r->foto ?>">
                                         <img src="<?= base_url('asset_registrasi/upload_pemilik/') . $r->foto ?>" alt="" width="80%" height="180">
                                     </a>

                                 </td>
                                 <td>
                                     <?php if ($r->status_aktif_pemilik == 0) : ?>
                                         Belum Aktif (Req Aktivasi)
                                     <?php elseif ($r->status_aktif_pemilik == 1) : ?>
                                         <a class="badge badge-success text-white">Aktif</a>
                                     <?php else : ?>
                                         <a class="badge badge-danger text-white">Ditolak</a>
                                     <?php endif; ?>

                                 </td>
                                 <td>

                                     <!-- <button class="btn btn-primary mt-1"></button> -->
                                     <?php if ($r->status_aktif_pemilik == 1) : ?>

                                         <a href="<?= base_url('admin/list_kosan_pemilik/') . $r->id_pemilik ?>" class="btn btn-info mt-1">
                                             <i class="fas fa-info-circle"></i> Info Kosan
                                         </a>

                                     <?php endif; ?>

                                     <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#detail<?= $r->id_user ?>">
                                         <i class="fas fa-info-circle"></i> Detail
                                     </button>


                                     <?php if ($r->status_aktif_pemilik == 0) : ?>

                                         <a href="<?= base_url('admin/terima_pendaftaran/') . $r->id_user ?>">

                                             <button class="btn btn-success mt-1"><i class="fas fa-check-circle"></i>
                                                 Terima</button>
                                         </a>


                                         <!-- Button trigger modal -->
                                         <button type="button" class="btn btn-danger mt-1 tolak" data-toggle="modal" data-target="#tolakModel" data-idd="<?= $r->id_pemilik ?>">
                                             <i class="fas fa-ban"></i> Tolak
                                         </button>


                                     <?php endif; ?>
                                     <!-- <button class="btn btn-success mt-1">Terima</button> -->

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
 <?php
    $no = 1;
    foreach ($result as $r) : ?>
     <!-- Modal -->
     <div class="modal fade" id="detail<?= $r->id_user ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-xl">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="staticBackdropLabel">Detail Akun Pemilik
                         <b class="text-info"><?= strtoupper($r->username) ?></b>

                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                     <div class="card">
                         <div class="card-header">
                             Biodata Pemilik Kos
                         </div>
                         <div class="card-body">

                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                         <th>Nama</th>
                                         <th>No Telp</th>
                                         <th>Email</th>
                                         <th>Jenis Kelamin</th>
                                         <th>No KTP</th>
                                         <th>NO Rekening</th>
                                         <th>Bank</th>
                                         <th>Atas Nama Bank</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td><?= $r->nama_pemilik ?></td>
                                         <td><?= $r->no_telp ?></td>
                                         <td><?= $r->email ?></td>
                                         <td><?= $r->jenis_kelamin ?></td>
                                         <td><?= $r->no_ktp ?></td>
                                         <td><?= $r->no_rek ?></td>
                                         <td><?= $r->bank ?></td>
                                         <td><?= $r->atas_nama_rek ?></td>
                                     </tr>
                                 </tbody>


                             </table>

                         </div>
                     </div>

                     <div class="card mt-2">
                         <div class="card-header">
                             Data Akun Pemilik
                         </div>
                         <div class="card-body">
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                     <tr>
                                         <th>Email</th>
                                         <th>Username</th>
                                         <th>Tanggal Pendaftaran</th>

                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td><?= $r->email ?></td>
                                         <td><?= $r->username ?></td>
                                         <td><?= date('d-F-Y', strtotime($r->tgl_daftar)) ?></td>

                                     </tr>
                                 </tbody>


                             </table>
                         </div>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                 </div>
             </div>
         </div>
     </div>
 <?php endforeach; ?>




 <?= $this->session->flashdata('alert') ?>



 <!-- Modal -->
 <div class="modal fade" id="detailFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Foto Pemilik</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="modal-view">

                 <img src="" alt="" id="gambar" width="100%" height="500">

             </div>

         </div>
     </div>
 </div>



 <!-- Modal -->
 <div class="modal fade" id="tolakModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Penolakan Registrasi Pemilik Kos</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="modal-view">

                 <form method="POST" action="<?= base_url('admin/tolak_pendaftaran') ?>">
                     <div class="form-group">
                         <label for="exampleInputEmail1">Alasan penolakan</label>
                         <input type="text" class="form-control" id="alasanPenolakan" aria-describedby="emailHelp" placeholder="Masukkan Alasan Penolakan" name="alasan">

                     </div>

                     <input type="hidden" id="idPemilik" name="id_pemilik">



             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
             </form>
         </div>
     </div>
 </div>