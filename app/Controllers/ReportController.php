<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ReportController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Output Reports',
            'page_title' => 'Output Reports',
        ];
        return view('report/index', $data);
    }

    public function output()
    {
        $data = [
            'title' => 'Output Reports',
            'page_title' => 'Output Reports',
        ];
        return view('report/output', $data);
    }

    public function efficiency()
    {
        $data = [
            'title' => 'Efficiency Reports',
            'page_title' => 'Efficiency Reports',
        ];
        return view('report/efficiency', $data);
    }

    public function defect()
    {
        $data = [
            'title' => 'Defect Reports',
            'page_title' => 'Defect Reports',
        ];
        return view('report/defect', $data);
    }

    public function downtime()
    {
        $data = [
            'title' => 'Downtime Reports',
            'page_title' => 'Downtime Reports',
        ];
        return view('report/downtime', $data);
    }
}
