<?php
// session_start();
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Admin extends CI_Controller
{
    // private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_All');
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('admin') != "admin") {
            redirect(base_url(''));
        }
    }

    public function index()
    {
        $total_transaksi = $this->M_All->count('pemesanan');
        // print_r($total_transaksi);
        $where = array('id_pesan' => 0);
        $yang_belum = $this->M_All->count_where('pemesanan', $where);
        $f = 0;
        if ($total_transaksi > 0) {
            $f = $yang_belum / $total_transaksi;
        }
        $persen = number_format($f * 100, 0);
        $data['per'] = array(
            'total_transaksi' => $total_transaksi,
            'persen' => $persen,
            'yang_belum' => $yang_belum,
        );
        $data['jumlah_pemilik'] = $this->M_All->count('pemilik_kos');
        $data['jumlah_pencari'] = $this->M_All->count('pencari_kos');
        $data['jumlah_kosan'] = $this->M_All->count('kosan');
        // $data['jumlah_kamar'] = $this->M_All->count('kosan');
        $data['jumlah_kamar'] = $this->M_All->count('kamar');
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();

        $data['count_pencari'] = $this->M_All->count_groupby('pencari_kos', 'MONTH(tgl_daftar)');
        $data['count_pemilik'] = $this->M_All->count_groupby('pemilik_kos', 'MONTH(tgl_daftar)');

        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/foot_admin');
        $this->load->view('graph/jumlah_pencari');
        $this->load->view('graph/jumlah_pemilik');
    }

    public function profile()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password_lama', 'Password', 'required', [
            'required' => 'Password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password_baru', '', 'min_length[6]|required|matches[konfirmasi]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password terlalu pendek',
            'matches' => 'Password tidak cocok'
        ]);
        $this->form_validation->set_rules('konfirmasi', '', 'min_length[6]|required|matches[password_baru]', [
            'required' => 'Confirm Password tidak boleh kosong',
            'min_length' => ' Password terlalu pendek',
            'matches' => ' Password tidak cocok',
        ]);
        if ($this->form_validation->run() == false) {
            $total_transaksi = $this->M_All->count('pemesanan');
            $where = array('id_pesan' => 0);
            $yang_belum = $this->M_All->count_where('pemesanan', $where);
            $f = 0;
            if ($total_transaksi > 0) {
                $f = $yang_belum / $total_transaksi;
            }
            $persen = number_format($f * 100, 0);
            $data['per'] = array(
                'total_transaksi' => $total_transaksi,
                'persen' => $persen,
                'yang_belum' => $yang_belum,
            );
            $data['jumlah_orang'] = $this->M_All->count('pencari_kos');
            $data['jumlah_kamar'] = $this->M_All->count('kamar');
            $idadmin = $this->session->userdata('id_admin');
            $where = array('id_admin' => $idadmin);
            $data['nama'] = $this->M_All->view_where('admin', $where)->row();
            $this->load->view('admin/sidebar_admin');
            $this->load->view('admin/header_admin', $data);
            $this->load->view('admin/profile');
            $this->load->view('admin/foot_admin');
        } else {
            $where_update = array('id_user' => $this->input->post('id_user'));
            $data = [
                'password' => md5($this->input->post('password_baru'))
            ];


            $this->M_All->update('user', $where_update, $data);
            $this->session->set_flashdata('alert', '

			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #7AEA09; margin-right: 10px;">
					<i class="fas fa-check-circle"></i>
				</span>
				<strong class="mr-auto text-success">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				Profile updated <span style="font-size: 1em; color: #7AEA09;">
					<i class="fas fa-smile"></i>
				</span>
			</div>
		</div>


			');
            $this->session->set_flashdata('berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil Ganti Password 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/profile/');
        }
    }

    // public function mailbox()
    // {
    //     $total_transaksi = $this->M_All->count('pemesanan');
    //     $where = array('id_pesan' => 0);
    //     $yang_belum = $this->M_All->count_where('pemesanan', $where);
    //     $f = 0;
    //     if ($total_transaksi > 0) {
    //         $f = $yang_belum / $total_transaksi;
    //     }
    //     $persen = number_format($f * 100, 0);
    //     $data['per'] = array(
    //         'total_transaksi' => $total_transaksi,
    //         'persen' => $persen,
    //         'yang_belum' => $yang_belum,
    //     );
    //     $data['jumlah_orang'] = $this->M_All->count('pencari_kos');
    //     $data['jumlah_kamar'] = $this->M_All->count('kamar');
    //     $idadmin = $this->session->userdata('id_admin');
    //     $where = array('id_admin' => $idadmin);
    //     $data['nama'] = $this->M_All->view_where('admin', $where)->row();
    //     $this->load->view('admin/sidebar_admin');
    //     $this->load->view('admin/header_admin', $data);
    //     $this->load->view('admin/mailbox');
    //     $this->load->view('admin/foot_admin');
    // }

    public function logoutt()
    {
        session_destroy();
        header("location: " . base_url());
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('welcome'));
    }

    // public function data_penghuni()
    // {
    //     $idadmin = $this->session->userdata('id_admin');
    //     $where = array('id_admin' => $idadmin);
    //     $data['nama'] = $this->M_All->view_where('admin', $where)->row();
    //     // $data['result'] = $this->M_All->join_transaksi('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos')->result();
    //     $data['result'] = $this->M_All->get('pencari_kos')->result();
    //     $this->load->view('admin/sidebar_admin');
    //     $this->load->view('admin/header_admin', $data);
    //     $this->load->view('admin/data_penghuni', $data);
    //     $this->load->view('admin/foot_admin');
    // }

    public function data_kos()
    {

        $tipe_kos = $this->input->post('tipe_kos');
        $bulan = $this->input->post('bulan');

        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();

        // $sql="SELECT * FROM kosan";
        // $data['result']=$this->conn->query($sql);

        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $data['bulan'] = $months;

        // // $data['nama_bulan'] = "";
        // if ($bulan == 0) {
        //     $bulan = date('m');

        // } else {
        //     $bulan = $bulan;
        //     // $data['nama_bulan'] = $months[$bulan - 1];
        // }

        // $data['nama_bulan'] = $months[$bulan - 1];

        //

        // $data['result'] = "";

        $where = [];
        $data['result'] = "";

        if (is_null($bulan) && is_null($tipe_kos) || $bulan == "" && $tipe_kos == "") {
            $data['result'] = $this->M_All->getDataKos()->result();
        } elseif (!is_null($tipe_kos) && $bulan == "") {

            $where = [
                'jenis_kosan' => $tipe_kos,
            ];

            $data['result'] = $this->M_All->getDataKos($where)->result();
        } elseif ($tipe_kos == "" && !is_null($bulan)) {
            // var_dump($bulan);die();

            $where = [
                'MONTH(tanggal_daftar)' => $bulan,
            ];

            $data['result'] = $this->M_All->getDataKos($where)->result();
        } else {
            $where = [
                'MONTH(tanggal_daftar)' => $bulan,
                'jenis_kosan' => $tipe_kos,
            ];

            $data['result'] = $this->M_All->getDataKos($where)->result();
        }

        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/data_kos', $data);
        $this->load->view('admin/foot_admin');
    }

    public function data_pemilik($id = '')
    {
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();

        $data['result'] = $this->M_All->join_pemilik_user()->result();

        if ($id == '') {

            $this->load->view('admin/sidebar_admin');
            $this->load->view('admin/header_admin', $data);
            $this->load->view('admin/data_pemilik', $data);
            $this->load->view('admin/foot_admin');
        } else {

            $this->load->view('admin/data_pemilik', $data);
        }
    }

    public function list_kosan_pemilik($id_pemilik)
    {

        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();

        // $data['result'] = $this->M_All->join_pemilik_user()->result();

        $data['kosan'] = $this->db->get_where('kosan', ['id_pemilik' => $id_pemilik])->result();
        $data['data_pemilik'] = $this->db->get_where('pemilik_kos', ['id_pemilik' => $id_pemilik])->row_array();

        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/list_kosan_pemilik', $data);
        $this->load->view('admin/foot_admin');
    }

    public function edit_pemilik($id = '')
    {
        $where_ = array('id_pemilik' => $id);
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        $data['result'] = $this->M_All->view_where('pemilik_kos', $where_)->row();
        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/edit_pemilik', $data);
        $this->load->view('admin/foot_admin');
    }

    public function update_pemilik()
    {
        $where = array('id_pemilik' => $this->input->post('id_pemilik'));
        $data = array(
            'nama_pemilik' => $this->input->post('nama_pemilik'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'no_rek' => $this->input->post('no_rek'),
            'atas_nama_rek' => $this->input->post('atas_nama_rek'),
            'bank' => $this->input->post('bank'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        );
        $this->M_All->update('pemilik_kos', $where, $data);
        redirect('admin/data_pemilik');
    }

    public function transaksi($id = '')
    {
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        // $data['result'] = $this->M_All->join_transaksi('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos')->result();
        $data['result'] = $this->M_All->get_all_transaksi()->result();

        if ($id == '') {

            $this->load->view('admin/sidebar_admin');
            $this->load->view('admin/header_admin', $data);
            $this->load->view('admin/transaksi', $data);
            $this->load->view('admin/foot_admin');
        } else {
            $this->load->view('admin/transaksi', $data);
        }
    }

    public function edit_transaksi()
    {
        $where = array('id_pesan' => $this->input->post('id_pesan'));
        $data = array(
            'total_bayar' => $this->input->post('total_bayar'),
            'tgl_bayar' => $this->input->post('tgl_bayar'),
            'tgl_masuk' => $this->input->post('tgl_masukr'),
            'tgl_keluar' => $this->input->post('tgl_keluar'),
            'sisa_pembayaran' => $this->input->post('sisa_pembayaran'),
        );
        $this->M_All->update('pemesanan', $where, $data);
        redirect('admin/transaksi');
    }

    public function hapus_transaksi($id)
    {
        $where = array('id_pesan' => $id);
        $this->M_All->delete($where, 'pemesanan');
        redirect('admin/transaksi');
    }

    public function artikel()
    {
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        $data['result'] = $this->M_All->get('artikel')->result();
        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/artikel', $data);
        $this->load->view('admin/foot_admin');
    }

    public function edit_artikel($id = '')
    {
        $where_ = array('id_artikel' => $id);
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        $data['result'] = $this->M_All->view_where('artikel', $where_)->row();
        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/edit_artikel', $data);
        $this->load->view('admin/foot_admin');
    }

    public function update_artikel($value = '')
    {
        $where = array('id_artikel' => $this->input->post('id_artikel'));
        $data = array(
            'judul' => $this->input->post('judul'),
            'kategori_artikel' => $this->input->post('kategori_artikel'),
            'deskripsi' => $this->input->post('deskripsi'),
        );
        $this->M_All->update('artikel', $where, $data);
        redirect('admin/artikel');
    }

    public function tambah_artikel()
    {
        $config['upload_path'] = './asset_admin/artikel/';
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size']             = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
            echo "<script> alert('Foto Artikel Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
            $judul = $this->input->post('judul_artikel');
            $kategori_artikel = $this->input->post('kategori_artikel');
            $deskripsi = $this->input->post('deskripsi_artikel');
            $foto = $this->upload->data('file_name');

            $data = array(
                'judul' => $judul,
                'kategori_artikel' => $kategori_artikel,
                'deskripsi' => $deskripsi,
                'tgl_upload' => date('Y-m-d'),
                'tgl_ubah' => date('Y-m-d'),
                'foto' => $foto,
                'id_admin' => $this->session->userdata('id_admin'),
            );
            if ($this->M_All->insert('artikel', $data) != true) {
                redirect('admin/artikel');
                // echo "<script> alert('Data Artikel berhasil ditambah');</script>";
            } else {
                redirect('admin/artikel');
                echo "<script> alert('Data Artikel gagal ditambah');</script>";
            }
        }
    }

    public function edit_kos($id = '')
    {
        $where_ = array('kode_kos' => $id);
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        $data['kos'] = $this->M_All->view_where('kosan', $where_)->row();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_kos', '', 'required', [
            'required' => 'Nama Kos tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamat', '', 'required', [
            'required' => 'Alamat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi', '', 'required', [
            'required' => 'Deskripsi tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/sidebar_admin');
            $this->load->view('admin/header_admin', $data);
            $this->load->view('admin/edit_kos', $data);
            $this->load->view('admin/foot_admin');
        } else {
            $where = array('kode_kos' => $this->input->post('kode_kos'));
            $data = array(
                'nama_kos' => $this->input->post('nama_kos'),
                'alamat' => $this->input->post('alamat'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $this->M_All->update('kosan', $where, $data);
            redirect('admin/data_kos');
        }
    }

    public function update_kos()
    {
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('nama_kos', '', 'required', [
        //     'required' => 'Nama Kos tidak boleh kosong'
        // ]);
        // $this->form_validation->set_rules('alamat', '', 'required', [
        //     'required' => 'Alamat tidak boleh kosong'
        // ]);
        // $this->form_validation->set_rules('deskripsi', '', 'required', [
        //     'required' => 'Deskripsi tidak boleh kosong'
        // ]);
        // if ($this->form_validation->run() == false) {
        //     $this->edit_kos();
        // } else {
        //     $where = array('kode_kos' => $this->input->post('kode_kos'));
        //     $data = array(
        //         'nama_kos' => $this->input->post('nama_kos'),
        //         'alamat' => $this->input->post('alamat'),
        //         'deskripsi' => $this->input->post('deskripsi'),
        //     );
        //     $this->M_All->update('kosan', $where, $data);
        //     redirect('admin/data_kos');
        // }
    }

    public function hapus_pemilik($id)
    {
        $where = array('id_pemilik' => $id);
        $this->M_All->delete($where, 'pemilik_kos');
        redirect('admin/data_pemilik');
    }

    public function hapus_artikel($id)
    {
        $where = array('id_artikel' => $id);
        $this->M_All->delete($where, 'artikel');
        redirect('admin/artikel');
    }

    public function hapus_kos($id = '')
    {
        $where = array('kode_kos' => $id);
        $this->M_All->delete($where, 'kosan');
        redirect('admin/data_kos');
    }

    public function update_pencari()
    {
        $where = array('id_pencari' => $this->input->post('id_pencari'));
        $data = array(
            'nama_pencari' => $this->input->post('nama_pencari'),
            'no_telp' => $this->input->post('no_telp'),
            'email' => $this->input->post('email'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'status' => $this->input->post('status'),
            'no_telp_wali' => $this->input->post('no_telp_wali'),
        );
        $this->M_All->update('pencari_kos', $where, $data);
        redirect('admin/data_penghuni');
    }

    public function edit_penghuni($id = '')
    {
        $where_ = array('id_pencari' => $id);
        $idadmin = $this->session->userdata('id_admin');
        $where = array('id_admin' => $idadmin);
        $data['nama'] = $this->M_All->view_where('admin', $where)->row();
        $data['result'] = $this->M_All->view_where('pencari_kos', $where_)->row();
        $this->load->view('admin/sidebar_admin');
        $this->load->view('admin/header_admin', $data);
        $this->load->view('admin/edit_penghuni', $data);
        $this->load->view('admin/foot_admin');
    }

    public function hapus_penghuni($id = '')
    {
        $where = array('id_pencari' => $id);
        $this->M_All->delete($where, 'pencari_kos');
        redirect('admin/data_penghuni');
    }

    public function terima_pendaftaran($id_pemilik)
    {

        $data = [
            'status_aktif_pemilik' => 1,
        ];

        $this->M_All->update('user', array('id_user' => $id_pemilik), $data);

        $data_pemilik = $this->db->get_where('pemilik_kos', ['id_user' => $id_pemilik])->row_array();

        $email_pemilik = $data_pemilik['email'];

        // var_dump($email_pemilik);die();
        $this->_sendEmail($email_pemilik, 'diterima');

        $alert = $this->toast('success', '4bf542', 'Berhasil Melakukan Aktivasi Akun Pemilik, Email Berhasil Dikirim ke Email Pendaftar!', 'fas fa-check-circle');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Akun pemilik berhasil diaktifkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

        redirect('admin/data_pemilik');
    }

    private function _sendEmail($email, $type, $alasan = "")
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
        $this->email->from('asdas@gmail.com', 'Admin Koala Kos');
        $this->email->to($email);

        if ($type == 'diterima') {

            $this->email->subject('Berhasil Mengaktifkan Akun');
            $this->email->message('Klik tatutan ini untuk login : <a href="' . base_url() . 'welcome/login_pemilik' . '">Login</a>');
        } else if ($type == 'ditolak') {

            $this->email->subject('Proses Pendaftaran Anda Ditolak');
            $this->email->message('Alasan Penolakan = ' . $alasan . ' <br> Klik tatutan ini untuk daftar lagi : <a href="' . base_url() . 'welcome/registrasi_pemilik' . '">Activate</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function tolak_pendaftaran()
    {
        $id_pemilik = $this->input->post('id_pemilik');
        $alasan = $this->input->post('alasan');

        $data = [
            'status_aktif_pemilik' => 2,
        ];

        $data_pemilik = $this->db->get_where('pemilik_kos', ['id_pemilik' => $id_pemilik])->row_array();

        $this->M_All->update('user', array('id_user' => $data_pemilik['id_user']), $data);

        $email_pemilik = $data_pemilik['email'];

        // var_dump($email_pemilik);die();
        $this->_sendEmail($email_pemilik, 'ditolak', $alasan);

        $alert = $this->toast('success', '4bf542', 'Berhasil Melakukan Penolakan Akun Pemilik, Info Telah Dikirim ke Email Pendaftar', 'fas fa-check-circle');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Akun pemilik ditolak dengan memberikan alasan penolakan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');

        redirect('admin/data_pemilik');
    }

    public function toast($tipe_warna_judul, $warna_icon, $pesan, $icon)
    {

        $alert = '

		<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #' . $warna_icon . '; margin-right: 10px;">
					<i class="' . $icon . '"></i>
				</span>
				<strong class="mr-auto text-' . $tipe_warna_judul . '">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				' . $pesan . '
			</div>
		</div>

		';

        return $alert;
    }

    public function bukti_pelunasan($id_pesan)
    {

        $bukti_lunas = $this->db
            ->get_where('pelunasan', [
                'id_pesan' => $id_pesan,
            ])
            ->row_array();

        if ($bukti_lunas > 0) {

            $filename = $bukti_lunas['bukti_pelunasan'];

            // var_dump($filename);

            $back_dir = "asset_admin/bukti_bayar/";
            $file = $back_dir . $filename;

            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);

                exit;
            } else {
                $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
                header("location:index.php");
            }
        } else {

            $this->session->set_flashdata('alert', '

			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #EE2A00; margin-right: 10px;">
					<i class="fas fa-times-circle"></i>
				</span>
				<strong class="mr-auto text-danger">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				Mohon maaf, pemesan belum melakukan pelunasan <span style="font-size: 1em; color: #EE2A00;">
					<i class="fas fa-frown"></i>
				</span>
			</div>
		</div>


			');

            redirect('admin/transaksi/');
        }

        // var_dump($bukti_lunas['id_pesan']);
    }
}