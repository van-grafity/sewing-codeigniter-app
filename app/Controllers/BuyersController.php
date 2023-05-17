<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BuyerModel;


class BuyersController extends BaseController
{
    protected $BuyerModel;

    public function __construct()
    {
        $this->BuyerModel = new BuyerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Buyers',
            'page_title' => 'Master Data Buyers',
            'buyers' => $this->BuyerModel->findAll()
        ];
        return view('buyers/index', $data);
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
            'buyer_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('buyers')->with('error', 'Something is wrong!');
        }

        $this->BuyerModel->insert([
            'buyer_name' => $this->request->getPost('buyer_name'),
            'offadd' => $this->request->getPost('offadd') ? $this->request->getPost('offadd') : null,
            'shipadd' => $this->request->getPost('shipadd') ? $this->request->getPost('shipadd') : null,
            'country' => $this->request->getPost('country') ? $this->request->getPost('country') : null,
        ]);
        return redirect()->to('buyers')->with('success', 'Successfully added Buyer');
    }

    public function update($id){
        $rules = [
            'buyer_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('buyers')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'buyer_name' => $this->request->getPost('buyer_name'),
            'offadd' => $this->request->getPost('offadd') ? $this->request->getPost('offadd') : null,
            'shipadd' => $this->request->getPost('shipadd') ? $this->request->getPost('shipadd') : null,
            'country' => $this->request->getPost('country') ? $this->request->getPost('country') : null,
        ];
        $this->BuyerModel->update($id,$data);

        return redirect()->to('buyers')->with('success', 'Successfully updated Buyer');
    }

    public function edit($id){
        try {
            $data = $this->BuyerModel->find($id);
            if(!$data) {
                throw new \Exception('Data Buyer not found');
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
            $buyers = $this->BuyerModel->find($id);
            if($buyers) {
                $this->BuyerModel->delete($id);
            } else {
                throw new \Exception('Data Buyer not found');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $buyers,
                'message'=> 'Data Buyer deleted successfully',
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
