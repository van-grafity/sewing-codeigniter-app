<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GlsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'AdminLTE 3 | Dashboard Controller'
        ];
        return view('gls/index', $data);
    }
}
