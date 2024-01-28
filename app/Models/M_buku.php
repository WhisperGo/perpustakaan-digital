<?php

namespace App\Models;
use CodeIgniter\Model;

class M_buku extends Model
{		
	protected $table      = 'buku';
	protected $primaryKey = 'id_buku';
	protected $allowedFields = ['judul_buku', 'cover_buku', 'kategori_buku'];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;

	public function tampil($table1)	
	{
		return $this->db->table($table1)->where('deleted_at', null)->get()->getResult();
	}
	public function hapus($table, $where)
	{
		return $this->db->table($table)->delete($where);
	}
	public function simpan($table, $data)
	{
		return $this->db->table($table)->insert($data);
	}
	public function qedit($table, $data, $where)
	{
		return $this->db->table($table)->update($data, $where);
	}
	public function getWhere($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRow();
	}
	public function getWhere2($table, $where)
	{
		return $this->db->table($table)->getWhere($where)->getRowArray();
	}
	public function join2($table1, $table2, $on)
	{
		return $this->db->table($table1)
		->join($table2, $on, 'left')
		->where("$table1.deleted_at", null)
		->where("$table2.deleted_at", null)
		->get()
		->getResult();
	}

	// ----------------------------------- STOK BUKU MASUK -------------------------------------

	public function getBukuMasukById($id)
	{
		return $this->db->table('buku_masuk')
		->select('buku_masuk.*, buku.*') 
		->join('buku', 'buku.id_buku = buku_masuk.buku')
		->where('buku.id_buku', $id)
		->get()
		->getResult();
	}


	public function getBukuMasukByIdBukuMasuk($id)
	{
        // Query untuk mengambil data stok buku masuk berdasarkan ID
		$query = $this->db->table('buku_masuk')
		->where('id_buku_masuk', $id)
		->get();

        // Mengembalikan satu baris data stok buku masuk
		return $query->getRow();
	}

	// ----------------------------------- STOK BUKU KELUAR -------------------------------------

	public function getBukuKeluarById($id)
	{
		return $this->db->table('buku_keluar')
		->select('buku_keluar.*, buku.*') 
		->join('buku', 'buku.id_buku = buku_keluar.buku')
		->where('buku.id_buku', $id)
		->get()
		->getResult();
	}


	public function getBukuKeluarByIdBukuMasuk($id)
	{
        // Query untuk mengambil data stok buku masuk berdasarkan ID
		$query = $this->db->table('buku_keluar')
		->where('id_buku_keluar', $id)
		->get();

        // Mengembalikan satu baris data stok buku masuk
		return $query->getRow();
	}



	//CI4 Model
	public function deletee($id)
	{
		return $this->delete($id);
	}
}