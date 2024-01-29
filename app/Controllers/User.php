<?php

namespace App\Controllers;
use App\Models\M_user;

class User extends BaseController
{
    public function index()
    {
        if(session()->get('level')== 1) {
            $model=new M_user();
            $on='user.level=level.id_level';
            $data['jojo']=$model->join2('user', 'level', $on);

            $data['title']='Data User';
            $data['desc']='Anda dapat melihat Data User di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu', $data);
            echo view('hopeui/user/view', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');

        }
    }

    public function create()
    {
        if (session()->get('level') == 1) {
            $model=new M_user();

            $data['title']='Data User';
            $data['desc']='Anda dapat tambah Data User di Menu ini.'; 
            $data['subtitle'] = 'Tambah Data User';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/user/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1) {
            $a = $this->request->getPost('username');
            $b = $this->request->getPost('password');
            $c = $this->request->getPost('level');

            // Data yang akan disimpan
            $data1 = array(
                'username' => $a,
                'password' => md5($b),
                'level' => $c
            );

            // Simpan data ke dalam database
            $model = new M_user();
            $model->simpan('user', $data1);

            return redirect()->to('user');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit($id)
    {
        if (session()->get('level') == 1) {

            // Data yang akan disimpan
            $data1 = array(
                'status_peminjaman' => '2',
            );

            $where = array('id_peminjaman' => $id);
            $model = new M_user();

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
        if (session()->get('level') == 1) {
            $model=new M_user();

            $stok_keluar = $model->getBukuByIdPeminjaman($id);
            $id_buku = $stok_keluar->buku;

            $where = array('id_peminjaman' => $id);
            $model->hapus('peminjaman', $where);

            return redirect()->to('peminjaman/menu_peminjaman/' . $id_buku);
        }else {
            return redirect()->to('/');
        }
    }

    // public function reset_password($id)
    // {
    //     if(session()->get('level')== 1) {
    //         $model=new M_user();
    //         $where=array('id_user'=>$id);
    //         $user=array('password'=>md5('12345'));
    //         $model->qedit('user', $user, $where);

    //         echo view('agendapkl/partial/header_datatable');
    //         echo view('agendapkl/partial/side_menu');
    //         echo view('agendapkl/partial/top_menu');
    //         echo view('agendapkl/partial/footer');

    //         return redirect()->to('agendapkl/user');
    //     }else {
    //         return redirect()->to('/');

    //     }
    // }

}