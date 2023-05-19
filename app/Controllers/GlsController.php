<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GlModel;
use App\Models\BuyerModel;
use App\Models\StyleModel;
use App\Models\CategoryModel;

class GlsController extends BaseController
{

    protected $GlModel;
    protected $BuyerModel;
    protected $StyleModel;
    protected $CategoryModel;

    public function __construct()
    {
        $this->GlModel = new GlModel();
        $this->BuyerModel = new BuyerModel();
        $this->StyleModel = new StyleModel();
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data GL',
            'page_title' => 'Master Data GL',
            'gls' => $this->GlModel->getData(),
            'buyers' => $this->BuyerModel->getData(),
            'categories' => $this->CategoryModel->getData(),
        ];

        // dd($data);
        return view('gls/index', $data);
    }

    public function dtableGl()
    {
        dd("load datatable");
        // $query = DB::table('colors')->get();
        //     return Datatables::of($query)
        //     ->addIndexColumn()
        //     ->escapeColumns([])
        //     ->addColumn('action', function($data){
        //         return '
        //         <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="edit_color('.$data->id.')">Edit</a>
        //         <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_color('.$data->id.')">Delete</a>';
        //     })
        //     ->make(true);
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        $rules = [
            'gl_number' => 'required',
            'season' => 'required',
            'buyer' => 'required',
            'category' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('gls')->with('error', 'Something is wrong!');
        }

        $gl_id = $this->GlModel->insert([
            'gl_number' => $this->request->getPost('gl_number'),
            'season' => $this->request->getPost('season'),
            'buyer_id' => $this->request->getPost('buyer'),
            'category_id' => $this->request->getPost('category'),
        ]);

        $styles = $this->request->getPost('style');
        $styles_desc = $this->request->getPost('style_desc');

        foreach ($styles as $key => $style) {
            if($style && $styles_desc[$key]){
                $style = [
                    'style' => $style,
                    'description' => $styles_desc[$key],
                    'gl_id' => $gl_id,
                ];
                $insertStyle = $this->StyleModel->insert($style);
            }
        }

        return redirect()->to('gls')->with('success', 'Successfully added GL');
    }

    public function update($id){
        $rules = [
            'gl_number' => 'required',
            'season' => 'required',
            'buyer' => 'required',
            'category' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('gls')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'gl_number' => $this->request->getPost('gl_number'),
            'season' => $this->request->getPost('season'),
            'buyer_id' => $this->request->getPost('buyer'),
            'category_id' => $this->request->getPost('category'),
        ];
        $this->GlModel->update($id,$data);

        $gl_id = $id;
        $this->StyleModel->where('gl_id', $gl_id)->delete();

        $styles = $this->request->getPost('style');
        $styles_desc = $this->request->getPost('style_desc');

        foreach ($styles as $key => $style) {
            if($style && $styles_desc[$key]){
                $style = [
                    'style' => $style,
                    'description' => $styles_desc[$key],
                    'gl_id' => $gl_id,
                ];
                $insertStyle = $this->StyleModel->insert($style);
            }
        }

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
