<?php
// session_start();

defined('BASEPATH') or exit('No direct script access allowed');

class Pemilik extends CI_Controller
{
    // private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_All');

        // var_dump($this->session->userdata('id_pemilik'));die();

        if ($this->session->userdata('pemilik') != "pemilik" || is_null($this->session->userdata('id_pemilik'))) {

            $this->session->unset_userdata('pemilik');
            $this->session->unset_userdata('id_pemilik');

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			<strong>Maaf</strong> Akun anda telah expired.
			  </div>');

            redirect('welcome/login_pemilik');

        }

        $data_pemilik = $this->db->get_where('pemilik_kos', ['id_pemilik' => $this->session->id_pemilik])->row_array();

        $tgl1 = $data_pemilik['tgl_daftar']; // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

        if (date('Y-m-d') > $tgl2) {

            $data_upd = [
                'status_aktif_pemilik' => 0,
            ];

            $where_upd = [
                'id_user' => $data_pemilik['id_user'],
            ];

            $this->db->update('user', $data_upd, $where_upd);

            redirect('pemilik/logout');

        }

        // var_dump($this->session->userdata('id_pemilik'));die();
    }

    public function getNotif()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('notifikasi', array('id_notifikasi' => $id))->row();
        echo json_encode($data);
    }

    public function notifDibaca()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status_baca');

        $this->db->set('status_baca', $status);
        $this->db->where('id_notifikasi', $id);
        $this->db->update('notifikasi');
    }

    public function index($param1 = null)
    {
        $total_transaksi = $this->M_All->count('pemesanan');
        $where_ = array('id_pesan' => 0, 'pemilik_kos.id_pemilik' => $this->session->userdata('id_pemilik'));
        $yang_belum = $this->M_All->join_get_bayar_($where_);
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
        $id_pemilik = $this->session->userdata('id_pemilik');

        $kode_kos = "";
        $data['nama_kosan'] = "";
        $cek = $this->M_All->getPemesanan()->result();
        if (!$cek) {
            $data['nama_kosan'] = " ";
        } else {
            if (is_null($param1)) {
                $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
                if (!$k_kos) {
                    $kode_kos = "tidak ada";
                    $data['nama_kosan'] = " tidak ada";
                } else {
                    $kode_kos = $k_kos['kode_kos'];
                    $data['nama_kosan'] = $k_kos['nama_kos'];
                }
            } else {
                $kode_kos = urldecode($param1);
                $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $kode_kos))->row_array();
                $data['nama_kosan'] = $nama_kosss['nama_kos'];
            }
        }

        $data['count_transaksi'] = $this->M_All->getCountTransaksi($kode_kos);
        $data['count_penghuni'] = $this->M_All->getCountPenghuni($kode_kos);

        $data['transaksi_selesai'] = $this->M_All->get_transaksi_selesai($kode_kos);
        $data['transaksi_proses'] = $this->M_All->get_transaksi_proses($kode_kos);

        $sesi_nama_kost = $this->session->userdata('nama_kost');

        // $this->session->set_userdata('kode_kos', 'ekos121');

        if (is_null($sesi_nama_kost)) {
            $where = array('id_pemilik' => $id_pemilik);
        } else {
            $where = array(
                'id_pemilik' => $id_pemilik,
                'kode_kos' => urldecode($sesi_nama_kost),
            );
        }

        // $data['jumlah_orang'] = $this->M_All->count('pencari_kos');
        $data['jumlah_orang'] = 0;

        $where_kamar_kosong = [
            'id_pemilik' => $id_pemilik,
            'status' => 'Tersedia',
            'kamar.kode_kos' => $kode_kos,
        ];

        $data['jumlah_kamar'] = $this->M_All->count_('kamar', $where_kamar_kosong);

        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();

        // pemilik

        $wherePemilik = [
            'id_pemilik' => $this->session->userdata('id_pemilik'),
        ];

        $data_pemilik = $this->M_All->get_where('pemilik_kos', $wherePemilik)->row_array();

        $id_pemilik1 = $data_pemilik['id_user'];

        $where_notif = array(
            'untuk' => $id_pemilik1,
            'status_baca' => 0,
        );

        $data['jml_notif'] = $this->M_All->count_where('notifikasi', $where_notif);

        $data['notif'] =
        $this->db->order_by('id_notifikasi', 'DESC')->limit(5)->get_where('notifikasi', [
            'untuk' => $id_pemilik1,
        ])->result();
        // sampe sini

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        // $tgl1 = $data['nama']->tgl_daftar; // pendefinisian tanggal awal
        // $tgl2 = date('Y-m-d', strtotime('+3 days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari

        // if (date('Y-m-d') > $tgl2) {

        //     $data_upd = [
        //         'status_aktif_pemilik' => 1,
        //     ];

        //     $where_upd = [
        //         'id_user' => $data['nama']->id_user,
        //     ];

        //     $this->db->update('user', $data_upd, $where_upd);

        // }

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/dashboard', $data);
        $this->load->view('pemilik/foot_pemilik');
        $this->load->view('graph/jumlah_penghuni');
        $this->load->view('graph/jumlah_transaksi');
    }

    public function edit_pw()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password_baru', 'Password baru', 'min_length[6]|required|matches[konfirmasi]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Password terlalu pendek',
            'matches' => 'Password tidak cocok',
        ]);

        $this->form_validation->set_rules('konfirmasi', 'Ulangi Password', 'min_length[6]|required|matches[password_baru]', [
            'required' => 'Confirm Password tidak boleh kosong',
            'min_length' => ' Password terlalu pendek',
            'matches' => ' Password tidak cocok',
        ]);

        if ($this->form_validation->run() == false) {

            redirect('pemilik/profile');
        } else {
            $this->updatePw();
        }

    }

    public function profile()
    {

        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();

        // var_dump($data['nama']);die();

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/profile', $data);
        $this->load->view('pemilik/foot_pemilik');

    }

    public function updatePw()
    {

        $id_user = $this->db->get_where('pemilik_kos', ['id_pemilik' => $this->session->userdata('id_pemilik')])->row_array();

        $password_baru = md5($this->input->post('password_baru'));

        $data = [
            'password' => $password_baru,
        ];

        $where = [
            'id_user' => $id_user['id_user'],
        ];

        $this->db->update('user', $data, $where);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Holy guacamole!</strong> You should check in on some of those fields below.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');

        redirect('pemilik/profile');

    }

    public function booking($param1 = null)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');

        $kode_kos = "";
        $data_['nama_kosan'] = "";
        $cek = $this->M_All->getPemesanan()->result();
        if (!$cek) {
            $data['nama_kosan'] = " ";
        } else {
            if (is_null($param1)) {
                $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
                if (!$k_kos) {
                    $kode_kos = "tidak ada";
                    $data['nama_kosan'] = " tidak ada";
                } else {
                    $kode_kos = $k_kos['kode_kos'];
                    $data['nama_kosan'] = $k_kos['nama_kos'];
                }
            } else {
                $kode_kos = urldecode($param1);
                $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $kode_kos))->row_array();
                $data['nama_kosan'] = $nama_kosss['nama_kos'];
            }
        }
        // $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('pemilik_kos.id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();

        $data_['result'] = $this->M_All->riwayat_transaksi2('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos', $id_pemilik, 'riwayat', $kode_kos)->result();

        $data['nav1'] = 'active';
        $data['nav2'] = '';

        $data_['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/booking', $data_);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function booking_pesanan($param1 = null)
    {

        $id_pemilik = $this->session->userdata('id_pemilik');

        $kode_kos = "";
        $cek = $this->M_All->getPemesanan()->result();
        if (!$cek) {
            $data['nama_kosan'] = " ";
        } else {
            if (is_null($param1)) {
                $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
                if (!$k_kos) {
                    $kode_kos = "tidak ada";
                    $data['nama_kosan'] = " tidak ada";
                } else {
                    $kode_kos = $k_kos['kode_kos'];
                    $data['nama_kosan'] = $k_kos['nama_kos'];
                }
            } else {
                $kode_kos = urldecode($param1);
                $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $kode_kos))->row_array();
                $data['nama_kosan'] = $nama_kosss['nama_kos'];
            }
        }

        // $id_pemilik = $this->session->userdata('id_pemilik');

        $where = array('untuk' => $id_pemilik);
        $data = array('status_baca' => 1);
        $this->M_All->update('notifikasi', $where, $data);

        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('pemilik_kos.id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data_['result'] = $this->M_All->riwayat_transaksi('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos', $id_pemilik, 'info', $kode_kos)->result();

        // var_dump($data_['result']);die();

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        $data['nav1'] = '';
        $data['nav2'] = 'active';

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/booking', $data_);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function proses_booking($id)
    {
        $where = array('id_pesan' => $id);
        $data = array('status_transaksi' => 1);
        $this->M_All->update('pemesanan', $where, $data);
        redirect('pemilik/booking');
    }

    public function data_tamu()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('pemilik_kos.id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['result'] = $this->M_All->join_transaksi_('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos', $where_)->result();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/data_tamu', $data);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function penghuni_kost($param1 = null)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);

        $kode_kos = "";
        $cek = $this->M_All->getPemesanan()->result();
        if (!$cek) {
            $data['nama_kosan'] = " ";
        } else {
            if (is_null($param1)) {
                $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
                if (!$k_kos) {
                    $kode_kos = "tidak ada";
                    $data['nama_kosan'] = " tidak ada";
                } else {
                    $kode_kos = $k_kos['kode_kos'];
                    $data['nama_kosan'] = $k_kos['nama_kos'];
                }
            } else {
                $kode_kos = urldecode($param1);
                $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $kode_kos))->row_array();
                $data['nama_kosan'] = $nama_kosss['nama_kos'];
            }
        }

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        $where_ = array(
            'pemilik_kos.id_pemilik' => $id_pemilik,
            'status_transaksi' => 2,
            'kamar.kode_kos' => $kode_kos,
        );

        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['result'] = $this->M_All->join_('pemesanan', 'kamar', 'kosan', 'pemilik_kos', $where_)->result();
        // print_r($data);

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/penghuni_kost', $data);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function pemasukan($id_kos = null, $bulan = 0, $year_pmsk = 0)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array(
            'pemilik_kos.id_pemilik' => $id_pemilik,
            // 'status_transaksi' => 2,
        );
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        // $data['result'] = $this->M_All->get_where('pemesanan', array(''));

        $bulan_count = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $data['bulan'] = $bulan_count;

        $kode_kos = "";
        $cek = $this->M_All->getPemesanan()->result();

        // var_dump($cek);die();

        if (!$cek) {
            $data['nama_kosan'] = " ";
        } else {
            if (is_null($id_kos)) {
                $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
                if (!$k_kos) {
                    $kode_kos = "tidak ada";
                    $data['nama_kosan'] = " tidak ada";
                } else {
                    $kode_kos = $k_kos['kode_kos'];
                    $data['nama_kosan'] = $k_kos['nama_kos'];
                }
            } else {
                $kode_kos = urldecode($id_kos);
                $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $kode_kos))->row_array();
                $data['nama_kosan'] = $nama_kosss['nama_kos'];
            }
        }

        $bulan_angka = 0;
        if ($bulan == 0) {
            $bulan_angka = date('m');
        } else {
            $bulan_angka = $bulan;
        }

        $tahun = [2020, 2021, 2022, 2023];

        $data['thn'] = $tahun;

        if ($year_pmsk == 0) {
            $where_ = array(
                'pemilik_kos.id_pemilik' => $id_pemilik,
                // 'status_transaksi' => 2,
                'kamar.kode_kos' => $kode_kos,
                // 'MONTH(pelunasan.tanggal)' => $bulan_angka,
                'MONTH(tanggal_pesan)' => $bulan_angka,
            );
        } else {
            $where_ = array(
                'pemilik_kos.id_pemilik' => $id_pemilik,
                // 'status_transaksi' => 2,
                'kamar.kode_kos' => $kode_kos,
                // 'MONTH(pelunasan.tanggal)' => $bulan_angka,
                'YEAR(tanggal_pesan)' => $year_pmsk,
            );
        }

        // $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['result'] = $this->M_All->join_pelunasan('pemesanan', 'kamar', 'kosan', 'pemilik_kos', $where_)->result();

        $data['kode_kosss'] = $kode_kos;

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        $data['pemasukann'] = $this->M_All->getPemasukanPerBulan($kode_kos);

        // print_r($data);
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/pemasukan', $data);
        $this->load->view('pemilik/foot_pemilik');
        $this->load->view('graph/graph_pemasukan', $data);
    }

    public function view_data_kos()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['result'] = $this->M_All->view_where('kosan', $where)->result();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/data_kos', $data);
        $this->load->view('pemilik/foot_pemilik');
    }
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

    public function input_data_kos()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/input_data_kos');
        $this->load->view('pemilik/foot_pemilik');
    }

    public function insert_data_kos()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_kos', 'Nama Kos', 'required', [
            'required' => 'Nama Kos tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('luas_kamar', 'Luas Kamar', 'required', [
            'required' => 'Luas Kamar tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('listrik', 'Listrik', 'required', [
            'required' => 'Keterangan tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required', [
            'required' => 'Deskripsi tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jenis_kosan', 'jenis_kosan', 'required', [
            'required' => 'Jenis Kosan tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $id_pemilik = $this->session->userdata('id_pemilik');
            $where = array('id_pemilik' => $id_pemilik);
            $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
            $this->load->view('pemilik/sidebar_pemilik');
            $this->load->view('pemilik/header_pemilik', $data);
            $this->load->view('pemilik/input_data_kos');
            $this->load->view('pemilik/foot_pemilik');
        } else {

            // $this->load->view('upload_success', $data);
            $nama_kos = $this->input->post('nama_kos');
            $karakter = '123456789';
            $string = '';
            for ($i = 0; $i < 4; $i++) {
                $pos = rand(0, strlen($karakter) - 1);
                $string .= $karakter[$pos];
            }
            $kode_kos = substr($nama_kos, 1, 4) . $string;
            $alamat = $this->input->post('alamat');

            $luas_kamar = $this->input->post('luas_kamar');
            $listrik = $this->input->post('listrik');

            $deskripsi = $this->input->post('deskripsi');
            $jenis_kosan = $this->input->post('jenis_kosan');

            $data = array(
                'kode_kos' => urldecode($kode_kos),
                'nama_kos' => $nama_kos,
                'alamat' => $alamat,
                'deskripsi' => "Luas kamar ini adalah " . $luas_kamar . ". Untuk tegangan listrik yaitu " . $listrik . ". Deskrip lainnya berupa, " . $deskripsi,
                'jenis_kosan' => $jenis_kosan,
                'saldo_kos' => 0,
                'id_pemilik' => $this->session->userdata('id_pemilik'),
            );

            $this->uploadFotoKos($data['kode_kos']);

            if ($this->M_All->insert('kosan', $data) != true) {
                $this->session->set_flashdata('berhasil_kos', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil ditambahkan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('pemilik/view_data_kos');
            } else {
                redirect('pemilik/input_data_kos');
                echo "<script> alert('Data Kos gagal ditambah');</script>";
            }
        }

    }

    public function uploadFotoKos($kode_kos)
    {
        $tempat = $this->input->post('tempat');

        foreach ($tempat as $key => $value) {

            $data = [
                'tempat' => $value,
                'nama_file' => $this->_uploadFile($key),
                'id_kosan' => $kode_kos,
            ];

            $this->db->insert('gambar_kosan', $data);
        }

    }

    private function _uploadFile($key)
    {
        $namaFiles = $_FILES['foto']['name'][$key];
        $ukuranFile = $_FILES['foto']['size'][$key];
        $type = $_FILES['foto']['type'][$key];
        $eror = $_FILES['foto']['error'][$key];

        // $nama_file = str_replace(" ", "_", $namaFiles);
        $tmpName = $_FILES['foto']['tmp_name'][$key];
        // $nama_folder = "assets_user/file_upload/";
        // $file_baru = $nama_folder . basename($nama_file);

        // if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($ukuranFile < 8000000)) {

        //   move_uploaded_file($tmpName, $file_baru);
        //   return $file_baru;
        // }

        // var_dump($namaFiles);die();

        if ($eror === 4) {
            $flahdata = $this->alert('Maaf', 'danger', 'Gagal Mengunggah Gambar!');

            $this->session->set_flashdata('alert', $flahdata);

            // redirect('admin_home/tambah_modul');
            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];

        $ekstensiGambar = explode('.', $namaFiles);
        // var_dump($namaFiles);die();

        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $flahdata = $this->alert('Maaf', 'danger', 'Ada File yang Kamu Upload Bukan Gambar!');

            $this->session->set_flashdata('alert', $flahdata);

            // redirect('admin_home/tambah_modul');
            return false;
        }

        $namaFilesBaru = "foto-";
        $namaFilesBaru .= uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'asset_admin/assets_kosan/foto_kosan/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function alert($kata_depan = "", $warna, $isi)
    {

        $alert = '<div class="alert alert-' . $warna . ' alert-dismissible fade show" role="alert">
		<strong>' . $kata_depan . '</strong> ' . $isi . '
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  	</div>';

        return $alert;
    }

    public function data_kamar()
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        // $this->load->view('pemilik/input_data_kos');
        $this->load->view('pemilik/foot_pemilik');
    }

    public function edit_kos($id)
    {
        $newdat = array(
            'kode_kos' => urldecode($id),
        );
        $this->session->set_userdata($newdat);
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('kode_kos' => urldecode($id));
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['kos'] = $this->M_All->view_where('kosan', $where_)->row();
        $data['result'] = $this->M_All->view_where('kamar', $where_)->result();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_kos', 'Nama Kos', 'required', [
            'required' => 'Nama Kos tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'Alamat tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required', [
            'required' => 'Deskripsi tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('jenis_kosan', 'jenis_kosan', 'required', [
            'required' => 'Jenis Kosan tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('pemilik/sidebar_pemilik');
            $this->load->view('pemilik/header_pemilik', $data);
            $this->load->view('pemilik/view_data_kos', $data);
            $this->load->view('pemilik/foot_pemilik');
        } else {
            $config['upload_path'] = './asset_admin/upload_kos/';
            $config['overwrite'] = true;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $where = array('kode_kos' => urldecode($this->input->post('kode_kos')));
                $data = array(
                    'nama_kos' => $this->input->post('nama_kos'),
                    'alamat' => $this->input->post('alamat'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'saldo_kos' => $this->input->post('saldo_kos'),
                );
                $this->M_All->update('kosan', $where, $data);
                $this->session->set_flashdata('berhasil_kos', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di update
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('pemilik/view_data_kos');
            } else {
                $where = array('kode_kos' => urldecode($this->input->post('kode_kos')));
                $foto = $this->upload->data('file_name');
                $data = array(
                    'nama_kos' => $this->input->post('nama_kos'),
                    'alamat' => $this->input->post('alamat'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'saldo_kos' => $this->input->post('saldo_kos'),
                    'foto' => $foto,
                );
                $this->M_All->update('kosan', $where, $data);
                $this->session->set_flashdata('berhasil_kos', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di update
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('pemilik/view_data_kos');
            }
        }
    }

    public function update_kos()
    {
        // $upload_image = $_FILES['foto']['name'];
        // if ($upload_image) {

        // }

        // $where = array('kode_kos' => urldecode($this->input->post('kode_kos')));
        // $data = array(
        //     'nama_kos' => $this->input->post('nama_kos'),
        //     'alamat' => $this->input->post('alamat'),
        //     'deskripsi' => $this->input->post('deskripsi'),
        //     'saldo_kos' => $this->input->post('saldo_kos'),
        // );
        // $this->M_All->update('kosan', $where, $data);
        // redirect('pemilik/view_data_kos');
    }

    public function hapus_kos($id)
    {

        $where = array('kode_kos' => urldecode($id));

        $this->M_All->delete($where, 'kosan');
        redirect('pemilik/view_data_kos');
    }

    public function tambah_kamar()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kode_kamar', 'Kode Kamar', 'required', [
            'required' => 'Kode Kamar tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('harga_smesteran', '', 'required', [
            'required' => 'Harga 6 Bulan tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('harga', '', 'required', [
            'required' => 'Harga 1 Tahun tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('deskripsi', '', 'required', [
            'required' => 'Deskripsi tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('status', '', 'required', [
            'required' => 'status tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tgl_tersedia', '', 'required', [
            'required' => 'Tanggal tersedia tidak boleh kosong',
        ]);
        if ($this->form_validation->run() == false) {
            $this->view_data_kos();
        } else {
            $config['upload_path'] = './asset_admin/upload_kos/';
            $config['overwrite'] = true;
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size']             = 1024;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                // $this->load->view('upload_form', $error);
                $this->session->set_flashdata('foto', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Foto tidak boleh kosong
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('pemilik/view_data_kos');
            } else {
                $data = array('upload_data' => $this->upload->data());
                // $this->load->view('upload_success', $data);
                $kode_kamar = $this->input->post('kode_kamar');
                $harga = $this->input->post('harga');
                $harga_smesteran = $this->input->post('harga_smesteran');
                $deskripsi = $this->input->post('deskripsi');
                $status = $this->input->post('status');
                $tanggal_tersedia = $this->input->post('tgl_tersedia');
                $foto = $this->upload->data('file_name');

                $data = array(
                    'kode_kamar' => $kode_kamar,
                    'kode_kos' => urldecode($this->session->userdata('kode_kos')),
                    'harga' => $harga,
                    'harga_smesteran' => $harga_smesteran,
                    'deskripsi' => $deskripsi,
                    'status' => $status,
                    'foto' => $foto,
                    'tgl_tersedia' => $tanggal_tersedia,
                );
                if ($this->M_All->insert('kamar', $data) != true) {
                    redirect('pemilik/edit_kos/' . $this->session->userdata('kode_kos'));
                    echo "<script> alert('Data Kos berhasil ditambah');</script>";
                    $this->session->set_flashdata('alert', '
                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
                style="position: fixed; top: 0; right: 0;">
                <div class="toast-header">
                    <span style="font-size: 1.5em; color: #EE2A00; margin-right: 10px;">
                        <i class="fas fa-times-circle"></i>
                    </span>
                    <strong class="mr-auto text-success">Perhatian!</strong>
                    <small>Baru saja</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Kamar ditambahkan <span style="font-size: 1em; color: #EE2A00;">
                        <i class="fas fa-frown"></i>
                    </span>
                </div>
                </div>
                ');
                } else {
                    redirect('pemilik/edit_kos/' . $this->session->userdata('kode_kos'));
                    echo "<script> alert('Data Kos gagal ditambah');</script>";
                }
            }
        }
    }

    public function edit_kamar($id)
    {
        $where = array('id_pemilik' => $this->session->userdata('id_pemilik'));
        $where_ = array('id_kamar' => $id);
        $data['kamar'] = $this->M_All->view_where('kamar', $where_)->row();
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/view_kamar', $data);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function update_kamar()
    {
        $where = array('id_kamar' => $this->input->post('id_kamar'));
        $data = array(
            'harga' => $this->input->post('harga'),
            'harga_smesteran' => $this->input->post('harga_smesteran'),
            'deskripsi' => $this->input->post('deskripsi'),
            'status' => $this->input->post('status'),
            'tgl_tersedia' => $this->input->post('tgl_tersedia'),
        );
        $this->M_All->update('kamar', $where, $data);
        $kos = urldecode($this->session->userdata('kode_kos'));

        redirect('pemilik/edit_kos/' . $kos);
    }

    public function hapus_kamar($id)
    {
        $where = array('kode_kamar' => $id);
        $this->M_All->delete($where, 'kamar');
        redirect('pemilik/edit_kos/' . $this->session->userdata('kode_kos'));
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

            redirect('pemilik/booking_pesanan/');
        }

        // var_dump($bukti_lunas['id_pesan']);
    }

    public function proses_pesanan($tipe, $id_pencari, $id, $idkamar = null)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pesan' => $id);
        $status = 0;

        if ($tipe == 'terima') {
            $status = 2;
            $this->kirim_notif("Pesanan Diterima", 'info', $id_pemilik, $id_pencari);
        } elseif ($tipe == 'pelunasan') {
            $status = 1;
            $this->kirim_notif("Silahkan Melakukan Pelunasan", 'pelunasan', $id_pemilik, $id_pencari);
        } else {
            $status = 4;

            $data_update_kamar = [
                'status' => 'Tersedia',
            ];

            $this->db->where('id_kamar', $idkamar);
            $this->db->update('kamar', $data_update_kamar);
        }

        $data = [
            'status_transaksi' => $status,
        ];

        $this->M_All->update('pemesanan', $where, $data);

        if ($tipe == 'terima') {

            $id_pencari = $this->db
                ->get_where('pemesanan', [
                    'id_pesan' => $id,
                ])
                ->row_array();

            // $data_notif = [

            //     'isi_pesan' => 'Pesanan anda diterima!',
            //     'dari' => $id_pemilik,
            //     'untuk' => $id_pencari['id_pencari'],
            //     'status_baca' => 0,
            // ];

            // $this->M_All->insert('notifikasi', $data_notif);

            $this->session->set_flashdata('alert', '

		<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #06DC19; margin-right: 10px;">
					<i class="fas fa-check-circle"></i>
				</span>
				<strong class="mr-auto text-success">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				Pemesanan berhasil diterima <span style="font-size: 1em; color: #06DC19;">
					<i class="fas fa-smile"></i>
				</span>
			</div>
		</div>

		');
            if ($tipe == 'terima') {

                $id_pencari = $this->db
                    ->get_where('pemesanan', [
                        'id_pesan' => $id,
                    ])
                    ->row_array();

                // $data_notif = [

                //     'isi_pesan' => 'Pesanan anda diterima!',
                //     'dari' => $id_pemilik,
                //     'untuk' => $id_pencari['id_pencari'],
                //     'status_baca' => 0,
                //     'id_pemilik' => $id_pemilik,
                //     'id_pencari' => $id_pencari['id_pencari'],
                // ];

                // $this->M_All->insert('notifikasi', $data_notif);

                $this->session->set_flashdata('alert', '

		<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #06DC19; margin-right: 10px;">
					<i class="fas fa-check-circle"></i>
				</span>
				<strong class="mr-auto text-success">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				Pemesanan berhasil diterima <span style="font-size: 1em; color: #06DC19;">
					<i class="fas fa-smile"></i>
				</span>
			</div>
		</div>

		');
            }
        } elseif ($tipe == 'pelunasan') {

            $id_pencari = $this->db
                ->get_where('pemesanan', [
                    'id_pesan' => $id,
                ])
                ->row_array();

            // $data_notif = [

            //     'isi_pesan' => 'Segera Melakukan Pelunasan!',
            //     'dari' => $id_pemilik,
            //     'untuk' => $id_pencari['id_pencari'],
            //     'status_baca' => 0,
            //     'id_pemilik' => $id_pemilik,
            //     'id_pencari' => $id_pencari['id_pencari'],
            // ];

            // $this->M_All->insert('notifikasi', $data_notif);

            $this->session->set_flashdata('alert', '

		<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mt-5 mr-5" data-autohide="false"
			style="position: fixed; top: 0; right: 0;">
			<div class="toast-header">
				<span style="font-size: 1.5em; color: #06DC19; margin-right: 10px;">
					<i class="fas fa-check-circle"></i>
				</span>
				<strong class="mr-auto text-success">Perhatian!</strong>

				<small>Baru saja</small>
				<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>

			</div>
			<div class="toast-body">
				Pelunasan sedang diproses... <span style="font-size: 1em; color: #06DC19;">
					<i class="fas fa-smile"></i>
				</span>
			</div>
		</div>

		');
        } else {
            $status = 4;
        }

        redirect('pemilik/booking_pesanan/');
    }

    public function update_profile()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_pemilik', '', 'required', [
            'required' => 'Nama Lengkap tidak boleh kosong',
        ]);

        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required', [
            'required' => 'No KTP tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telephone', 'required', [
            'required' => 'No Telephone tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
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
        if ($this->form_validation->run() == false) {
            $this->profile();
        } else {
            $upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                // echo 'upload nih';
                // die;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './asset_registrasi/upload_pemilik/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    // $old_image = $data['user']['image'];
                    $where = array('id_pencari' => $this->input->post('id_pencari'));
                    $new_image = $this->upload->data('file_name');
                    $nama_lengkap = $this->input->post('nama_pemilik');
                    $ktp = $this->input->post('no_ktp');
                    $email = $this->input->post('email');
                    $no_telp = $this->input->post('no_telp');
                    $atas_nama_rek = $this->input->post('atas_nama_rek');
                    $bank = $this->input->post('bank');
                    $no_rek = $this->input->post('no_rek');

                    $data = [
                        'nama_pemilik' => $nama_lengkap,
                        'no_telp' => $no_telp,
                        'email' => $email,
                        'foto' => $new_image,
                        'no_ktp' => $ktp,
                        'no_rek' => $no_rek,
                        'atas_nama_rek' => $atas_nama_rek,
                        'bank' => $bank,
                    ];
                    $where_update = array('id_pemilik' => $this->session->userdata('id_pemilik'));
                    $this->M_All->update('pemilik_kos', $where_update, $data);

                    // $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('foto', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Yang anda pilih bukan gambar atau ukuran gambar terlalu besar
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('pemilik/profile');
                }
            }

            $nama_lengkap = $this->input->post('nama_pemilik');
            $ktp = $this->input->post('no_ktp');
            $email = $this->input->post('email');
            $no_telp = $this->input->post('no_telp');
            $atas_nama_rek = $this->input->post('atas_nama_rek');
            $bank = $this->input->post('bank');
            $no_rek = $this->input->post('no_rek');

            $data = [
                'nama_pemilik' => $nama_lengkap,
                'no_telp' => $no_telp,
                'email' => $email,
                'no_ktp' => $ktp,
                'no_rek' => $no_rek,
                'atas_nama_rek' => $atas_nama_rek,
                'bank' => $bank,
            ];

            $where_update = array('id_pemilik' => $this->session->userdata('id_pemilik'));

            $this->M_All->update('pemilik_kos', $where_update, $data);

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

            redirect('pemilik/profile/');
        }
    }

    public function tolak_pesanan()
    {

        $idpesanan = $this->input->post('idpesanan');
        $idkamar = $this->input->post('idkamar');
        $alasan_penolakan = $this->input->post('alasan_penolakan');
        $id_pencari = $this->input->post('id_pencari');

        $where = [
            'id_pesan' => $idpesanan,
        ];

        $status = 4;

        $data_update_kamar = [
            'status' => 'Tersedia',
        ];

        print_r($this->session->userdata('id_pemilik'));

        $this->db->where('id_kamar', $idkamar);
        $this->db->update('kamar', $data_update_kamar);

        $data = [
            'status_transaksi' => $status,
            'keterangan_pembatalan' => $alasan_penolakan,
        ];

        $wherePemilik = [
            'id_pemilik' => $this->session->userdata('id_pemilik'),
        ];
        $data_pemilik = $this->M_All->get_where('pemilik_kos', $wherePemilik)->row_array();
        $id_pemilik1 = $data_pemilik['id_user'];
        $this->kirim_notif("Pesanan Ditolak", 'info', $id_pemilik1, $id_pencari);

        $this->M_All->update('pemesanan', $where, $data);

        redirect('pemilik/booking');
    }

    public function kirim_notif($pesan, $jenis, $dari, $untuk)
    {
        $data_notif = [
            'isi_pesan' => $pesan,
            'dari' => $dari,
            'untuk' => $untuk,
            'status_baca' => 0,
            'jenis' => $jenis,
        ];

        $this->M_All->insert('notifikasi', $data_notif);
    }

    public function aktivasi_kamar($tipe, $id_kamar = null, $kode_kos = null)
    {

        if ($tipe == 0 && is_null($id_kamar)) {

            $id_kamar = $this->input->post('kode_kamar');
            $alasan = $this->input->post('alasan');
            $kode_kos = $this->input->post('kode_kos');

            $data = [
                'is_aktif' => $tipe,
                'status' => $alasan,
            ];

            $where = ['kode_kamar' => $id_kamar];

            $this->db->update('kamar', $data, $where);

            redirect('pemilik/edit_kos/' . $kode_kos);

        } else {

            $data = [
                'is_aktif' => $tipe,
                'status' => 'Tersedia',
            ];

            $where = ['kode_kamar' => $id_kamar];

            $this->db->update('kamar', $data, $where);

            redirect('pemilik/edit_kos/' . $kode_kos);
        }

        // redirect('')

    }

    public function upload_mou()
    {

        $id_pemilik = $this->session->userdata('id_pemilik');

        // var_dump($id_pemilik);die();

        $data = [
            'file_mou' => $this->_uploadFileMoU(),
            'tanggal_upload_mou' => date('Y-m-d'),
        ];

        $where = [
            'id_pemilik' => $id_pemilik,
        ];

        $this->db->update('pemilik_kos', $data, $where);

        $flahdata = $this->alert('Selamat', 'success', 'MoU Berhasil diunggah');

        $this->session->set_flashdata('form_error', $flahdata);

        redirect('pemilik/profile');

    }

    private function _uploadFileMoU()
    {
        $namaFiles = $_FILES['file_mou']['name'];
        $ukuranFile = $_FILES['file_mou']['size'];
        $type = $_FILES['file_mou']['type'];
        $eror = $_FILES['file_mou']['error'];

        // $nama_file = str_replace(" ", "_", $namaFiles);
        $tmpName = $_FILES['file_mou']['tmp_name'];
        // $nama_folder = "assets_user/file_upload/";
        // $file_baru = $nama_folder . basename($nama_file);

        // if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($ukuranFile < 8000000)) {

        //   move_uploaded_file($tmpName, $file_baru);
        //   return $file_baru;
        // }

        // var_dump($namaFiles);die();

        if ($eror === 4) {
            $flahdata = $this->alert('Maaf', 'danger', 'Gagal Mengunggah Gambar!');

            $this->session->set_flashdata('form_error', $flahdata);

            redirect('pemilik/profile');
            return false;
        }

        $ekstensiGambarValid = ['pdf'];

        $ekstensiGambar = explode('.', $namaFiles);
        // var_dump($namaFiles);die();

        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $flahdata = $this->alert('Maaf', 'danger', 'Ada File yang Kamu Upload Bukan PDF!');

            $this->session->set_flashdata('form_error', $flahdata);

            redirect('pemilik/profile');

            return false;
        }

        $namaFilesBaru = "mou-";
        $namaFilesBaru .= uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'asset_admin/all_mou_pemilik/' . $namaFilesBaru);

        return $namaFilesBaru;
    }
}