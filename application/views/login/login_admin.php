<body>
    <div class="limiter">
        <div class="container-login100">

            <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
                <?= $this->session->flashdata('message') ?>
                <center><img src="<?php echo base_url() ?>asset_home/img/logo2.png" width="100px" height="100px" alt="">
                </center> <br>

                <form class="login100-form validate-form" action="<?php echo base_url('Welcome/proses_login/admin'); ?>" method="post">
                    <span class="login100-form-title p-b-55">
                        Login Admin Kos
                    </span>
                    <div class="wrap-input100  m-b-16">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-user"></span>
                        </span>
                        <?= form_error('username', '<small class="text-danger ">', '</small>'); ?>
                    </div>
                    <div class="wrap-input100  m-b-16">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                        <?= form_error('password', '<small class="text-danger ">', '</small>'); ?>
                    </div>

                    <div class="contact100-form-checkbox m-l-4">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn p-t-25">
                        <button type="submit" name="submit" class="login100-form-btn" style="background-color: #5F9EA0;">
                            Login
                        </button>
                        <div class="container-login100-form-btn p-t-25">
                            <a class="login100-form-btn" style="background-color: red;" href="<?php echo base_url('Welcome/login_pilihan'); ?>">
                                Back
                            </a>

                            <a href="forget">Lupa password</a>
                        </div>

                        <div class="text-center w-full p-t-115">
                            <span class="txt1">
                                Belum Punya Akun?
                            </span>

                            <a class="txt1 bo1 hov1" href="<?php echo base_url('Welcome/registrasi_admin'); ?>">
                                Daftar Sekarang
                            </a>
                        </div>
                </form>
            </div>
        </div>
    </div>