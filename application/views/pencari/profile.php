 <?php error_reporting(0); ?>
 <div class="container-fluid">
     <?= $this->session->flashdata('berhasil') ?>
     <div class="card shadow mb-4">
         <!-- DataTales Example -->
         <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Profile/Settings</h6>
             </div>
             <div class="card-body">
                 <div class="col-lg-6" style="float:right;">
                     <h3>Ganti password</h3>
                     <form method="post">
                         <div class="wrap-input100 validate-input">
                             <input type="hidden" name="id_user" id="" value="<?= $nama->id_user; ?>">
                             <span class="label-input100">Password lama</span>
                             <input class="form-control" class="input100" name="password_lama" placeholder="Kosongkan jika tidak ingin diubah" type="password">
                             <span class="focus-input100"></span>
                             <?= form_error('password_lama', '<small class="text-danger ">', '</small>'); ?>
                         </div>

                         <div class="wrap-input100 validate-input">
                             <span class="label-input100">Password baru</span>
                             <input class="form-control" class="input100" type="password" name="password_baru" placeholder="Kosongkan jika tidak ingin diubah">
                             <span class="focus-input100"></span>
                             <?= form_error('password_baru', '<small class="text-danger ">', '</small>'); ?>
                         </div>
                         <div class="wrap-input100 validate-input">
                             <span class="label-input100">Password baru ulangi</span>
                             <input class="form-control" class="input100" type="password" name="konfirmasi" placeholder="Kosongkan jika tidak ingin diubah">
                             <span class="focus-input100"></span>
                             <?= form_error('konfirmasi', '<small class="text-danger ">', '</small>'); ?>
                         </div>
                         <br>
                         <button name="cpass" value="1" class="btn btn-primary btn-lg">Save</button>
                     </form>
                 </div>

                 <div class="col-lg-6">
                     <form method="post" action="<?= base_url() ?>pencari/update_profile" enctype="multipart/form-data">
                         <img src="<?= base_url('asset_registrasi/upload_pencari/') . $nama->foto ?>" class="img img-thumbnail rounded-circle" style="width:100px; height:100px;">

                         <input type="hidden" value="<?= $nama->foto ?> ?>">
                         <input type="file" name="foto">
                         <br>
                         <div class="wrap-input100 validate-input" data-validate="Name is required">
                             <span class="label-input100">Username</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->id_pencari; ?>" type="text" readonly="readonly" name="id_pencari" placeholder="ID User">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">Nama Lengkap</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->nama_pencari; ?>" type="text" name="nama_pencari" placeholder="Nama Lengkap">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">Tempat Lahir</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->tempat_lahir; ?>" type="text" name="tempat_lahir" placeholder="Tempat Lahir...">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">Tanggal Lahir</span>
                             <input class="form-control" class="input100" type="date" value="<?php echo $nama->tgl_lahir; ?>" name="tgl_lahir" placeholder="Tanggal Lahir...">
                             <span class="focus-input100"></span>
                         </div>

                         <!-- <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">Asal Daerah</span>
                             <input class="form-control" class="input100" type="text"
                                 value="<?php echo $nama->asal_daerah; ?>" name="asal_daerah" placeholder="Asal Daerah">
                             <span class="focus-input100"></span>
                         </div> -->

                         <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">No KTP</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->no_ktp; ?>" type="number" name="no_ktp" placeholder="No KTP...">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Username is required">
                             <span class="label-input100">Status</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->status; ?>" type="text" name="status" placeholder="Status...">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                             <span class="label-input100">Jenis Kelamin :
                                 <?php echo $nama->jenis_kelamin; ?></span><br><br>
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                             <span class="label-input100">Email</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->email; ?>" type="email" name="email" placeholder="Email address...">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                             <span class="label-input100">No Telepone</span>
                             <input class="form-control" class="input100" value="<?php echo $nama->no_telp; ?>" type="number" name="no_telp" placeholder="No Telepone...">
                             <span class="focus-input100"></span>
                         </div>

                         <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                             <span class="label-input100">No Telepone Wali</span>
                             <input class="form-control" class="input100" type="number" value="<?php echo $nama->no_telp_wali; ?>" name="no_telp_wali" placeholder="No Telepone Wali...">
                             <span class="focus-input100"></span>
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

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <!-- <script>
alert('Password berhasil diubah, silahkan login kembali');
window.location.href = "";
 </script><?php
            //         }else{

            //         
            ?><script>
alert('Password baru tidak sama');
 </script>
//         }
//     }else{
//         ?><script>
alert('Password lama salah');
 </script>
 // }

 // }
 // if($_POST[udata]=='1'){

 // if($_FILES['foto']['name']!=''){

 // $gambar = rand(0000,9999).$_FILES["foto"]["name"];
 // $target_file = 'asset_registrasi/upload_pencari/'.$gambar;
 // move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
 // $upfoto = ", foto='$gambar' ";

 // }

 // mysqli_query($conn,"UPDATE `kost`.`pencari` SET `instansi` = '$_POST[instansi]',
 // `no_ktp` = '$_POST[no_ktp]',
 // `no_telp` = '$_POST[no_telp]',
 // `no_telp_wali` = '$_POST[no_telp_wali]', `nama_pencari` = '$_POST[nama_pencari]',
 // `tempat_lahir` = '$_POST[tempat_lahir]',
 // `asal_daerah` = '$_POST[asal_daerah]',
 // `status` = '$_POST[status]',
 // `jenis_kelamin` = '$_POST[jenis_kelamin]',
 // `email` = '$_POST[email]' $upfoto WHERE `pencari`.`id_pencari` = '$_POST[id_pencari]'");
 // ?><script>
alert("Berhasil deparbaharui");
window.location.href = "?";
 </script><?php
            // }
            ?>