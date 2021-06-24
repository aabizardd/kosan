<?php error_reporting(0);?>



<body>

    <div class="limiter">
        <div class="container-login100">

            <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">

                <?=$this->session->flashdata('message')?>

                <center><img src="<?php echo base_url() ?>asset_home/img/logo2.png" width="100px" height="100px" alt="">
                </center> <br>


                <form class="login100-form validate-form" action="<?=base_url('Welcome/changePassword')?>"
                    method="POST">
                    <span class="login100-form-title p-b-55">
                        Ganti password
                    </span>




                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100" type="password" name="password1" id="password1" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>




                    <?=form_error('password1', '<small class="text-danger pl-3">', '</small>');?>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
                        <input class="input100" type="password" name="password2" id="password2"
                            placeholder="Ulang Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>

                    <?=form_error('password2', '<small class="text-danger pl-3">', '</small>');?>





                    <div class="container-login100-form-btn p-t-25">
                        <button name="submit" class="login100-form-btn" value="1" style="background-color: #5F9EA0;">
                            Kirim
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>
