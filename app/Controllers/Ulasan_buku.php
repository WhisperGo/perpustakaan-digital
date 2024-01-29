<?php

namespace App\Controllers;
use App\Models\M_ulasan_buku;

class Ulasan_buku extends BaseController
{

    public function index($id)
    {
        if (session()->get('level') == 3) {
            $model = new M_ulasan_buku();

            $on = 'ulasan_buku.buku=buku.id_buku';
            $on2 = 'ulasan_buku.user=user.id_user';
            $data['ulasan'] = $model->join3('ulasan_buku', 'buku', 'user', $on, $on2);

            $data['title'] = 'Ulasan Buku';
            $data['desc'] = 'Anda dapat melihat Ulasan Buku di Menu ini.';
            $data['id'] = $id;

            $gambar_baru = $model->getGambarById($id);
            $data['gambar_baru'] = $gambar_baru;

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/ulasan_buku/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 3) {
            $a = $this->request->getPost('isi_ulasan');
            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'buku' => $id,
                'user' => session()->get('id'),
                'ulasan' => $a,
            );

            // Simpan data ke dalam database
            $model = new M_ulasan_buku();
            $model->simpan('ulasan_buku', $data1);

            return redirect()->to('ulasan_buku/' . $id);
        } else {
            return redirect()->to('/');
        }
    }
}