<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RemarkModel;


class RemarksController extends BaseController
{
    protected $RemarkModel;

    public function __construct()
    {
        $this->RemarkModel = new RemarkModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Remarks',
            'page_title' => 'Master Data Remarks',
            'remarks' => $this->RemarkModel->findAll()
        ];
        return view('remarks/index', $data);
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
            'remark' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('remarks')->with('error', 'Something is wrong!');
        }

        $this->RemarkModel->insert([
            'remark' => $this->request->getPost('remark'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('remarks')->with('success', 'Successfully added Remark');
    }

    public function update($id){
        $rules = [
            'remark' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('remarks')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'remark' => $this->request->getPost('remark'),
            'description' => $this->request->getPost('description'),
        ];
        $this->RemarkModel->update($id,$data);

        return redirect()->to('remarks')->with('success', 'Successfully updated Remark');
    }

    public function edit($id){
        try {
            $data = $this->RemarkModel->find($id);
            if(!$data) {
                throw new \Exception('Data Remark not found');
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
            $remarks = $this->RemarkModel->find($id);
            if($remarks) {
                $this->RemarkModel->delete($id);
            } else {
                throw new \Exception('Data Remark not found');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $remarks,
                'message'=> 'Data Remark deleted successfully',
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
