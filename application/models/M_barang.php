<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
	// ========================== Function for Data Barang ============================================
	function getBarangAll()
	{
		$this->db->select('tb_barang.*,tbl_user.user_nama,tbl_satuan_barang.*');
		$this->db->from('tb_barang');
		$this->db->join('tbl_satuan_barang', 'tbl_satuan_barang.sat_barang_id = tb_barang.br_satuan');
		$this->db->join('tbl_user', 'tbl_user.user_id = tb_barang.br_user_id');
		return $this->db->get()->result_array();
	}

	function getBarangAllForInput()
	{
		// $this->db->select('tb_barang.*,tbl_user.user_nama,tbl_satuan_barang.*');
		$this->db->select('tb_barang.br_id,tb_barang.br_nama,tbl_satuan_barang.sat_barang_nama');
		$this->db->from('tb_barang');
		$this->db->join('tbl_satuan_barang', 'tbl_satuan_barang.sat_barang_id = tb_barang.br_satuan');
		$this->db->join('tbl_user', 'tbl_user.user_id = tb_barang.br_user_id');
		return $this->db->get()->result_array();
	}

	function updateBarang($data_barang, $barang_id)
	{
		$this->db->where('br_id', $barang_id);
		$this->db->update('tb_barang', $data_barang);
	}

	function getBarangDetail($barang_id)
	{
		$this->db->select('tb_barang.*,tbl_user.user_nama,tbl_satuan_barang.*');
		$this->db->from('tb_barang');
		$this->db->where('br_id', $barang_id);
		$this->db->join('tbl_satuan_barang', 'tbl_satuan_barang.sat_barang_id = tb_barang.br_satuan');
		$this->db->join('tbl_user', 'tbl_user.user_id = tb_barang.br_user_id');
		return $this->db->get()->row_array();
	}

	function getJenisSatuanAll()
	{
		$this->db->select('*');
		$this->db->from('tbl_jenis_satuan');
		return $this->db->get()->result_array();
	}

	function getAllCustomer()
	{
		$this->db->select('*');
		$this->db->from('tb_customer');
		return $this->db->get()->result_array();
	}

	// ====================================== Function for barang masuk =====================================
	function getBarangMasukAll()
	{
		$this->db->select('*');
		$this->db->from('tb_barang_in');
		$this->db->order_by('in_tgl_create', 'DESC');
		$this->db->join('tbl_user', 'tbl_user.user_id = tb_barang_in.in_user_id');
		$this->db->join('tb_customer', 'tb_customer.cust_id = tb_barang_in.in_supplier');
		return $this->db->get()->result_array();
	}

	function getLastIdBarangMasuk($id)
	{
		$this->db->select('*');
		$this->db->from('tb_barang_in');
		$this->db->where('in_id like', $id . '%');
		$this->db->order_by('in_tgl_create', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
		// return $this->db->get()->result_array();
	}

	function createBarangMasuk(
		$masuk_id,
		$masuk_user_id,
		$masuk_total_harga,
		$masuk_supplier,
		$masuk_no_dok
	) {
		$dtNow = date('Y-m-d H:i:s', time());
		$data = [
			"in_id" => $masuk_id,
			"in_tgl_create" => $dtNow,
			"in_tgl_update" => $dtNow,
			"in_total_harga" => $masuk_total_harga,
			"in_supplier" => $masuk_supplier,
			"in_no_dok" => $masuk_no_dok,
			"in_user_id" => $masuk_user_id
		];
		$this->db->insert('tb_barang_in', $data);
	}

	function createDetailBarangMasuk(
		$dtin_in_id,
		$dtin_br_id,
		$dtin_br_nama,
		$dtin_harga,
		$dtin_qty
	) {
		$dtNow = date('Y-m-d H:i:s', time());
		$data = [
			"dtin_id" => '',
			"dtin_in_id" => $dtin_in_id,
			"dtin_br_id" => $dtin_br_id,
			"dtin_br_nama" => $dtin_br_nama,
			"dtin_harga" => $dtin_harga,
			"dtin_qty" => $dtin_qty,
			"dtin_tgl_create" => $dtNow
		];
		$this->db->insert('tb_d_barang_in', $data);
	}

	function deleteBarangMasuk($ms_id)
	{
		$this->db->where('in_id', $ms_id);
		$this->db->delete('tb_barang_in');
	}

	function getBarangMasukByIdRow($bm_id)
	{
		$this->db->select('*');
		$this->db->from('tb_barang_in');
		$this->db->where('in_id', $bm_id);
		return $this->db->get()->row_array();
	}

	function getDetailBarangMasukById($dtin_id)
	{
		$this->db->select('*');
		$this->db->from('tb_d_barang_in');
		$this->db->where('dtin_in_id', $dtin_id);
		$this->db->join('tb_barang', 'tb_barang.br_id = tb_d_barang_in.dtin_br_id');
		$this->db->join('tbl_satuan_barang', 'tbl_satuan_barang.sat_barang_id = tb_barang.br_satuan');
		return $this->db->get()->result_array();
	}

	// ============================================ Function for Barang Keluar ===================================
	function getBarangKeluarAll()
	{
		$this->db->select('*');
		$this->db->from('tb_barang_out');
		$this->db->order_by('out_tgl_create', 'DESC');
		$this->db->join(
			'tbl_user',
			'tbl_user.user_id = tb_barang_out.out_user_id'
		);
		$this->db->join('tb_customer', 'tb_customer.cust_id = tb_barang_out.out_customer');
		return $this->db->get()->result_array();
	}

	function getLastIdBarangKeluar($id)
	{
		$this->db->select('*');
		$this->db->from('tb_barang_out');
		$this->db->where('out_id like', $id . '%');
		$this->db->order_by('out_tgl_create', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
		// return $this->db->get()->result_array();
	}

	function createBarangKeluar(
		$out_id,
		$out_jml_barang,
		$out_user_id,
		$out_customer
	) {
		$dtNow = date('Y-m-d H:i:s', time());
		$data = [
			"out_id" => $out_id,
			"out_tgl_create" => $dtNow,
			"out_tgl_update" => $dtNow,
			"out_jml_barang" => $out_jml_barang,
			"out_customer" => $out_customer,
			"out_user_id" => $out_user_id,
		];
		$this->db->insert('tb_barang_out', $data);
	}

	function getBarangKeluarByIdRow($bk_id)
	{
		$this->db->select('*');
		$this->db->from('tb_barang_out');
		$this->db->where('out_id', $bk_id);
		$this->db->join('tbl_user', 'tbl_user.user_id = tb_barang_out.out_user_id');
		return $this->db->get()->row_array();
	}

	function deleteBarangKeluar($bk_id)
	{
		$this->db->where('out_id', $bk_id);
		$this->db->delete('tb_barang_out');
	}

	function createDetailBarangKeluar(
		$dtout_out_id,
		$dtout_br_id,
		$dtout_br_nama,
		$dtout_qty
	) {
		$dtNow = date(
			'Y-m-d H:i:s',
			time()
		);
		$data = [
			"dtout_id" => '',
			"dtout_out_id" => $dtout_out_id,
			"dtout_br_id" => $dtout_br_id,
			"dtout_br_nama" => $dtout_br_nama,
			"dtout_qty" => $dtout_qty,
			"dtout_tgl_create" => $dtNow
		];
		$this->db->insert('tb_d_barang_out', $data);
	}

	function getDetailBarangKeluarById($out_id)
	{
		$this->db->select('*');
		$this->db->from('tb_d_barang_out');
		$this->db->where('dtout_out_id', $out_id);
		$this->db->join('tb_barang', 'tb_barang.br_id = tb_d_barang_out.dtout_br_id');
		$this->db->join('tbl_satuan_barang', 'tbl_satuan_barang.sat_barang_id = tb_barang.br_satuan');
		return $this->db->get()->result_array();
	}

	// ============================================================== END OFF MODEL FUNCTION  ==========================================================


	function getSatuanBarangAll()
	{
		$this->db->select('*');
		$this->db->from('tbl_satuan_barang');
		return $this->db->get()->result_array();
	}

	function insertBarang(
		$id,
		$nama,
		$satuan,
		$harpok,
		$harjul,
		$harjul2,
		$harjul3,
		$stok,
		$user_id,
		$is_unlimited
	) {
		$dtNow = date('Y-m-d H:i:s', time());
		$data = [
			"barang_id" => $id,
			"barang_nama" => $nama,
			"barang_satuan" => $satuan,
			"barang_harpok" => $harpok,
			"barang_harjul" => $harjul,
			"barang_harjul2" => $harjul2,
			"barang_harjul3" => $harjul3,
			"barang_stok" => $stok,
			"barang_tgl_create" => $dtNow,
			"barang_tgl_update" => $dtNow,
			"barang_user_id" => $user_id,
			"barang_is_unlimited" => $is_unlimited,
		];
		$this->db->insert('tbl_barang', $data);
	}



	function deleteBarang($barang_id)
	{
		$this->db->where('dtr_id', $barang_id);
		$this->db->delete('tbl_barang');
	}




	function updateBarangMasuk($data_barang, $in_id)
	{
		$this->db->where('in_id', $in_id);
		$this->db->update('tb_barang_in', $data_barang);
	}
	// ============================================ operasi data tabel barang masuk ==============================================






	// ====================== operasi data tabel pengeluaran ==========================
	function getPengeluaranAll()
	{
		$this->db->select('*');
		$this->db->from('tbl_pengeluaran');
		$this->db->order_by('peng_tanggal', 'DESC');
		return $this->db->get()->result_array();
	}

	function getPengeluaranByIdRow($peng_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_pengeluaran');
		$this->db->where('peng_id', $peng_id);
		return $this->db->get()->row_array();
	}

	function createPengeluaran(
		$pl_nama,
		$pl_biaya,
		$pl_keterangan
	) {
		$dtNow = date('Y-m-d H:i:s', time());
		$data = [
			"peng_id" => '',
			"peng_nama" => $pl_nama,
			"peng_tanggal" => $dtNow,
			"peng_biaya" => $pl_biaya,
			"peng_keterangan" => $pl_keterangan,
		];
		$this->db->insert('tbl_pengeluaran', $data);
	}

	function updatePengeluaran($data_pengeluaran, $peng_id)
	{
		$this->db->where('peng_id', $peng_id);
		$this->db->update('tbl_pengeluaran', $data_pengeluaran);
	}

	function deletePengeluaran($peng_id)
	{
		$this->db->where('peng_id', $peng_id);
		$this->db->delete('tbl_pengeluaran');
	}

	// ================================= operasi laporan barang ==========================================
	function getLaporanPembelian($tgl_awal, $tgl_akhir)
	{
		// $tgl_awal = '2021-03-01';
		// $tgl_akhir = '2021-03-10';
		$dtTimeStart =  date('Y-m-d H:i:s', strtotime($tgl_awal));
		$dtTimeEnd =  date('Y-m-d 23:59:59', strtotime($tgl_akhir));
		$this->db->select('*');
		$this->db->from('tbl_barang_masuk');
		$this->db->where('bm_tanggal_masuk between "' . $dtTimeStart . '" and "' . $dtTimeEnd . '"');
		$this->db->order_by('bm_tanggal_masuk', 'ASC');
		return $this->db->get()->result_array();
	}

	function getLaporanPengeluaran($tgl_awal, $tgl_akhir)
	{
		$dtTimeStart =  date('Y-m-d H:i:s', strtotime($tgl_awal));
		$dtTimeEnd =  date('Y-m-d 23:59:59', strtotime($tgl_akhir));
		$this->db->select('*');
		$this->db->from('tbl_pengeluaran');
		$this->db->where('peng_tanggal between "' . $dtTimeStart . '" and "' . $dtTimeEnd . '"');
		$this->db->order_by('peng_tanggal', 'DESC');
		return $this->db->get()->result_array();
	}
}
