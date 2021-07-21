 <?php error_reporting(0);?>
 <?php if ($_GET['print'] == 2) {echo "<script>print();</script>";}?>
 <div class="container-fluid">

     <form action="<?=base_url('admin/data_kos')?>" method="POST">
         <label for="exampleInputEmail1" class="form-label">Cari Bedasarkan</label>
         <div class="row mb-2">

             <div class="col-2">
                 <div class="input-group mb-3">

                     <select class="custom-select rounded-left" id="inputGroupSelect01" name="tipe_kos">
                         <option value="" selected>Tipe Kosan</option>
                         <option value="Putra">Laki-laki</option>
                         <option value="Putri">Perempuan</option>
                         <option value="Campur">Campur</option>
                     </select>
                 </div>
             </div>

             <div class="col-2">
                 <div class="input-group mb-3">

                     <select class="custom-select rounded-left" id="inputGroupSelect01" name="bulan">
                         <option value="" selected>Bulan Daftar</option>
                         <?php
$no = 1;
foreach ($bulan as $b): ?>
                         <option value="<?=$no++?>"><?=$b?></option>
                         <?php endforeach;?>
                     </select>
                 </div>
             </div>

             <div class="col-2">
                 <button class="btn btn-success" type="submit">Cari</button>
             </div>


         </div>
     </form>
     <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Kost</h6>

             <!-- Example single danger button -->
             <!-- <div class="btn-group float-right" style="margin-top: -20px;">
                 <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                     Pilih Bulan
                 </button>
                 <div class="dropdown-menu">
                     <?php
$no = 1;
foreach ($bulan as $b): ?>

                     <a class="dropdown-item" href="<?=base_url('admin/data_kos/') . $no++?>"><?=$b?></a>

                     <?php endforeach;?>

                 </div>
             </div> -->


         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <?php if ($_GET['print'] == 1) {?>
                 <a target="_BLANK" href="<?=base_url('admin/data_kos');?>/print?print=2"
                     class="btn btn-lg btn-warning">Cetak</a>
                 <br>
                 <br>
                 <?php }?>

                 <?php if ($_GET['print'] == 2) {?>
                 Print date : <?=date('d/m/Y');?>
                 <?php }?>
                 <table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>Kode Kos</th>
                             <th>Nama Kos</th>
                             <th>Alamat</th>
                             <th>Deskripsi</th>
                             <th>Foto</th>
                             <th>Jenis Kosan</th>
                             <th>Saldo Kos</th>
                             <th>Nama Pemilik</th>
                             <th>Tanggal Pendaftaran</th>

                             <th>Aksi</th>

                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($result as $r): ?>
                         <?php $images = $this->db->get_where('gambar_kosan', ['id_kosan' => $r->kode_kos])->result()?>
                         <tr>
                             <td><?php echo $r->kode_kos ?></td>
                             <td><?php echo $r->nama_kos ?></td>
                             <td><?php echo $r->alamat ?></td>
                             <td><?php echo $r->deskripsi ?></td>
                             <td>

                                 <a href="" data-toggle="modal" data-target="#exampleModal"
                                     data-foto="<?=$images[0]->nama_file?>" class="foto_kos">
                                     <img src="<?=base_url('asset_admin/assets_kosan/foto_kosan/') . $images[0]->nama_file?>"
                                         alt="" width="200" height="200">
                                 </a>

                             </td>
                             <td><?php echo $r->jenis_kosan ?></td>
                             <td><?php echo $r->saldo_kos ?></td>
                             <td><?php echo $r->nama_pemilik ?></td>
                             <td><?php echo date('d-F-Y', strtotime($r->tanggal_daftar)) ?></td>

                             <td>

                                 <a href="<?php echo base_url("Admin/edit_kos/$r->kode_kos") ?>"
                                     class="btn btn-info mt-1">Edit</a>
                             </td>

                         </tr>
                         <?php endforeach;?>
                     </tbody>

                     <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                         Launch demo modal
                     </button> -->

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

 <!-- Button trigger modal -->


 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Gambar</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="modal-view">
                 <img src="" alt="" id="gambar" width="100%">

                 <!-- <input type="text" id="gambar"> -->

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-primary">Save changes</button>
             </div>
         </div>
     </div>
 </div>
