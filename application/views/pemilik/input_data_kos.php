 <div class="container-fluid">
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Input Data Kos</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <form method="POST" action="<?php echo base_url('pemilik/insert_data_kos'); ?>"
                     enctype="multipart/form-data">
                     <!-- <table>
                         <tr>
                             <td>Nama Kos</td>
                             <td><input type="text" name="nama_kos" class="input100"></td>
                         </tr>
                         <tr>
                             <td>Alamat</td>
                             <td><textarea name="alamat" rows="5" cols="55" class="input100">

                      </textarea></td>
                         </tr>
                         <tr>
                             <td>Deskripsi</td>
                             <td><textarea name="deskripsi" rows="5" cols="55" class="input100"></textarea></td>
                         </tr>
                         <tr>
                             <td>Foto</td>
                             <td><input type="file" name="foto" class="input100"></td>
                         </tr>
                         <tr>
                             <td>Jenis Kos</td>
                             <td><select name="jenis_kosan">
                                     <option value="Putra">kosan Putra</option>
                                     <option value="Putri">Kosan Putri</option>
                                     <option value="Campur">kosan Campur</option>
                                 </select></td>
                         </tr>
                     </table> -->


                     <div class="form-group">
                         <label for="exampleInputEmail1">Nama Kost</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                             name="nama_kos">

                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1">Alamat</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="alamat">
                     </div>

                     <div class="form-group">
                         <label for="exampleInputPassword1">Luas Kamar</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="luas_kamar">
                     </div>

                     <div class="form-group">
                         <label for="exampleInputPassword1">Keterangan Listrik</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="listrik">
                     </div>

                     <div class="form-group">
                         <label for="exampleFormControlTextarea1">Deskrip Lainnya</label>
                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                             name="deskripsi"></textarea>
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
                         </div>
                     </div>



                     <button type="submit" class="btn btn-primary">Submit</button>
                 </form><br>
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