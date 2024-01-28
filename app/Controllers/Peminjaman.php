<?php

namespace App\Controllers;
use App\Models\M_peminjaman;

class Peminjaman extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_peminjaman();

            $on = 'buku.kategori_buku=kategori_buku.id_kategori';
            $data['jojo'] = $model->join2('buku', 'kategori_buku', $on);

            $data['title'] = 'Data Peminjaman';
            $data['desc'] = 'Anda dapat melihat Data Peminjaman di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/peminjaman/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function menu_peminjaman($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_peminjaman();

            // Mengambil data buku masuk berdasarkan id buku
            $data['jojo'] = $model->getPeminjamanById($id);
            $data['jojo2'] = $id;

            $data['title'] = 'Data Peminjaman';
            $data['desc'] = 'Anda dapat menambah Data Peminjaman di Menu ini.';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/peminjaman/menu_peminjaman', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function create($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_peminjaman();

            $data['title'] = 'Data Peminjaman';
            $data['desc'] = 'Anda dapat menambah Data Peminjaman di Menu ini.';  
            $data['subtitle'] = 'Tambah Peminjaman';

            $data['user'] = $model->tampil('user');
            $data['jojo2'] = $id;

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/peminjaman/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('jumlah_peminjaman');
            $b = $this->request->getPost('user_peminjam');
            $c = $this->request->getPost('tgl_pengembalian');
            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'buku' => $id,
                'stok_buku' => $a,
                'user' => $b,
                'tgl_pengembalian' => $c
            );

            // Simpan data ke dalam database
            $model = new M_peminjaman();
            $model->simpan('peminjaman', $data1);

            return redirect()->to('peminjaman');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {

            // Data yang akan disimpan
            $data1 = array(
                'status_peminjaman' => '2',
            );

            $where = array('id_peminjaman' => $id);
            $model = new M_peminjaman();

            $stok_keluar = $model->getBukuByIdPeminjaman($id);
            $id_buku = $stok_keluar->buku;

            $model->qedit('peminjaman', $data1, $where);

            return redirect()->to('peminjaman/menu_peminjaman/' . $id_buku);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_peminjaman();
            $model->deletee($id);
            return redirect()->to('peminjaman');
        }else {
            return redirect()->to('/');
        }
    }
}