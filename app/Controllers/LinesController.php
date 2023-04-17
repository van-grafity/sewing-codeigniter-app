<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LineModel;


class LinesController extends BaseController
{
    protected $LineModel;

    public function __construct()
    {
        $this->LineModel = new LineModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Line',
            'page_title' => 'Master Data Line',
            'lines' => $this->LineModel->findAll()
        ];
        return view('lines/index', $data);
    }

    public function dtableLine()
    {
        dd("load datatable");
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('lines')->with('error', 'Something is wrong!');
        }

        $this->LineModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('lines')->with('success', 'Successfully added Line');
    }

    public function update($id){
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('lines')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->LineModel->update($id,$data);

        return redirect()->to('lines')->with('success', 'Successfully updated Line');
    }

    public function edit($id){
        try {
            $data = $this->LineModel->find($id);
            if(!$data) {
                throw new \Exception('Data Line tidak ditemukan');
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
            $lines = $this->LineModel->find($id);
            if($lines) {
                $this->LineModel->delete($id);
            } else {
                throw new \Exception('Data Line tidak ditemukan');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $lines,
                'message'=> 'Data Line berhasil di hapus',
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
