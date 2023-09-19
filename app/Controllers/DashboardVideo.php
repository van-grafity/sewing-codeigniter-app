<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardVideo extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Video',
            'page_title' => 'Video Viewer',
        ];
        return view('dashboard-production/dashboard-video', $data);
    }
}
