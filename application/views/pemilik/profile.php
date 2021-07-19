 <?php error_reporting(0);?>
 <div class="container-fluid">
     <?=$this->session->flashdata('foto')?>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Profile/Settings</h6>
         </div>
         <div class="card-body">

             <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div> -->

             <?=$this->session->flashdata('message')?>

             <div class="col-lg-6" style="float:right;">
                 <h3>Ganti password</h3>


                 <form method="post">
                     <div class="wrap-input100 validate-input">
                         <input type="hidden" name="id_user" id="" value="<?=$nama->id_user;?>">
                         <span class="label-input100">Password lama</span>
                         <input class="form-control" class="input100" name="password_lama"
                             placeholder="Kosongkan jika tidak ingin diubah" type="password">
                         <span class="focus-input100"></span>
                         <?=form_error('password_lama', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input">
                         <span class="label-input100">Password baru</span>
                         <input class="form-control" class="input100" type="password" name="password_baru"
                             placeholder="Kosongkan jika tidak ingin diubah">
                         <span class="focus-input100"></span>
                         <?=form_error('password_baru', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input">
                         <span class="label-input100">Password baru ulangi</span>
                         <input class="form-control" class="input100" type="password" name="konfirmasi"
                             placeholder="Kosongkan jika tidak ingin diubah">
                         <span class="focus-input100"></span>
                         <?=form_error('konfirmasi', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <br>
                     <button name="cpass" value="1" class="btn btn-primary btn-lg">Save</button>
                 </form>
             </div>
             <div class="col-lg-6">
                 <form method="post" enctype="multipart/form-data" action="<?=base_url('pemilik/update_profile')?>">
                     <img src="<?=base_url('asset_registrasi/upload_pemilik/') . $nama->foto?>"
                         class="img img-thumbnail rounded-circle" style="width:100px; height:100px;">
                     <input type="file" name="foto">
                     <br>


                     <div class="wrap-input100 validate-input" data-validate="Username is required">
                         <span class="label-input100">Nama Lengkap</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->nama_pemilik; ?>"
                             type="text" name="nama_pemilik" placeholder="Nama Lengkap">
                         <span class="focus-input100"></span>
                         <?=form_error('nama_pemilik', '<small class="text-danger ">', '</small>');?>
                     </div>
                     <div class="wrap-input100 validate-input" data-validate="Username is required">
                         <span class="label-input100">No KTP</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->no_ktp; ?>" type="number"
                             name="no_ktp" placeholder="No KTP...">
                         <span class="focus-input100"></span>
                         <?=form_error('no_ktp', '<small class="text-danger ">', '</small>');?>
                     </div>


                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                         <span class="label-input100">Email</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->email; ?>" type="text"
                             name="email" placeholder="Email address...">
                         <span class="focus-input100"></span>
                         <?=form_error('email', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                         <span class="label-input100">No Telepone</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->no_telp; ?>"
                             type="number" name="no_telp" placeholder="No Telepone...">
                         <span class="focus-input100"></span>
                         <?=form_error('no_telp', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                         <span class="label-input100">No Rek</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->no_rek; ?>" type="text"
                             name="no_rek" placeholder="No Rekening...">
                         <span class="focus-input100"></span>
                         <?=form_error('no_rek', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                         <span class="label-input100">Atas nama</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->atas_nama_rek; ?>"
                             type="text" name="atas_nama_rek" placeholder="Atas nama...">
                         <span class="focus-input100"></span>
                         <?=form_error('atas_nama_rek', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                         <span class="label-input100">Bank</span>
                         <input class="form-control" class="input100" value="<?php echo $nama->bank; ?>" type="text"
                             name="bank" placeholder="Bank...">
                         <span class="focus-input100"></span>
                         <?=form_error('bank', '<small class="text-danger ">', '</small>');?>
                     </div>
                     <br>
                     <div class="wrap-input100 validate-input">
                         <button value="1" name="udata" class="btn btn-primary btn-lg">Save</button>
                         <span class="focus-input100"></span>
                     </div>


                 </form>
             </div>
         </div>
     </div>




     <!-- DataTales Example -->
     <div class="col-6">
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Upload MoU Pemilik
                     <a href="<?=base_url('asset_admin/mou_admin/mou_pemilik_admin.docx')?>"
                         class="btn btn-primary float-right" target="_blank"><i class="fas fa-download"></i>
                         Download Mou</a>
                 </h6>

             </div>
             <div class="card-body">

                 <?=$this->session->flashdata('form_error')?>

                 <form action="<?=base_url('pemilik/upload_mou')?>" method="POST" enctype="multipart/form-data">

                     <div class="form-group">
                         <label for="exampleFormControlInput1">Email address</label>

                         <div class="custom-file">
                             <input type="file" class="custom-file-input" id="inputGroupFile01"
                                 aria-describedby="inputGroupFileAddon01" name="file_mou">
                             <label class="custom-file-label" for="inputGroupFile01">Choose file</label>

                             <small class="font-italic text-danger">*file yang diupload harus berupa pdf</small>
                         </div>
                     </div>

                     <button class="btn btn-primary" type="submit">Kirim</button>

                 </form>

             </div>
         </div>
     </div>




 </div>
 <!-- End of Main Content -->
 <?=$this->session->flashdata('alert');?>
