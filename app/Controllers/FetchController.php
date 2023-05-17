<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StyleModel;

class FetchController extends BaseController
{

    protected $StyleModel;
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->StyleModel = new StyleModel();
    }

    public function index()
    {
        try {
            $fetch_list = [
                'style' => [
                    'route_name' => "fetch_style",
                    'url' => base_url()."fetch/style",
                    'params_options' => ['id', 'gl_id']
                ],
            ];
            $date_return = [
                'status' => 'success',
                'data'=> $fetch_list,
                'message'=> 'Fetch List',
            ];
            return $this->response->setJSON($date_return, 200);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function style() {
        try {
            $id = $this->request->getGet('id');
            $gl_id = $this->request->getGet('gl_id');
            $style = $this->db->table('styles')->select('styles.id, styles.style, styles.description')
                    ->when($id, static function ($query, $id) {
                        $query->where('styles.id', $id);
                    })
                    ->when($gl_id, static function ($query, $gl_id) {
                        $query->where('styles.gl_id', $gl_id);
                    })
                    ->get()->getResult();

            $date_return = [
                'status' => 'success',
                'data'=> $style,
                'message'=> 'Data Style berhasil diambil',
            ];
            return $this->response->setJSON($date_return, 200);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }


    }

}
