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

                     <?=$this->session->flashdata('foto')?>

                     <div class="form-group">
                         <label for="exampleInputEmail1">Nama Kost</label>
                         <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                             name="nama_kos">
                         <?=form_error('nama_kos', '<small class="text-danger ">', '</small>');?>
                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1">Alamat</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="alamat">
                         <?=form_error('alamat', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="form-group">
                         <label for="exampleInputPassword1">Luas Kamar</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="luas_kamar">
                         <?=form_error('luas_kamar', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="form-group">
                         <label for="exampleInputPassword1">Keterangan Listrik</label>
                         <input type="text" class="form-control" id="exampleInputPassword1" name="listrik">
                         <?=form_error('listrik', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div class="form-group">
                         <label for="exampleFormControlTextarea1">Deskrip Lainnya</label>
                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                             name="deskripsi"></textarea>
                         <?=form_error('deskripsi', '<small class="text-danger ">', '</small>');?>
                     </div>

                     <div id="hmm">

                         <div class="row">

                             <div class="col-5">

                                 <div class="form-group">
                                     <label for="exampleFormControlTextarea1">Tempat</label>
                                     <input type="text" class="form-control" id="exampleInputPassword1" name="tempat[]">

                                 </div>
                             </div>

                             <div class="col-5">

                                 <div class="form-group">
                                     <label for="exampleFormControlTextarea1">Foto</label>
                                     <div class="input-group mb-3">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                         </div>
                                         <div class="custom-file">
                                             <input type="file" class="custom-file-input" id="inputGroupFile01"
                                                 aria-describedby="inputGroupFileAddon01" name="foto[]">
                                             <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-2">
                                 <div class="form-group">
                                     <label for="exampleFormControlTextarea1"> Tambah Foto</label>
                                     <div class="input-group mb-3">
                                         <input type="button" name="addd" id="add" value="Tambah"
                                             class="btn btn-warning">
                                     </div>
                                 </div>
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
 <!-- End of Content Wrapper
-->

 </div>

 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
     crossorigin="anonymous"></script>

 <!-- End of Page Wrapper -->

 <script type="text/javascript">
$(document).ready(function() {

    var html =
        '<div class="row"> <div class="col-5"><div class="form-group"><label for="exampleFormControlTextarea1">Tempat</label><input type="text" class="form-control" id="exampleInputPassword1" name="tempat[]"></div></div><div class="col-5"><div class="form-group"><label for="exampleFormControlTextarea1">Foto</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroupFileAddon01">Upload</span></div><div class="custom-file"><input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="foto[]"><label class="custom-file-label for="inputGroupFile01">Choose file</label></div></div></div></div>';

    html +=
        '<div class="col-2"><div class="form-group"><label for="exampleFormControlTextarea1"> Hapus Foto</label><div class="input-group mb-3"><input type="button" name="remove" id="remove" value="Hapus" class="btn btn-danger"></div></div></div></div>';

    var max = 19;
    var x = 1;

    $("#add").click(function() {
        if (x <= max) {
            $("#hmm").append(html);
            x++;
        }
    });

    $("#hmm").on('click', '#remove', function() {
        $(this).closest('.row').remove();
        x--;
    });

})
 </script>
