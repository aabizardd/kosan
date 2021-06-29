<?php
// session_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Pencari extends CI_Controller
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_All');
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('pencari') != "pencari") {
            redirect(base_url(''));
        }
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

    public function index()
    {
        // $data['artikel'] = $this->M_All->get('artikel')->result();
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['result'] = $this->M_All->join('pemilik_kos', 'kosan')->result();

        $where_notif = array(
            'untuk' => $id_pencari,
            'status_baca' => 0,
        );

        $data['jml_notif'] = $this->M_All->count_where('notifikasi', $where_notif);
        $data['notif'] = $this->M_All->getNotif($id_pencari)->result();

        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/dashboard', $data);
        $this->load->view('pencari/foot_pencari');
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

    public function pencarian()
    {
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['result'] = $this->M_All->get('kosan')->result();
        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/konten', $data);
        $this->load->view('pencari/foot_pencari');
    }

    public function profile()
    {
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['result'] = $this->M_All->get('kosan')->result();
        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/profile', $data);
        $this->load->view('pencari/foot_pencari');
    }
    public function view_data_kos($id, $waktu = null)
    {
        $where_ = array(
            'kode_kos' => $id,
        );

        $where_kosan = array(
            'kode_kos' => $id,
            'status' => 'Tersedia',
        );
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['kos'] = $this->M_All->view_where_join($id)->row();
        $data['result'] = $this->M_All->view_where('kamar', $where_kosan)->result();

        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/pesan_kos', $data);
        $this->load->view('pencari/foot_pencari');
    }

    public function pemesanan()
    {
        $id_pencari = $this->session->userdata('id_pencari');
        $where_nama = array('id_pencari' => $id_pencari);
        $where_rslt = array(
            'id_pencari' => $id_pencari,
            'status_transaksi <>' => 0,
            'status_transaksi <>' => 1,
        );
		

        $data['nama'] = $this->M_All->view_where('pencari_kos', $where_nama)->row();

        $data['result'] = $this->M_All->join_get_bayar($id_pencari, 'riwayat')->result();

        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/pemesanan', $data);
        $this->load->view('pencari/foot_pencari');
    }

    public function pembayaran()
    {
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['result'] = $this->M_All->join_get_bayar($id_pencari, 'info')->result();
        // $data['result'] = $this->M_All->get('pemesanan')->result();
        // $data['rek'] = $this->M_All->join_get_bayar($data['result'][0])->result();
        // print_r($data);

        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/pembayaran', $data);
        $this->load->view('pencari/foot_pencari');
    }

    public function pesan()
    {
        $id_pencari = $this->session->userdata('id_pencari');
        $where = array('id_pencari' => $id_pencari);
        $data['nama'] = $this->M_All->view_where('pencari_kos', $where)->row();
        $data['result'] = $this->M_All->get('pemesanan')->result();

        $this->load->view('pencari/sidebar_pencari');
        $this->load->view('pencari/header_pencari', $data);
        $this->load->view('pencari/about', $data);
        $this->load->view('pencari/foot_pencari');
    }

    public function pesan_kamar()
    {
        // $id_transaksi = $this->M_All->count('pemesanan')+1;
        $id_pencari = $this->session->userdata('id_pencari');

        $getCountBooking = $this->M_All->getCountBooking($id_pencari);

        if ($getCountBooking['ct'] >= 2) {

            redirect('pencari');
        } else {

            $uang_muka = 0;
            $harga = 0;
            $kode_kamar = $this->input->post('kode_kamar');
            $id_pencari = $this->input->post('id_pencari');
            $id_pemilik = $this->M_All->getIdUser($this->input->post('id_pemilik'), $this->input->post('kode_kos'))->result();
            $idUserPencari = $this->M_All->getIdUserPencari($this->input->post('id_pencari'))->result();
            $tgl_masuk = date('Y-m-d', strtotime($this->input->post('tgl_masuk')));

            // var_dump($tgl_masuk);die();

            $nama_penghuni = $this->input->post('nama_penghuni');
            $jangka_waktu = $this->input->post('jangka_waktu');

            // $tgl_keluar = $this->input->post('tgl_keluar');
            // $tgl_keluar = strtotime(date("Y-m-d",strtotime($tgl_masuk)).'1');
            // $tgl_keluar = date($tgl_masuk . " +1year");
            $tgl_keluar = "";

            $get_harga = $this->db
                ->get_where('kamar', [
                    'id_kamar' => $kode_kamar,
                ])
                ->row_array();

            if ($jangka_waktu == "1 Tahun") {
                $waktu = "1 year";
                $harga = $get_harga['harga'];
            } else {
                $waktu = "6 month";
                $harga = $get_harga['harga_smesteran'];
            }

            $tgl_keluar = date('Y-m-d', strtotime($tgl_masuk . ' + ' . $waktu));

            // $selisih =  strtotime($tgl_keluar) - strtotime($tgl_masuk);

            // $selisih_tahun = ceil($selisih / (60 * 60 * 24 * 365));

            $total_bayar = $harga;
            $sisa_bayar = $total_bayar - $uang_muka;

            $data = array(
                // 'id_transaksi' => 'trx00'.$id_transaksi,
                'id_kamar' => $kode_kamar,
                'id_pencari' => $id_pencari,
                'nama_penghuni' => $nama_penghuni,
                'tanggal_masuk' => $tgl_masuk,
                'tanggal_keluar' => $tgl_keluar,
                'jumlah_dp' => $total_bayar - $sisa_bayar,
                'jangka_waktu' => $jangka_waktu,
                'sisa_pembayaran' => $sisa_bayar,
                'status_transaksi' => 5,
            );
            // return print_r($idUserPencari[0]->id_user);

            $this->kirim_notif("Segera Bayar DP untuk kosanmu!", 'pembayaran', $id_pemilik[0]->id_user, $id_pencari);
            // $this->kirim_notif("Segera Bayar DP untuk kosanmu!", $idUserPencari[0]->id_user, $id_pencari);
            // print_r($data);

            $this->M_All->insert('pemesanan', $data);

            // $data_upd = array(
            //     'status' => "Booked",
            // );

            // $where_upd = array('id_kamar' => $kode_kamar);

            // $this->M_All->update('kamar', $where_upd, $data_upd);

            // $data_pemilik = $this->M_All->getPemilikByKamar($kode_kamar)->row_array();

            // $id_pemilik = $data_pemilik['id_user'];

            // $wherePencari = [
            //     'id_pencari' => $this->session->userdata('id_pencari'),
            // ];

            // $data_pencari = $this->M_All->get_where('pencari_kos', $wherePencari)->row_array();

            // $id_pencari = $data_pencari['id_user'];

            // $data_notif = [

            //     'isi_pesan' => 'Ada Pesanan Baru Nih!',
            //     'dari' => $id_pencari,
            //     'untuk' => $id_pemilik,
            //     'status_baca' => 0,
            // ];

            // $this->M_All->insert('notifikasi', $data_notif);

            $this->session->set_flashdata('alert', true);

            redirect('pencari');
        }
    }
    public function update_profile()
    {

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            // echo 'upload nih';
            // die;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '2048';
            $config['upload_path'] = './asset_registrasi/upload_pencari/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                // $old_image = $data['user']['image'];
                $where = array('id_pencari' => $this->input->post('id_pencari'));
                $new_image = $this->upload->data('file_name');
                $data = array(
                    'nama_pencari' => $this->input->post('nama_pencari'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'email' => $this->input->post('email'),
                    'no_telp' => $this->input->post('no_telp'),
                    'no_ktp' => $this->input->post('no_ktp'),
                    'status' => $this->input->post('status'),
                    'no_telp_wali' => $this->input->post('no_telp_wali'),
                    'foto' => $new_image,
                );
                $this->M_All->update('pencari_kos', $where, $data);
                redirect('pencari/profile');
                // $this->db->set('image', $new_image);
            } else {
                echo $this->upload->dispay_errors();
            }
        } else {
            // echo 'waduh upload nih';
            // die;
            $where = array('id_pencari' => $this->input->post('id_pencari'));
            $data = array(
                'nama_pencari' => $this->input->post('nama_pencari'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'no_ktp' => $this->input->post('no_ktp'),
                'status' => $this->input->post('status'),
                'no_telp_wali' => $this->input->post('no_telp_wali'),
            );
            $this->M_All->update('pencari_kos', $where, $data);
            redirect('pencari/profile');
        }
    }

    public function pembayaran_upload_dp()
    {

        $uang_muka = $this->input->post('uang_muka');
        // $bukti_bayar = $this->input->post('uang_muka');
        $id_pesan = $this->input->post('id_pesan');
        $sisa_bayar = $this->input->post('sisa_bayar');

        $nomor_ktp = $this->input->post('nomor_ktp');
        $nomor_hp = $this->input->post('nomor_hp');

        $filename = $this->_uploadFile();

        $data = [
            'sisa_pembayaran' => $sisa_bayar - $uang_muka,
            'jumlah_dp' => $uang_muka,
            'bukti_bayar' => $filename,
            'status_transaksi' => 0,
            'nomor_ktp' => $nomor_ktp,
            'nomor_hp' => $nomor_hp,
        ];

        $this->db->where('id_pesan', $id_pesan);
        $this->db->update('pemesanan', $data);

        $kode_kamar = $this->input->post('kode_kamar');

        $id_pencari = $this->session->userdata('id_pencari');
        $data_pemilik = $this->M_All->getPemilikByKamar($kode_kamar)->row_array();

        $id_pemilik = $data_pemilik['id_pemilik'];

        // var_dump($this->M_All->update('pemesanan', $where_table, $data));
        // die;
        $data_upd = array(
            'status' => "Booked",
        );

        $where_upd = array('id_kamar' => $this->input->post('id_kamar'));

        $this->M_All->update('kamar', $where_upd, $data_upd);

        $wherePencari = [
            'id_pencari' => $this->session->userdata('id_pencari'),
        ];

        $data_pencari = $this->M_All->get_where('pencari_kos', $wherePencari)->row_array();

        $id_pencari = $data_pencari['id_user'];

        $wherePemilik = [
            'id_pemilik' => $data_pemilik['id_pemilik'],
        ];

        $data_pemilik2 = $this->M_All->get_where('pemilik_kos', $wherePemilik)->row_array();

        $id_pemilik1 = $data_pemilik2['id_user'];

        $this->kirim_notif("Ada pesanan baru nih!", 'pemesanan', $id_pencari, $id_pemilik1);

        // $notif_update = [
        //     'status_baca' => 1
        // ];
        $this->db->set('status_baca', 1);
        $this->db->where('untuk', $id_pencari);
        $this->db->where('jenis', 'pembayaran');
        $this->db->where('status_baca', 0);
        $this->db->update('notifikasi');

        $this->session->set_flashdata('alert', $this->toast('success', '00ff00', 'Berhasil membayar DP, Tunggu Proses Selanjutnya ya!', 'fas fa-smile-wink'));

        redirect('pencari/pembayaran');
    }

    public function kirim_notif($pesan, $dari, $untuk, $jenis)
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

    // public function test()
    // {

    //     $data_pemilik = $this->M_All->getPemilikByKamar('A12')->row_array();

    //     $id_pemilik = $data_pemilik['id_pemilik'];

    //     echo $id_pemilik;
    // }

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

    public function pembayaran_pelunasan()
    {
        $id_pesan = $this->input->post('id_pesan');
        $sisa_bayar = $this->input->post('sisa_bayar');
        $sisa_bayar_dp = $this->input->post('sisa_bayar_dp');
        // $id_pencari = $this->input->post('id_pencari');
        $id_pencari = $this->session->userdata('id_pencari');
        $id_pemilik = $this->input->post('id_pemilik');
        $bukti_pelunasan = $this->_uploadFile();
        // var_dump($id_pencari);
        // die;
        $data = [
            'tanggal' => date('Y-m-d'),
            'jam_pelunasan' => date('H:i:s'),
            'jumlah_pelunasan' => $sisa_bayar,
            'bukti_pelunasan' => $bukti_pelunasan,
            'id_pesan' => $id_pesan,
        ];

        $this->M_All->insert('pelunasan', $data);

        $data_update = [
            'sisa_pembayaran' => 0,
            'status_transaksi' => 0,
        ];
        $this->db->where('id_pesan', $id_pesan);
        $this->db->update('pemesanan', $data_update);

        $this->kirim_notif("Pembayaran Lunas", $id_pemilik, $id_pencari, 'pembayaran');

        redirect('pencari/pembayaran');
    }

    public function simpan_bukti()
    {
        $config['upload_path'] = './asset_admin/bukti_bayar/';
        $config['overwrite'] = true;
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size']             = 1024;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // $this->load->view('upload_form', $error);
            print_r($error);
            // echo "<script> alert('Foto Kos Gagal diunggah');</script>";
        } else {
            $data = array('upload_data' => $this->upload->data());
            // $this->load->view('upload_success', $data);
            $foto = $this->upload->data('file_name');

            $where = array('id_transaksi' => $this->input->post('id_transaksi'));

            $data = array(
                'status_transaksi' => 2,
                'bukti_bayar' => $foto,
                'tgl_bayar' => date('Y-m-d'),
                'sisa_pembayaran' => 0,
            );
            if ($this->M_All->update('pemesanan', $where, $data) != true) {
                $transaksi = $this->M_All->view_where('pemesanan', $where)->row();
                $where_kamar = array('kode_kos' => $transaksi->kode_kamar);
                $kode_kos = $this->M_All->view_where('kamar', $where_kamar)->row();
                $where_updatesal = array('kode_kos' => $kode_kos->kode_kos);
                $saldo = $this->M_All->view_where('kosan', $where_updatesal)->row();
                print_r($saldo);
                $saldo_akhir = ($saldo->saldo_kos + $transaksi->total_bayar);
                $updatesal = array('saldo_kos' => $saldo_akhir);

                echo '<hr>total' . $saldo_akhir;
                $this->M_All->update('kosan', $where_updatesal, $updatesal);
                redirect('pencari/pembayaran/');
                echo "<script> alert('Upload bukti berhasil diupload');</script>";
            } else {
                redirect('pencari/pembayaran/');
                echo "<script> alert('Bukti gagal diupload');</script>";
            }
        }
    }

    public function pembatalan_pesanan($idPesan, $idKamar)
    {
        $where_upd = array('id_pesan' => $idPesan);
        $where_update = array('id_kamar' => $idKamar);

        $data = [
            'status' => 'Tersedia',
        ];

        $data2 = [
            'status_transaksi' => 3,
        ];

        $this->M_All->update('pemesanan', $where_upd, $data2);
        $this->M_All->update('kamar', $where_update, $data);

        $this->session->set_flashdata('alert', $this->toast('danger', 'ff0000', 'Pesanan Berhasil Dibatalkan', 'fas fa-check-circle'));

        redirect('pencari/pembayaran');
    }

    private function _uploadFile()
    {

        $namaFiles = $_FILES['depe']['name'];
        $ukuranFile = $_FILES['depe']['size'];
        $type = $_FILES['depe']['type'];
        $eror = $_FILES['depe']['error'];

        // $nama_file = str_replace(" ", "_", $namaFiles);
        $tmpName = $_FILES['depe']['tmp_name'];
        // $nama_folder = "assets_user/file_upload/";
        // $file_baru = $nama_folder . basename($nama_file);

        // if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($ukuranFile < 8000000)) {

        //   move_uploaded_file($tmpName, $file_baru);
        //   return $file_baru;
        // }

        if ($eror === 4) {

            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
		      Chose an image or video first!
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		      </button>
		  </div>');

            redirect('pencari/view_data_kos');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Your uploaded file is not image/video
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');

            redirect('pencari/view_daaata_kos');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'asset_admin/bukti_bayar/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function auto_batal()
    {
        $get_all_pesanan = $this->db
            ->get('pemesanan')
            ->row_array();

        $tanggal = $get_all_pesanan['tanggal_pesan'];
        $tanggal = new DateTime($tanggal);

        $sekarang = new DateTime();

        $perbedaan = $tanggal->diff($sekarang);

        if ($perbedaan->d >= 1 || $perbedaan->m >= 1 || $perbedaan->y >= 1) {

            $data = [
                'status_transaksi' => 3,
            ];

            $this->db->update('pemesanan', $data, "datediff(current_date(), tanggal_pesan) > 0");
        }

        //     //gabungkan
        //     echo $perbedaan->y . ' selisih tahun.';
        // echo $perbedaan->m . ' selisih bulan.';
        // echo $perbedaan->d . ' selisih hari.';
    }

    public function cetakKwitansi($idpesanan)
    {
        $where_ = array('id_pesan' => $idpesanan);
        $data['pesanan'] = $this->M_All->view_where('pemesanan', $where_)->row();
        $this->load->view('invoice/index', $data);
    }
}
