<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_All extends CI_Model
{
    public function get($table)
    {
        return $this->db->get($table);
    }

    public function view_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function getNotif($id_pencari)
    {
        $this->db->select('*');
        $this->db->from('notifikasi');
        $this->db->where('untuk', $id_pencari);
        // $this->db->order_by('date', 'desc');
        $this->db->limit(5);
        return $this->db->get();
    }

    public function view_where_join($kode_kos)
    {

        $this->db->select('*');
        $this->db->from('kosan');
        $this->db->join('pemilik_kos', 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->where('kode_kos', $kode_kos);
        return $this->db->get();
    }

    public function getIdUser($id_pemilik, $kode_kos)
    {
        $this->db->select('id_user');
        $this->db->from('kosan');
        $this->db->join('pemilik_kos', 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->where('kosan.id_pemilik', $id_pemilik);
        $this->db->where('kosan.kode_kos', $kode_kos);
        return $this->db->get();
    }

    public function getIdUserPencari($id_pencari)
    {
        $this->db->select('id_user');
        $this->db->from('pencari_kos');
        $this->db->where('id_pencari', $id_pencari);
        return $this->db->get();
    }

    public function get_where($from, $where)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->where($where);
        return $this->db->get();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function insert_get($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($table, $where, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function join($from, $at)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemilik_kos.id_pemilik = kosan.id_pemilik');
        return $this->db->get();
    }

    public function join_transaksi_($from, $at, $at1, $at2, $at3, $where)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        $this->db->where($where);
        return $this->db->get();
    }

    public function riwayat_transaksi($from, $at, $at1, $at2, $at3, $id_pemilik, $tipe, $kode_kos)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        // $this->db->join('pelunasan', 'pemesanan.id_pesan = pelunasan.id_pesan');

        $this->db->where('pemilik_kos.id_pemilik', $id_pemilik);
        $this->db->where('kosan.kode_kos = ', $kode_kos);

        if ($tipe == 'riwayat') {

            $this->db->where('status_transaksi', 2);
            $this->db->or_where('status_transaksi', 3);
            $this->db->or_where('status_transaksi', 4);
        } else {
            $this->db->where('status_transaksi', 0);
            $this->db->or_where('status_transaksi', 1);
        }

        $this->db->where('kosan.kode_kos = ', $kode_kos);

        return $this->db->get();
    }

    public function riwayat_transaksi2($from, $at, $at1, $at2, $at3, $id_pemilik, $tipe, $kode_kos)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        // $this->db->join('pelunasan', 'pemesanan.id_pesan = pelunasan.id_pesan');

        $this->db->where('pemilik_kos.id_pemilik', $id_pemilik);

        $this->db->where('kosan.kode_kos = ', $kode_kos);
        $this->db->where('status_transaksi', 2);
        $this->db->or_where('status_transaksi', 3);
        $this->db->where('kosan.kode_kos = ', $kode_kos);
        $this->db->or_where('status_transaksi', 4);
        $this->db->where('kosan.kode_kos = ', $kode_kos);

        // $this->db->where('kosan.kode_kos = ', $kode_kos);

        return $this->db->get();
    }

    public function join_transaksi($from, $at, $at1, $at2, $at3)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        return $this->db->get();
    }

    public function join_($from, $at, $at1, $at2, $where)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        // $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        $this->db->where($where);

        return $this->db->get();
    }

    public function join_pelunasan($from, $at, $at1, $at2, $where)
    {
        $this->db->select('*');
        $this->db->from($from);
        $this->db->join($at, 'pemesanan.id_kamar = kamar.id_kamar');
        $this->db->join($at1, 'kamar.kode_kos = kosan.kode_kos');
        $this->db->join($at2, 'kosan.id_pemilik = pemilik_kos.id_pemilik');
        $this->db->join('pelunasan', 'pemesanan.id_pesan = pelunasan.id_pesan');
        $this->db->where($where);

        return $this->db->get();
    }

    public function join_get_bayar($id, $tipe)
    {
        $this->db->select('*,kamar.id_kamar as id_kamar,kamar.foto as kFoto, kamar.deskripsi as kDesc, kosan.foto as ksFoto, kosan.deskripsi as ksDesc');
        $this->db->from('pemesanan');
        $this->db->join('kamar', 'kamar.id_kamar = pemesanan.id_kamar');
        $this->db->join('kosan', 'kosan.kode_kos = kamar.kode_kos');
        $this->db->join('pemilik_kos', 'pemilik_kos.id_pemilik = kosan.id_pemilik');
        $this->db->where('id_pencari', $id);

        if ($tipe == 'info') {
            $this->db->where('status_transaksi', 0);
            $this->db->or_where('status_transaksi', 1);
            $this->db->or_where('status_transaksi', 5);
        } else {
            $this->db->where('status_transaksi', 2);
            $this->db->or_where('status_transaksi', 3);
            $this->db->or_where('status_transaksi', 4);
        }

        return $this->db->get();
    }

    public function get_all_transaksi()
    {
        $this->db->select('*,kamar.foto as kFoto, kamar.deskripsi as kDesc, kosan.foto as ksFoto, kosan.deskripsi as ksDesc');
        $this->db->from('pemesanan');
        $this->db->join('kamar', 'kamar.id_kamar = pemesanan.id_kamar');
        $this->db->join('kosan', 'kosan.kode_kos = kamar.kode_kos');
        $this->db->join('pemilik_kos', 'pemilik_kos.id_pemilik = kosan.id_pemilik');
        // $this->db->join('pelunasan', 'pemesanan.id_pesan = pelunasan.id_pesan');fjoinfj
        $this->db->where('status_transaksi<>', 5);
        return $this->db->get();
    }

    public function join_get_bayar_($id)
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('kamar', 'kamar.id_kamar = pemesanan.id_kamar');
        $this->db->join('kosan', 'kosan.kode_kos = kamar.kode_kos');
        $this->db->join('pemilik_kos', 'pemilik_kos.id_pemilik = kosan.id_pemilik');
        $this->db->where($id);
        return $this->db->count_all_results();
    }

    public function count($table)
    {
        return $this->db->count_all_results($table);
    }

    public function count_($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('kosan', 'kosan.kode_kos = kamar.kode_kos');
        $this->db->where($where);
        return $this->db->count_all_results();
    }

    public function count_where($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->count_all_results(); // code...
    }

    public function sum($kind, $table)
    {
        $this->db->select_sum($kind);
        $query = $this->db->get($table);

        return $query;
    }

    public function store_cart()
    {
        $this->db->select('*'); // code...
    }

    public function getPemilikByKamar($kode_kamar)
    {

        $this->db->select('pm.id_pemilik as id_pemilik, id_user');
        $this->db->from('kamar km');
        $this->db->join('kosan ks', 'km.kode_kos = ks.kode_kos');
        $this->db->join('pemilik_kos pm', 'ks.id_pemilik = pm.id_pemilik');

        // $this->db->join($at3, 'pemesanan.id_pencari = pencari_kos.id_pencari');
        $this->db->where('km.id_kamar', $kode_kamar);
        return $this->db->get();
    }

    public function get_kode_kos($id_pemilik)
    {
        // SELECT ks.kode_kos FROM pemesanan p join kamar k on(p.id_kamar = k.id_kamar) join kosan ks on(k.kode_kos = ks.kode_kos) WHERE id_pemilik = 4 limit 1
        $this->db->select('*');
        $this->db->from('pemesanan p');
        $this->db->join('kamar k', 'p.id_kamar = k.id_kamar');
        $this->db->join('kosan ks', 'k.kode_kos = ks.kode_kos');
        $this->db->where('id_pemilik =', $id_pemilik);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getPemesanan()
    {
        return $this->db->get('pemesanan');
    }

    public function getPemasukanPerBulan($id_kos)
    {

        $query = "SELECT tanggal, SUM(jumlah_dp + jumlah_pelunasan) pendapatan FROM pemesanan p JOIN pelunasan pl on(p.id_pesan = pl.id_pesan) JOIN kamar k on(p.id_kamar = k.id_kamar) WHERE YEAR(tanggal) = YEAR(NOW()) AND k.kode_kos = '" . $id_kos . "' GROUP BY MONTH(tanggal)";

        $result = $this->db->query($query);

        return $result->result();
    }

    public function get_transaksi_selesai($id_kos)
    {

        $query = "SELECT COUNT(*) riwayat FROM pemesanan p JOIN kamar k on(p.id_kamar = k.id_kamar) WHERE status_transaksi IN (2,3,4) AND k.kode_kos = '" . $id_kos . "'";

        $result = $this->db->query($query);
        return $result->row_array();
    }

    public function get_transaksi_proses($id_kos)
    {

        $query = "SELECT COUNT(*) riwayat FROM pemesanan p JOIN kamar k on(p.id_kamar = k.id_kamar) WHERE status_transaksi IN (0,1) AND k.kode_kos = '" . $id_kos . "'";

        $result = $this->db->query($query);
        return $result->row_array();
    }

    public function getCountTransaksi($id_kos)
    {

        $query = "SELECT COUNT(p.id_pesan) transaksi, tanggal_pesan FROM pemesanan p JOIN kamar k on(p.id_kamar = k.id_kamar) WHERE kode_kos = '" . $id_kos . "' GROUP BY MONTH(tanggal_pesan)";

        $result = $this->db->query($query);

        return $result->result();
    }

    public function getCountPenghuni($id_kos)
    {

        $query = "SELECT COUNT(pl.id_lunas) penghuni, pl.tanggal tanggal FROM pelunasan pl JOIN pemesanan p on(pl.id_pesan = p.id_pesan) JOIN kamar k on(p.id_kamar = k.id_kamar) WHERE kode_kos = '" . $id_kos . "' GROUP BY MONTH(pl.tanggal)";

        $result = $this->db->query($query);

        return $result->result();
    }

    public function count_groupby($table, $group_by)
    {
        $query = "SELECT COUNT(*) as ct, tgl_daftar FROM $table GROUP BY $group_by";

        $result = $this->db->query($query);

        return $result->result();
    }

    public function join_pemilik_user()
    {
        $this->db->select('*');
        $this->db->from('pemilik_kos p');
        $this->db->join('user u', 'p.id_user = u.id_user');
        // $this->db->join('kosan k', 'p.id_pemilik = k.id_pemilik');
        return $this->db->get();
    }

    public function getCountBooking($id_pencari)
    {
        $query = "SELECT COUNT(id_pesan) as ct FROM `pemesanan` WHERE id_pencari = $id_pencari AND jumlah_dp = 0 AND status_transaksi <> 3 GROUP BY id_pencari";

        $result = $this->db->query($query);

        return $result->row_array();
    }

    public function getDataKos($where = "")
    {
        $this->db->select('*');
        $this->db->from('kosan k');
        $this->db->join('pemilik_kos p', 'k.id_pemilik = p.id_pemilik');

        if ($where != "") {
            $this->db->where($where);
        }
        // $this->db->join('kosan k', 'p.id_pemilik = k.id_pemilik');
        return $this->db->get();
    }
}
