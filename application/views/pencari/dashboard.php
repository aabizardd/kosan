 <div class="container-fluid">

     <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Artikel</h6>
        </div>
        <div class="card-body">-->
     <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($artikel as $art) : ?>
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?= base_url('asset_admin/artikel/' . $art->foto) ?>" alt="First slide">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Previous</span>   </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>  </a>
            </div> -->
     <!--<div class="card-columns">-->
     <!--	<?php foreach ($artikel as $a) : ?>-->
     <!--	<div class="card">
    					<a href="<?= base_url('welcome/view_artikel/' . $a->id_artikel); ?>">
    						<img class="card-img-top" src=" <?= base_url('asset_admin/artikel/' . $a->foto) ?>" alt="Card image cap">
    					</a>
    					<div class="card-body">
    						<h5 class="card-title"><?= $a->judul ?></h5>
    						<p class="card-text"><?= $a->deskripsi ?></p>
    					</div>
    					<div class="card-footer">
    						<small class="text-muted"><?= $a->tgl_upload ?></small>
    					</div>
    				</div>
    			<?php endforeach; ?>
    		</div>
        </div>

    </div>-->
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Informasi Kos-Kos an</h6>
         </div>
         <div class="card-body">
             <!-- <div class="table-responsive"> -->
             <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> -->
             <!-- <thead> -->
             <!-- <div class="row"> -->
             <!-- <div class="section-body">
                 <div class="row">
                     <div class="col">
                         <section class="section-popular-content  py-3" id="tabel-files">
                             <div class="container">
                                 <div class="section-popular-travel row justify-content-start" id="">
                                     <?php foreach ($result as $r) : ?>


                                         <div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                                             <div class=" shadow bg-white rounded  d-flex flex-column ">
                                                 <div class="view overlay">
                                                     <img class="card-img-top " src="<?php echo base_url('asset_admin/upload_kos/' . $r->foto); ?>" height="250" alt="Card image cap">
                                                 </div>

                                                 <div class="card-body">
                                                     <p class="card-title font-weight-"><a></a></p>

                                                     <p class="card-text"><i class="fas fa-store mr-1"></i></p>
                                                     <hr class="my-4">

                                                     <a href="<?= base_url() ?>reseller/beli_sekarang/<?= $p['id_produk'] ?>  " class="btn btn-primary btn-block">Beli Sekarang</a>
                                                     <a href="<?= base_url() ?>reseller/detail_produk/<?= $p['id_produk'] ?>  " class="btn btn-secondary btn-block">

                                                         Detail
                                                     </a>

                                                 </div>
                                             <?php endforeach; ?>
                                             </div>
                                         </div>
                                 </div>
                             </div>
                         </section>
                     </div>
                 </div>
             </div> -->
             <!-- </div> -->
             <div class="row">
                 <div class="col-12">
                     <!-- <div class="col"> -->
                     <div class="card-columns">
                         <?php foreach ($result as $r) : ?>
                             <div class="card">
                                 <img class="card-img-top" src="<?php echo base_url('asset_admin/upload_kos/' . $r->foto); ?>" alt="<?= $r->foto ?>" height="200">
                                 <div class="card-body">
                                     <h3 class="card-title"><?php echo $r->nama_kos; ?></h3>
                                     <p class="card-text">

                                         Alamat : <?php echo $r->alamat; ?>
                                     </p>

                                     <a href="<?= base_url('pencari/view_data_kos/') . $r->kode_kos; ?>" class="btn btn-primary">
                                         Ketersediaan Kamar</a>
                                     <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= $r->no_telp ?>" class="btn btn-success">Whatsapp</a>
                                 </div>
                             </div>
                         <?php endforeach; ?>

                     </div>
                     <!-- </div> -->
                 </div>
             </div>

             <!-- </thead> -->
             <!-- <tfoot> -->

             <!-- </tbody> -->
             <!-- </table> -->
         </div>
     </div>
 </div>
 <div class="card-columns">
     <!-- <div class="card">
                  <img class="card-img-top" src="assets/images/card-img.jpg" alt="Card image cap">
                  <div class="card-body">
                      <h3 class="card-title">Mudah mendapatkan vendor</h3>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
              </div>
               <div class="card">
                  <img class="card-img-top" src="assets/images/card-img.jpg" alt="Card image cap">
                  <div class="card-body">
                      <h3 class="card-title">Lebih banyak pilihan</h3>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
              </div>
              <div class="card">
                  <img class="card-img-top" src="assets/images/card-img.jpg" alt="Card image cap">
                  <div class="card-body">
                      <h3 class="card-title">Paket Pernikahan</h3>
                      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <a href="<?= base_url('paket') ?>" class="btn btn-outline-primary">Lihat Paket</a>
                  </div>
              </div> -->
 </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- <i class="fas fa-check-circle"></i> -->

 <?php if ($this->session->flashdata('alert')) : ?>

     <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false" style="position: fixed; top: 0; right: 0;">
         <div class="toast-header">
             <span style="font-size: 1.5em; color: #06db00; margin-right: 10px;">
                 <i class="fas fa-check-circle"></i>
             </span>
             <strong class="mr-auto text-success">Perhatian!</strong>

             <small>11 mins ago</small>
             <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="toast-body">
             Berhasi
             l Memes
             an, dat
             a akan
             diproses oleh pemilik kosan dan mohon ditungu <span style="font-size: 1em; color: #06db00;">
                 <i class="fas fa-smile"></i>
             </span>
         </div>
     </div>

 <?php endif; ?>