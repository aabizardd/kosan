 <?php error_reporting(0);?>
 <?php if ($_GET['print'] == 2) {echo "<script>print();</script>";}?>
 <div class="container-fluid">

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Pemilik Kost</h6>
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
                         <?php
$no = 1;
foreach ($result as $r): ?>
                         <tr>
                             <td><?=$no++?></td>
                             <td><?=$r->username?></td>
                             <td><?=$r->nama_pemilik?></td>
                             <td><?=$r->email?></td>
                             <td><?=$r->jenis_kelamin?></td>
                             <td><?=$r->foto?></td>
                             <td>
                                 <?php if ($r->status_aktif_pemilik == 0): ?>
                                 Belum Aktif (Req Aktivasi)
                                 <?php else: ?>
                                 Aktif
                                 <?php endif;?>

                             </td>
                             <td>

                                 <!-- <button class="btn btn-primary mt-1"></button> -->

                                 <button type="button" class="btn btn-primary" data-toggle="modal"
                                     data-target="#detail<?=$r->id_user?>">
                                     <i class="fas fa-info-circle"></i> Detail
                                 </button>


                                 <?php if ($r->status_aktif_pemilik == 0): ?>

                                 <a href="<?=base_url('admin/terima_pendaftaran/') . $r->id_user?>">

                                     <button class="btn btn-success mt-1"><i class="fas fa-check-circle"></i>
                                         Terima</button>
                                 </a>

                                 <?php endif;?>
                                 <!-- <button class="btn btn-success mt-1">Terima</button> -->

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

 <!-- End of Page Wrapper -->
 <?php
$no = 1;
foreach ($result as $r): ?>
 <!-- Modal -->
 <div class="modal fade" id="detail<?=$r->id_user?>" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Detail Akun Pemilik
                     <b class="text-info"><?=strtoupper($r->username)?></b>

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
                                     <td><?=$r->nama_pemilik?></td>
                                     <td><?=$r->no_telp?></td>
                                     <td><?=$r->email?></td>
                                     <td><?=$r->jenis_kelamin?></td>
                                     <td><?=$r->no_ktp?></td>
                                     <td><?=$r->no_rek?></td>
                                     <td><?=$r->bank?></td>
                                     <td><?=$r->atas_nama_rek?></td>
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
                                     <td><?=$r->email?></td>
                                     <td><?=$r->username?></td>
                                     <td><?=date('d-F-Y', strtotime($r->tgl_daftar))?></td>

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
 <?php endforeach;?>




 <?=$this->session->flashdata('alert')?>