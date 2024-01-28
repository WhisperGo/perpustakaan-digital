<?php

namespace App\Controllers;
use App\Models\M_buku;

class Buku extends BaseController
{

    public function index()
    {
        if (session()->get('level') == 1) {
            $model = new M_buku();
            $data['jojo'] = $model->tampil('kategori_buku');
            $data['title'] = 'Kategori Buku';
            $data['desc'] = 'Anda dapat melihat Kategori Buku di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/kategori_buku/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create()
    {
        if(session()->get('level')== 1) {
            $model=new M_buku();
            $data['title'] = 'Kategori Buku';
            $data['desc'] = 'Anda dapat menambah Kategori Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Kategori Buku';      
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/kategori_buku/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if(session()->get('level')== 1) {
            $a = $this->request->getPost('nama_kategori');
            $b = $this->request->getPost('deskripsi_kategori');

            // Memeriksa apakah $b memiliki data
            if ($b === null || $b === '') {
                $deskripsi_kategori = null;
            } else {
                $deskripsi_kategori = $b;
            }

            // Yang ditambah ke user
            $data1 = array(
                'nama_kategori' => $a,
                'deskripsi_kategori' => $deskripsi_kategori,
            );
            $model = new M_buku();
            $model->simpan('kategori_buku', $data1);

            return redirect()->to('kategori_buku');
        } else {
            return redirect()->to('/');
        }
    }


    public function edit($id)
    { 
        if(session()->get('level')== 1) {
            $model=new M_buku();
            $where=array('id_kategori'=>$id);
            $data['jojo']=$model->getWhere('kategori_buku',$where);
            $data['title'] = 'Kategori Buku';
            $data['desc'] = 'Anda dapat menambah Kategori Buku di Menu ini.';      
            $data['subtitle'] = 'Tambah Kategori Buku';      
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/kategori_buku/edit', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit()
    { 
        if(session()->get('level')== 1) {
           $a = $this->request->getPost('nama_kategori');
           $b = $this->request->getPost('deskripsi_kategori');
           $id= $this->request->getPost('id');

        // Memeriksa apakah $b memiliki data
           if ($b === null || $b === '') {
            $deskripsi_kategori = null;
        } else {
            $deskripsi_kategori = $b;
        }

        // Yang ditambah ke user
        $data1 = array(
            'nama_kategori' => $a,
            'deskripsi_kategori' => $deskripsi_kategori,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $where=array('id_kategori'=>$id);
        $model=new M_buku();
        $model->qedit('kategori_buku', $data1, $where);

        return redirect()->to('kategori_buku');
    }else {
        return redirect()->to('/');
    }
}

public function delete($id)
{ 
    if(session()->get('level')== 1) {
        $model=new M_buku();
        $model->deletee($id);
        return redirect()->to('kategori_buku');
    }else {
        return redirect()->to('/');
    }
}
}