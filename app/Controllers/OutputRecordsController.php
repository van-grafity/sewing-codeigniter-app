<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutputRecordModel;


class OutputRecordsController extends BaseController
{
    protected $OutputRecordModel;

    public function __construct()
    {
        $this->OutputRecordModel = new OutputRecordModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Output Records',
            'page_title' => 'Output Records',
            'output_records' => $this->OutputRecordModel->getData()
        ];
        return view('output-records/index', $data);
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
            return redirect()->to('output_records')->with('error', 'Something is wrong!');
        }

        $this->OutputRecordModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('output_records')->with('success', 'Successfully added Line');
    }

    public function update($id){
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('output_records')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->OutputRecordModel->update($id,$data);

        return redirect()->to('output_records')->with('success', 'Successfully updated Line');
    }

    public function edit($id){
        try {
            $data = $this->OutputRecordModel->find($id);
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
            $output_records = $this->OutputRecordModel->find($id);
            if($output_records) {
                $this->OutputRecordModel->delete($id);
            } else {
                throw new \Exception('Data Line tidak ditemukan');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $output_records,
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
