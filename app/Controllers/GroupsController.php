<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GroupModel;


class GroupsController extends BaseController
{
    protected $GroupModel;

    public function __construct()
    {
        $this->GroupModel = new GroupModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Group',
            'page_title' => 'Master Data Group',
            'groups' => $this->GroupModel->findAll()
        ];
        return view('groups/index', $data);
    }

    public function dtableGroup()
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
            return redirect()->to('groups')->with('error', 'Something is wrong!');
        }

        $this->GroupModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('groups')->with('success', 'Successfully added Group');
    }

    public function update($id){
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('groups')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->GroupModel->update($id,$data);

        return redirect()->to('groups')->with('success', 'Successfully updated Group');
    }

    public function edit($id){
        try {
            $data = $this->GroupModel->find($id);
            if(!$data) {
                throw new \Exception('Data Group not Found!');
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
            $Groups = $this->GroupModel->find($id);
            if($Groups) {
                $this->GroupModel->delete($id);
            } else {
                throw new \Exception('Data Group not Found!');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $Groups,
                'message'=> 'Successfully deleted Group',
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
