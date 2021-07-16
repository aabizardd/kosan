<?php error_reporting(0);
session_start();?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header section -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="header-social">
                    <h6><a href="<?php echo base_url('Welcome/') ?>">HOME</a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
                <div class="user-panel">
                    <h6><a href="<?php echo base_url('Welcome/login_pilihan') ?>">Login | </a>
                        <a href="<?php echo base_url('Welcome/regis_pilihan') ?>">Registrasi</a>
                    </h6>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <a href="#" class="site-logo">
                    <img src="<?php echo base_url() ?>asset_home/img/logo1.png" width="400px" height="110" alt="">
                </a>
            </div>
        </div>
    </header>
    <!-- Header section end -->

    <div class="container">

        <div class="row">

            <?php foreach ($content as $key => $r) {?>
            <div class="col-4 mb-2">
                <div class="card">
                    <a target=" _blank" href="<?=base_url('Welcome/view_data_kos/' . $r['kode_kos'])?>">

                        <?php $data_img = $this->db->get_where('gambar_kosan', ['id_kosan' => $r['kode_kos']])->result()?>



                        <img class="card-img-top"
                            src="<?=base_url('asset_admin/assets_kosan/foto_kosan/' . $data_img[0]->nama_file)?>"
                            alt="Card image cap" style="height: 250px;">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?=$r['nama_kos']?></h5>
                        <p class="card-text"> <?=substr($r['deskripsi'], 0, 80) . "....."?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?=$r['jenis_kosan']?></small>
                    </div>
                </div>
            </div>




            <?php }?>

        </div>



    </div>



    <div class="row">

        <div class="col-12">

            <div class="container">
                <div class="card-columns">

                </div>
            </div>

        </div>

    </div>









    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- <link rel="stylesheet" href="<?=base_url('style.css');?>"> -->
