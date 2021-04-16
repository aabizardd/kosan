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
        if ($this->session->userdata('pemilik') != "pemilik") {
            redirect(base_url(''));
        }
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
        if (is_null($param1)) {
            $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
            $kode_kos = $k_kos['kode_kos'];
            $data['nama_kosan'] = $k_kos['nama_kos'];
        } else {
            $kode_kos = $param1;
            $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $param1))->row_array();
            $data['nama_kosan'] = $nama_kosss['nama_kos'];
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
                'kode_kos' => $sesi_nama_kost,
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

        $where_notif = array(
            'untuk' => $id_pemilik,
            'status_baca' => 0,
        );

        $data['jml_notif'] = $this->M_All->count_where('notifikasi', $where_notif);
        $data['notif'] = $this->db
            ->get_where('notifikasi', [
                'untuk' => $id_pemilik,
                'status_baca' => 0,
            ])
            ->result();

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/dashboard', $data);
        $this->load->view('pemilik/foot_pemilik');
        $this->load->view('graph/jumlah_penghuni');
        $this->load->view('graph/jumlah_transaksi');
    }

    public function profile()
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
        $where = array('id_pemilik' => $id_pemilik);
        // $data['jumlah_orang'] = $this->M_All->count('pencari_kos');
        $data['jumlah_orang'] = 0;
        $data['jumlah_kamar'] = $this->M_All->count_('kamar', $where);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/profile');
        $this->load->view('pemilik/foot_pemilik');
    }
    public function booking($param1 = null)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');

        $kode_kos = "";
        $data_['nama_kosan'] = "";
        if (is_null($param1)) {
            $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
            $kode_kos = $k_kos['kode_kos'];
            $data_['nama_kosan'] = $k_kos['nama_kos'];
        } else {
            $kode_kos = $param1;
            $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $param1))->row_array();
            $data_['nama_kosan'] = $nama_kosss['nama_kos'];
        }

        // $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('pemilik_kos.id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();

        $data_['result'] = $this->M_All->riwayat_transaksi2('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos', $id_pemilik, 'riwayat', $kode_kos)->result();

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
        if (is_null($param1)) {
            $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
            $kode_kos = $k_kos['kode_kos'];
            $data_['nama_kosan'] = $k_kos['nama_kos'];
        } else {
            $kode_kos = $param1;
            $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $param1))->row_array();
            $data_['nama_kosan'] = $nama_kosss['nama_kos'];
        }

        // $id_pemilik = $this->session->userdata('id_pemilik');

        $where = array('untuk' => $id_pemilik);
        $data = array('status_baca' => 1);
        $this->M_All->update('notifikasi', $where, $data);

        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('pemilik_kos.id_pemilik' => $id_pemilik);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data_['result'] = $this->M_All->riwayat_transaksi('pemesanan', 'kamar', 'kosan', 'pemilik_kos', 'pencari_kos', $id_pemilik, 'info', $kode_kos)->result();

        $data['list_kosan'] = $this->M_All->get_where('kosan', array('id_pemilik' => $id_pemilik))->result();

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
        if (is_null($param1)) {
            $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
            $kode_kos = $k_kos['kode_kos'];
            $data_['nama_kosan'] = $k_kos['nama_kos'];
        } else {
            $kode_kos = $param1;
            $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $param1))->row_array();
            $data_['nama_kosan'] = $nama_kosss['nama_kos'];
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

    public function pemasukan($id_kos = null, $bulan = 0)
    {
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array(
            'pemilik_kos.id_pemilik' => $id_pemilik,
            'status_transaksi' => 2,
        );
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        // $data['result'] = $this->M_All->get_where('pemesanan', array(''));

        $bulan_count = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $data['bulan'] = $bulan_count;

        $kode_kos = "";
        if (is_null($id_kos)) {
            $k_kos = $this->M_All->get_kode_kos($id_pemilik)->row_array();
            $kode_kos = $k_kos['kode_kos'];
            $data['nama_kosan'] = $k_kos['nama_kos'];
        } else {
            $kode_kos = $id_kos;
            $nama_kosss = $this->M_All->get_where('kosan', array('kode_kos' => $id_kos))->row_array();
            $data['nama_kosan'] = $nama_kosss['nama_kos'];
        }

        $bulan_angka = 0;
        if ($bulan == 0) {
            $bulan_angka = date('m');
        } else {
            $bulan_angka = $bulan;
        }

        $where_ = array(
            'pemilik_kos.id_pemilik' => $id_pemilik,
            'status_transaksi' => 2,
            'kamar.kode_kos' => $kode_kos,
            'MONTH(pelunasan.tanggal)' => $bulan_angka,
        );

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
        $config['upload_path'] = './asset_admin/upload_kos/';
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
            echo "<script> alert('Foto Kos Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
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
            $foto = $this->upload->data('file_name');

            $data = array(
                'kode_kos' => $kode_kos,
                'nama_kos' => $nama_kos,
                'alamat' => $alamat,
                'deskripsi' => "Luas kamar ini adalah " . $luas_kamar . ". Untuk tegangan listrik yaitu " . $listrik . ". Deskrip lainnya berupa, " . $deskripsi,
                'foto' => $foto,
                'jenis_kosan' => $jenis_kosan,
                'saldo_kos' => 0,
                'id_pemilik' => $this->session->userdata('id_pemilik'),
            );
            if ($this->M_All->insert('kosan', $data) != true) {
                redirect('pemilik/view_data_kos');
                echo "<script> alert('Data Kos berhasil ditambah');</script>";
            } else {
                redirect('pemilik/input_data_kos');
                echo "<script> alert('Data Kos gagal ditambah');</script>";
            }
        }
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
            'kode_kos' => $id,
        );
        $this->session->set_userdata($newdat);
        $id_pemilik = $this->session->userdata('id_pemilik');
        $where = array('id_pemilik' => $id_pemilik);
        $where_ = array('kode_kos' => $id);
        $data['nama'] = $this->M_All->view_where('pemilik_kos', $where)->row();
        $data['kos'] = $this->M_All->view_where('kosan', $where_)->row();

        $data['result'] = $this->M_All->view_where('kamar', $where_)->result();
        $this->load->view('pemilik/sidebar_pemilik');
        $this->load->view('pemilik/header_pemilik', $data);
        $this->load->view('pemilik/view_data_kos', $data);
        $this->load->view('pemilik/foot_pemilik');
    }

    public function update_kos()
    {
        $where = array('kode_kos' => $this->input->post('kode_kos'));
        $data = array(
            'nama_kos' => $this->input->post('nama_kos'),
            'alamat' => $this->input->post('alamat'),
            'deskripsi' => $this->input->post('deskripsi'),
            'saldo_kos' => $this->input->post('saldo_kos'),
        );
        $this->M_All->update('kosan', $where, $data);
        redirect('pemilik/view_data_kos');
    }

    public function hapus_kos($id)
    {

        $where = array('kode_kos' => $id);

        $this->M_All->delete($where, 'kosan');
        redirect('pemilik/view_data_kos');
    }

    public function tambah_kamar()
    {
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
            echo "<script> alert('Foto Kos Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
            $kode_kamar = $this->input->post('kode_kamar');
            $harga = $this->input->post('harga');
            $deskripsi = $this->input->post('deskripsi');
            $status = $this->input->post('status');
            $tanggal_tersedia = $this->input->post('tgl_tersedia');
            $foto = $this->upload->data('file_name');

            $data = array(
                'kode_kamar' => $kode_kamar,
                'kode_kos' => $this->session->userdata('kode_kos'),
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'status' => $status,
                'foto' => $foto,
                'tgl_tersedia' => $tanggal_tersedia,
            );
            if ($this->M_All->insert('kamar', $data) != true) {
                redirect('pemilik/edit_kos/' . $this->session->userdata('kode_kos'));
                echo "<script> alert('Data Kos berhasil ditambah');</script>";
            } else {
                redirect('pemilik/edit_kos/' . $this->session->userdata('kode_kos'));
                echo "<script> alert('Data Kos gagal ditambah');</script>";
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
        $kos = $this->session->userdata('kode_kos');

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

    public function proses_pesanan($tipe, $id, $idkamar = null)
    {

        $id_pemilik = $this->session->userdata('id_pemilik');

        $where = array('id_pesan' => $id);
        $status = 0;

        if ($tipe == 'terima') {
            $status = 2;
        } elseif ($tipe == 'pelunasan') {
            $status = 1;
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

            $data_notif = [

                'isi_pesan' => 'Pesanan anda diterima!',
                'dari' => $id_pemilik,
                'untuk' => $id_pencari['id_pencari'],
                'status_baca' => 0,
                'id_pemilik' => $id_pemilik,
                'id_pencari' => $id_pencari['id_pencari'],
            ];

            $this->M_All->insert('notifikasi', $data_notif);

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

                $data_notif = [

                    'isi_pesan' => 'Pesanan anda diterima!',
                    'dari' => $id_pemilik,
                    'untuk' => $id_pencari['id_pencari'],
                    'status_baca' => 0,
                    'id_pemilik' => $id_pemilik,
                    'id_pencari' => $id_pencari['id_pencari'],
                ];

                $this->M_All->insert('notifikasi', $data_notif);

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

            $data_notif = [

                'isi_pesan' => 'Segera Melakukan Pelunasan!',
                'dari' => $id_pemilik,
                'untuk' => $id_pencari['id_pencari'],
                'status_baca' => 0,
                'id_pemilik' => $id_pemilik,
                'id_pencari' => $id_pencari['id_pencari'],
            ];

            $this->M_All->insert('notifikasi', $data_notif);

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