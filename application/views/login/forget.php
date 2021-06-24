<?php error_reporting(0);?>



<body>

    <div class="limiter">
        <div class="container-login100">


            <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">

                <a name="submit" class="btn btn-danger mb-2 w-25 text-white" style="margin-top: -100px;"
                    href="<?=base_url('Welcome/login_pilihan')?>">
                    <i class="fas fa-arrow-left"></i> Login
                </a>


                <?=$this->session->flashdata('message')?>


                <center><img src="<?php echo base_url() ?>asset_home/img/logo2.png" width="100px" height="100px" alt="">
                </center> <br>


                <form class="login100-form validate-form" action="<?=base_url('Welcome/form_forgotPW')?>" method="POST">
                    <span class="login100-form-title p-b-55">
                        Lupa password
                    </span>




                    <div class="wrap-input100 validate-input m-b-16" data-validate="Email is required">
                        <input class="input100" type="email" name="email" placeholder="Email">
                    </div>



                    <div class="container-login100-form-btn p-t-25">
                        <button name="submit" class="login100-form-btn" value="1" style="background-color: #5F9EA0;">
                            Kirim
                        </button>
                    </div>

                    <div class="text-center w-full p-t-115">
                        <span class="txt1">
                            Belum Punya Akun?
                        </span>


                        <a class="txt1 bo1 hov1" href="<?php echo base_url('Welcome/registrasi_pencari'); ?>">
                            Daftar Sekarang
                        </a>
                    </div>

                    <!-- <div class="text-center w-full p-t-5">
                        <span class="txt1">
                            Belum Punya Akun?
                        </span>


                        <a class="txt1 bo1 hov1" href="<?php echo base_url('Welcome/registrasi_pencari'); ?>">
                            Daftar Sekarang
                        </a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
