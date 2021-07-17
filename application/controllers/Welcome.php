<?php
// session_start();
defined('BASEPATH') or exit('No direct script access allowed');
//commit coba
//commit abi
class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_All');
        $this->load->model('M_kosan');
        $this->load->library('form_validation');

        // var_dump($this->session->all_userdata());die();
        // var_dump($this->session->all_userdata());die();

        // var_dump($this->session->all_userdata());die();

        if ($this->session->userdata('admin')) {
            redirect('admin');
        } elseif ($this->session->userdata('pemilik')) {
            redirect('pemilik');
        } elseif ($this->session->userdata('pencari')) {
            redirect('pencari');
        }
    }

    public function index()
    {
        // $data['artikel'] = $this->M_All->get('artikel')->result();
        $data['content'] = $this->M_kosan->selectAll();

        $this->load->view('home/head_home');
        $this->load->view('home/konten', $data);
        $this->load->view('home/foot_home');
    }

    public function view_data_kos($id)
    {
        $where_ = array('kode_kos' => $id);
        $data['kos'] = $this->M_All->view_where('kosan', $where_)->row();
        $data['result'] = $this->M_All->view_where('kamar', $where_)->result();

        $this->load->view('home/head_home', $data);
        $this->load->view('home/kos', $data);
        $this->load->view('home/foot_home');
    }

    public function chat()
    {
        $this->load->view('home/head_home');
        $this->load->view('home/chat');
        $this->load->view('home/foot_home');
    }

    public function view_artikel($id)
    {
        $where = array('id_artikel' => $id);
        $data['artikel'] = $this->M_All->view_where('artikel', $where)->row();
        $this->load->view('home/head_home');
        $this->load->view('home/view_artikel', $data);
        $this->load->view('home/foot_home');
    }

    public function login_pencari()
    {
        $this->load->view('login/head_login');
        $this->load->view('login/login_pencari');
        $this->load->view('login/foot_login');
    }

    public function forget()
    {
        $this->load->view('login/head_login');
        $this->load->view('login/forget');
        $this->load->view('login/foot_login');
    }
    public function resetpass()
    {
        $this->load->view('login/head_login');
        $this->load->view('login/resetpass');
        $this->load->view('login/foot_login');
    }

    public function login_pemilik()
    {
        session_destroy();
        $this->load->view('login/head_login');
        $this->load->view('login/login_pemilik');
        $this->load->view('login/foot_login');
    }

    public function login_admin()
    {
        $this->load->view('login/head_login');
        $this->load->view('login/login_admin');
        $this->load->view('login/foot_login');
    }

    public function registrasi_pencari()
    {
        $this->load->view('registrasi/head_regis');
        $this->load->view('registrasi/registrasi_pencari');
        $this->load->view('registrasi/foot_regis');
    }

    public function registrasi_pemilik()
    {
        $this->load->view('registrasi/head_regis');
        $this->load->view('registrasi/registrasi_pemilik');
        $this->load->view('registrasi/foot_regis');
    }

    public function registrasi_admin()
    {
        $this->load->view('registrasi/head_regis');
        $this->load->view('registrasi/registrasi_admin');
        $this->load->view('registrasi/foot_regis');
    }

    public function proses_login($loginBy)
    {

        if ($loginBy == "admin") {
            $this->prosesLoginAdmin();
        } elseif ($loginBy == "pemilik") {
            $this->prosesLoginPemilik();
        } else {
            $this->prosesLoginPencari();
        }

        // ifm

        // $where = array(
        //     'username' => $username,
        //     'password' => md5($password),
        // );

        // $cek = $this->M_All->view_where('user', $where);
        // $rows = $cek->num_rows();
        // $res = $cek->result();
        // // print_r($res);\
        // // var_dump($res[0]);die();
        // $isadmin = $res[0]->is_admin;
        // $ispemilik = $res[0]->is_pemilik;
        // if ($isadmin) {
        //     if ($rows > 0 && $isadmin) {
        //         $where = array('id_user' => $res[0]->id_user);
        //         $admin = $this->M_All->view_where('admin', $where)->result();
        //         $data_session = array(
        //             'id_admin' => $admin[0]->id_admin,
        //             'admin' => 'admin',
        //         );

        //         $this->session->set_userdata($data_session);
        //         redirect(base_url('admin'));
        //     } else {
        //         echo "<script> alert('Username atau Password Salah'); </script>";
        //         $this->load->view('login/head_login');
        //         $this->load->view('login/login_admin');
        //         $this->load->view('login/foot_login');
        //     }
        //     if (empty($_SESSION['username'])) {
        //         echo "<script> alert('Username atau Password Salah'); </script>";
        //         session_destroy();
        //         header("location: " . base_url('Welcome/login_admin'));
        //     }
        // } elseif ($ispemilik) {
        //     $get_status_aktif = $this->db
        //         ->get_where('user', [
        //             'username' => $username,
        //         ])
        //         ->row_array();

        //     if ($get_status_aktif['status_aktif_pemilik'] == 0) {

        //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //         <strong>Maaf!</strong> Akun anda belum aktif.
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //         </button>
        //         </div>');

        //         redirect('Welcome/login_pemilik');
        //     } else {
        //         if ($rows > 0 && $ispemilik) {
        //             $where = array('id_user' => $res[0]->id_user);
        //             $pemilik = $this->M_All->view_where('pemilik_kos', $where)->result();
        //             $data_session = array(
        //                 'id_pemilik' => $pemilik[0]->id_pemilik,
        //                 'pemilik' => 'pemilik',
        //             );

        //             $this->session->set_userdata($data_session);
        //             redirect(base_url('pemilik'));
        //         } else {
        //             echo "<script> alert('Username atau Password Salah'); </script>";
        //             redirect('Welcome/login_pemilik');
        //         }
        //         if (empty($_SESSION['id_pemilik'])) {
        //             echo "<script> alert('Username atau Password Salah'); </script>";
        //             session_destroy();
        //             redirect('Welcome/login_pemilik');
        //         }
        //     }
        // } elseif (!$isadmin && !$ispemilik) {
        //     if ($rows > 0) {
        //         $where = array('id_user' => $res[0]->id_user);
        //         $pencari = $this->M_All->view_where('pencari_kos', $where)->result();
        //         $data_session = array(
        //             'id_pencari' => $pencari[0]->id_pencari,
        //             'pencari' => 'pencari',
        //         );
        //         print_r($pencari);
        //         $this->session->set_userdata($data_session);
        //         redirect(base_url('pencari'));
        //     } else {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //         <strong>Maaf!</strong> Password salah.
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //         </button>
        //         </div>');

        //         redirect('Welcome/login_pencari');
        //     }
        //     if (empty($_SESSION['id_pencari'])) {
        //         // echo "<script> alert('Username atau Password Salah'); </script>";
        //         // session_destroy();
        //         // header("location: ".base_url('Welcome/login_pencari'));
        //     }
        // } else {
        //     // if ($this->agent->is_referral())
        //     // {
        //     //     echo $this->agent->referrer();
        //     // }
        // }
    }

    public function prosesLoginAdmin()
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'username tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('login/head_login');
            $this->load->view('login/login_admin');
            $this->load->view('login/foot_login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'username' => $username,
            );

            $user = $this->M_All->view_where('user', $where)->row_array();

            if ($user) {

                if ($user['is_admin'] == 1) {

                    if (md5($password) == $user['password']) {

                        //kalau berhasil
                        $where = array('id_user' => $user['id_user']);
                        $admin = $this->M_All->view_where('admin', $where)->result();
                        // var_dump($admin[0]->id_admin);die();
                        $data_session = array(
                            'id_admin' => $admin[0]->id_admin,
                            'admin' => 'admin',
                        );

                        $this->session->set_userdata($data_session);
                        redirect(base_url('admin'));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<strong>Maaf</strong> Password salah.
					  </div>');
                        redirect('welcome/login_admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				<strong>Maaf</strong> Anda bukan admin.
				  </div>');
                    redirect('welcome/login_admin');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			<strong>Maaf</strong> Username belum terdaftar.
		  	</div>');
                redirect('welcome/login_admin');
            }
        }
    }

    public function prosesLoginPemilik()
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'username tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password', 'password', 'required|trim', [
            'required' => 'password tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('login/head_login');
            $this->load->view('login/login_pemilik');
            $this->load->view('login/foot_login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $where = array(
                'username' => $username,
            );

            $user = $this->M_All->view_where('user', $where)->row_array();

            if ($user) {

                if ($user['is_pemilik'] == 1) {

                    if ($user['status_aktif_pemilik'] == 1) {

                        if (md5($password) == $user['password']) {

                            //kalau berhasil
                            $where = array('id_user' => $user['id_user']);
                            $pemilik = $this->M_All->view_where('pemilik_kos', $where)->result();
                            $data_session = array(
                                'id_pemilik' => $pemilik[0]->id_pemilik,
                                'pemilik' => 'pemilik',
                            );

                            $this->session->set_userdata($data_session);
                            redirect(base_url('pemilik'));
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                            <strong>Maaf</strong> Password salah.
                              </div>');
                            redirect('welcome/login_pemilik');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <strong>Maaf</strong> Akun anda belum aktif.
                          </div>');
                        redirect('welcome/login_pemilik');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>Maaf</strong> Anda bukan pemilik kosan.
                      </div>');
                    redirect('welcome/login_pemilik');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Maaf</strong> Username belum terdaftar.
                  </div>');
                redirect('welcome/login_pemilik');
            }
        }
    }

    public function prosesLoginPencari()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $where = array(
            'username' => $username,
        );

        $user = $this->M_All->view_where('user', $where)->row_array();

        if ($user) {

            if ($user['is_pemilik'] == 0 && $user['is_admin'] == 0) {

                if ($user['status_aktif_pemilik'] == 1) {

                    if (md5($password) == $user['password']) {

                        //kalau berhasil
                        $where = array('id_user' => $user['id_user']);
                        $pencari = $this->M_All->view_where('pencari_kos', $where)->result();
                        $data_session = array(
                            'id_pencari' => $pencari[0]->id_pencari,
                            'pencari' => 'pencari',
                        );
                        // print_r($pencari);
                        $this->session->set_userdata($data_session);
                        redirect(base_url('pencari'));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						<strong>Maaf</strong> Password salah.
						  </div>');
                        redirect('welcome/login_pencari');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<strong>Maaf</strong> Akun anda belum aktif.
					  </div>');
                    redirect('welcome/login_pencari');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				<strong>Maaf</strong> Anda bukan pencari kosan.
				  </div>');
                redirect('welcome/login_pencari');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			<strong>Maaf</strong> Username belum terdaftar.
			  </div>');
            redirect('welcome/login_pencari');
        }
    }

    public function login_pilihan()
    {
        $this->load->view('home/login_pilihan');
    }

    public function regis_pilihan()
    {
        $this->load->view('home/regis_pilihan');
    }

    // Insert Pencari
    public function insert_pencari()
    {
        $config['upload_path'] = './asset_registrasi/upload_pencari/';
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
            echo "<script> alert('Foto Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
            $username = $this->input->post('username');
            $where = array('username' => $username);
            $user = $this->M_All->view_where('user', $where)->num_rows();
            if ($this->input->post('konfirmasi') == $this->input->post('password') && $user == 0) {
                $password = md5($this->input->post('password'));
                $nama_pencari = $this->input->post('nama_pencari');
                $tempat_lahir = $this->input->post('tempat_lahir');
                $tgl_lahir = $this->input->post('tgl_lahir');
                $no_ktp = $this->input->post('no_ktp');
                $status = $this->input->post('status');
                $jenis_kelamin = $this->input->post('jenis_kelamin');
                $email = $this->input->post('email');
                $no_telp = $this->input->post('no_telp');
                $no_telp_wali = $this->input->post('no_telp_wali');
                $foto = $this->upload->data('file_name');
                $datauser = array(
                    'username' => $username,
                    'password' => $password,
                    'is_pemilik' => 0,
                    'is_admin' => 0,
                );
                $id = $this->M_All->insert_get('user', $datauser);
                $data = array(
                    'id_user' => $id,
                    'nama_pencari' => $nama_pencari,
                    'tempat_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'no_ktp' => $no_ktp,
                    'status' => $status,
                    'jenis_kelamin' => $jenis_kelamin,
                    'email' => $email,
                    'no_telp' => $no_telp,
                    'no_telp_wali' => $no_telp_wali,
                    'tgl_daftar' => date('Y-m-d'),
                    'foto' => $foto,
                );
                if ($this->M_All->insert('pencari_kos', $data) != true) {
                    redirect('welcome/login_pencari');
                    echo "<script> alert('Akun Penghuni berhasil dibuat');</script>";
                } else {
                    redirect('welcome/registrasi_pencari');
                    echo "<script> alert('Akun Penghuni gagal dibuat');</script>";
                }
            } else {
                echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
                redirect('Welcome/registrasi_pencari');
            }
        }
    }

    // Insert Pemilik
    public function insert_pemilik()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Username tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required' => 'Username tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_pemilik', 'Nama Lengkap', 'required', [
            'required' => 'Nama Lengkap tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nama_pemilik', 'Nama Lengkap', 'required', [
            'required' => 'Nama Lengkap tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|matches[konfirmasi]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password minimal 3 karakter',
            'matches' => 'Password tidak cocok',
        ]);
        $this->form_validation->set_rules('konfirmasi', 'Password', 'required|trim|min_length[3]|matches[password]', [
            'required' => 'Confirm Password tidak boleh kosong',
            'min_length' => 'Confirm Password minimal 3 karakter',
            'matches' => 'Confirm Password tidak cocok',
        ]);
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required', [
            'required' => 'No KTP tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telephone', 'required', [
            'required' => 'No Telephone tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pemilik_kos.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ]);
        $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required', [
            'required' => 'Nomor Rekening tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('atas_nama_rek', 'Nama Pemilik Rekening', 'required', [
            'required' => 'Nama Pemilik Rekening tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('bank', 'Nama bank', 'required', [
            'required' => 'Nama bank tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'Jenis Kelamin tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('registrasi/head_regis');
            $this->load->view('registrasi/registrasi_pemilik');
            $this->load->view('registrasi/foot_regis');
        } else {
            $config['upload_path'] = './asset_registrasi/upload_pemilik/';
            $config['overwrite'] = true;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                // $this->load->view('upload_form', $error);
                // $this->index($error);
                $this->session->set_flashdata('foto', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Foto tidak boleh kosong
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('welcome/registrasi_pemilik');
            } else {
                $data = array('upload_data' => $this->upload->data());
                // $this->load->view('upload_success', $data);
                $username = $this->input->post('username');
                $where = array('username' => $username);
                $user = $this->M_All->view_where('user', $where)->num_rows();
                if ($this->input->post('konfirmasi') == $this->input->post('password') && $user == 0) {
                    $password = md5($this->input->post('password'));
                    $nama_pemilik = $this->input->post('nama_pemilik');
                    $no_ktp = $this->input->post('no_ktp');
                    $no_telp = $this->input->post('no_telp');
                    $no_rek = $this->input->post('no_rek');
                    $atas_nama_rek = $this->input->post('atas_nama_rek');
                    $email = $this->input->post('email');
                    $bank = $this->input->post('bank');
                    $jenis_kelamin = $this->input->post('jenis_kelamin');
                    $foto = $this->upload->data('file_name');
                    $datauser = array(
                        'username' => $username,
                        'password' => $password,
                        'is_pemilik' => 1,
                        'is_admin' => 0,
                    );
                    $id = $this->M_All->insert_get('user', $datauser);
                    $data = array(
                        'id_user' => $id,
                        'nama_pemilik' => $nama_pemilik,
                        'no_ktp' => $no_ktp,
                        'no_telp' => $no_telp,
                        'no_rek' => $no_rek,
                        'atas_nama_rek' => $atas_nama_rek,
                        'email' => $email,
                        'jenis_kelamin' => $jenis_kelamin,
                        'foto' => $foto,
                        'bank' => $bank,
                        'tgl_daftar' => date('Y-m-d'),
                    );
                    if ($this->M_All->insert('pemilik_kos', $data) != true) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Akun anda berhasil dibuat
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                        redirect('welcome/login_pemilik');
                        echo "<script> alert('Akun Pemilik berhasil dibuat');</script>";
                    } else {
                        redirect('welcome/registrasi_pemilik');
                        echo "<script> alert('Akun Pemilik gagal dibuat');</script>";
                    }
                } else {
                    echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
                    redirect('Welcome/registrasi_pemilik');
                }
            }
        }
    }
    public function cek_file($str)
    {
        $allowed_mime_type_arr = array('application/pdf', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('cek_file', 'Silahkan pilih hanya file pdf/gif/jpg/png.');
                return false;
            }
        } else {
            $this->form_validation->set_message('cek_file', 'Silakan pilih file untuk diupload.');
            return false;
        }
    }

    // Insert Admin
    public function insert_admin()
    {
        $config['upload_path'] = './asset_registrasi/upload_admin/';
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
            echo "<script> alert('Foto Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
            $username = $this->input->post('username');
            $where = array('username' => $username);
            $user = $this->M_All->view_where('user', $where)->num_rows();
            if ($this->input->post('konfirmasi') == $this->input->post('password') && $user == 0) {
                $password = md5($this->input->post('password'));
                $nama_admin = $this->input->post('nama_admin');
                $no_telp = $this->input->post('no_telp');
                $email = $this->input->post('email');
                $foto = $this->upload->data('file_name');
                $datauser = array(
                    'username' => $username,
                    'password' => $password,
                    'is_pemilik' => 0,
                    'is_admin' => 1,
                );
                $id = $this->M_All->insert_get('user', $datauser);
                $data = array(
                    'id_user' => $id,
                    'nama_admin' => $nama_admin,
                    'no_telp' => $no_telp,
                    'email' => $email,
                    'foto' => $foto,
                );
                if ($this->M_All->insert('admin', $data) != true) {
                    redirect('welcome/login_admin');
                    echo "<script> alert('Akun Admin berhasil dibuat');</script>";
                } else {
                    redirect('welcome/registrasi_admin');
                    echo "<script> alert('Akun Admin gagal dibuat');</script>";
                }
            } else {
                echo "<script> alert('Pastikan Password & konfirmasi password sama');</script>";
                redirect('Welcome/registrasi_admin');
            }
        }
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('welcome'));
    }

    public function form_forgotPW()
    {
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('login/head_login');
            $this->load->view('login/forget');
            $this->load->view('login/foot_login');
        } else {

            $email = $this->input->post('email');
            $user_pencari = $this->db->get_where('pencari_kos', ['email' => $email])->row_array();
            $user_pemilik = $this->db->get_where('pemilik_kos', ['email' => $email])->row_array();

            if ($user_pencari || $user_pemilik) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time(),
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($email, $token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
              Silahkan Cek Email Untuk Link Reset Password!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('Welcome/forget');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Maaf, Email Belum Terdaftar!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('Welcome/forget');
            }
        }
    }

    private function _sendEmail($email, $token, $type)
    {

        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'nurdalifahasr@gmail.com',
            'smtp_pass' => 'gmailifay09',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);
        $this->email->from('adminkoalakos@gmail.com', 'Admin Koala Kos');
        $this->email->to($email);

        if ($type == 'verify') {

            $this->email->subject('Account Verification');
            $this->email->message('click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {

            $this->email->subject('Reset Password');
            $this->email->message('click this link to reset your password : <a href="' . base_url() . 'Welcome/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function resetpassword()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user_pemilik = $this->db->get_where('pemilik_kos', ['email' => $email])->row_array();
        $user_pencari = $this->db->get_where('pencari_kos', ['email' => $email])->row_array();

        if ($user_pemilik || $user_pencari) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Reset password gagal! Token salah
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
                redirect('Welcome/forget');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Reset password gagal! Email salah
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
            redirect('Welcome/forget');
        }
    }

    public function changePassword()
    {

        if (!$this->session->userdata('reset_email')) {
            redirect('Welcome/forget');
        }

        $this->form_validation->set_rules('password1', 'Paassword', 'trim|required|min_length[3]|matches[password2]', [
            'matches' => '',
            'min_length' => '',
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Paassword', 'trim|required|min_length[3]|matches[password1]', [
            'matches' => 'Password Dont Match!!',
            'min_length' => 'Password To Short!',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('login/head_login');
            $this->load->view('login/changepassword');
            $this->load->view('login/foot_login');
        } else {

            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');

            $get_id_user_from_email_pencari = $this->db
                ->get_where('pencari_kos', [
                    'email' => $email,
                ])
                ->row_array();

            $get_id_user_from_email_pemilik = $this->db
                ->get_where('pemilik_kos', [
                    'email' => $email,
                ])
                ->row_array();

            $get_id_user_from_email_admin = $this->db
                ->get_where('admin', [
                    'email' => $email,
                ])
                ->row_array();

            if ($get_id_user_from_email_pencari) {
                $this->db->set('password', $password);
                $this->db->where('id_user', $get_id_user_from_email_pencari['id_user']);
                $this->db->update('user');
            } elseif ($get_id_user_from_email_pemilik) {
                $this->db->set('password', $password);
                $this->db->where('id_user', $get_id_user_from_email_pemilik['id_user']);
                $this->db->update('user');
            } else {
                $this->db->set('password', $password);
                $this->db->where('id_user', $get_id_user_from_email_admin['id_user']);
                $this->db->update('user');
            }

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
               Password sudah berhasil diganti ! Silahkan Login
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
            redirect('Welcome/forget');
        }
    }
}