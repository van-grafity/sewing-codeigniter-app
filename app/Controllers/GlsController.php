<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gl;

class GlsController extends BaseController
{

    protected $GlModel;

    public function __construct()
    {
        $this->GlModel = new Gl();
    }

    public function index()
    {
        $data = [
            'title' => 'AdminLTE 3 | Dashboard Controller',
            'page_title' => 'Master Data GL',
            'gls' => $this->GlModel->findAll()
        ];
        return view('gls/index', $data);
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        $rules = [
            'gl_number' => 'required',
            'season' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('gls')->with('error', 'Something is wrong!');
        }

        $this->GlModel->insert([
            'gl_number' => $this->request->getPost('gl_number'),
            'season' => $this->request->getPost('season'),
        ]);
        return redirect()->to('gls')->with('success', 'Successfully added GL');
    }

    public function update($id){
        $rules = [
            'gl_number' => 'required',
            'season' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('gls')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'gl_number' => $this->request->getPost('gl_number'),
            'season' => $this->request->getPost('season'),
        ];
        $this->GlModel->update($id,$data);

        return redirect()->to('gls')->with('success', 'Successfully updated GL');
    }

    public function edit($id){
        try {
            $data = $this->GlModel->find($id);
            if(!$data) {
                throw new \Exception('Data GL tidak ditemukan');
            }
            return $this->response->setJSON($data, 200);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $gl = $this->GlModel->find($id);
            if($gl) {
                $this->GlModel->delete($id);
            } else {
                throw new \Exception('Data GL tidak ditemukan');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $gl,
                'message'=> 'Data GL berhasil di hapus',
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
