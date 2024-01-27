<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('hopeui/partial/header');
        echo view('hopeui/partial/side_menu');
        echo view('hopeui/partial/top_menu'); 
        echo view('hopeui/dashboard/view');
        echo view('hopeui/partial/footer');
    }
}
