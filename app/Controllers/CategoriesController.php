<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;


class CategoriesController extends BaseController
{
    protected $CategoryModel;

    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Product Type',
            'page_title' => 'Master Data Product Type',
            'categories' => $this->CategoryModel->findAll()
        ];
        return view('categories/index', $data);
    }

    public function dtableCategory()
    {
        dd("load datatable");
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        $rules = [
            'category_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('categories')->with('error', 'Something is wrong!');
        }

        $this->CategoryModel->insert([
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description'),
        ]);
        return redirect()->to('categories')->with('success', 'Successfully added Product Type');
    }

    public function update($id){
        $rules = [
            'category_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('categories')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'category_name' => $this->request->getPost('category_name'),
            'description' => $this->request->getPost('description'),
        ];
        $this->CategoryModel->update($id,$data);

        return redirect()->to('categories')->with('success', 'Successfully updated Product Type');
    }

    public function edit($id){
        try {
            $data = $this->CategoryModel->find($id);
            if(!$data) {
                throw new \Exception('Data Product Type not found');
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
            $categories = $this->CategoryModel->find($id);
            if($categories) {
                $this->CategoryModel->delete($id);
            } else {
                throw new \Exception('Data Product Type not found');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $categories,
                'message'=> 'Data Product Type deleted successfully',
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
