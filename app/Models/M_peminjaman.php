<?php

namespace App\Models;
use CodeIgniter\Model;

class M_peminjaman extends Model
{		
	protected $table      = 'peminjaman';
	protected $primaryKey = 'id_peminjaman';
	protected $allowedFields = ['buku', 'stok_buku', 'user', 'tgl_peminjaman', 'tgl_pengembalian', 'status_peminjaman'];
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

	// ----------------------------------- PEMINJAMAN -------------------------------------

	public function getPeminjamanById($id)
	{
		return $this->db->table('peminjaman')
		->select('peminjaman.*, buku.*, user.*') 
		->select('peminjaman.stok_buku AS stok_buku_peminjaman') 
		->join('buku', 'buku.id_buku = peminjaman.buku')
		->join('user', 'user.id_user = peminjaman.user')
		->where('peminjaman.buku', $id)
		->orderBy('peminjaman.created_at', 'DESC')
		->get()
		->getResult();
	}

	public function getBukuByIdPeminjaman($id)
	{
        // Query untuk mengambil data stok buku masuk berdasarkan ID
		$query = $this->db->table('peminjaman')
		->where('id_peminjaman', $id)
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