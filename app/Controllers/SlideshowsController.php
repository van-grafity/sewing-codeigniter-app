<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\GlModel;
use App\Models\LineModel;
use App\Models\SlideshowModel;

class SlideshowsController extends BaseController
{
    protected $GlModel;
    protected $LineModel;
    protected $SlideshowModel;

    public function __construct()
    {
        $this->GlModel = new GlModel();
        $this->LineModel = new LineModel();
        $this->SlideshowModel = new SlideshowModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Slideshow',
            'page_title' => 'Master Data Slideshow',
            'slideshows' => $this->SlideshowModel->getData(),
            'gls' => $this->GlModel->getData(),
            'lines' => $this->LineModel->getData(),
        ];

        return view('slideshows/index', $data);
    }

    public function dtableSlideshow()
    {
        dd("load datatable");
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        $rules = [
            'line' => 'required',
            'gl_number' => 'required',
            'time_date' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('slideshows')->with('error', 'Something is wrong!');
        }

        $this->SlideshowModel->insert([
            'line_id' => $this->request->getPost('line'),
            'gl_id' => $this->request->getPost('gl_number'),
            'time_date' => $this->request->getPost('time_date'),
        ]);
        return redirect()->to('slideshows')->with('success', 'Successfully added Slideshow');
    }

    public function update($id){
        $rules = [
            'line' => 'required',
            'gl_number' => 'required',
            'time_date' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('slideshows')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'line_id' => $this->request->getPost('line'),
            'gl_id' => $this->request->getPost('gl_number'),
            'time_date' => $this->request->getPost('time_date'),
        ];
        $this->SlideshowModel->update($id,$data);

        return redirect()->to('slideshows')->with('success', 'Successfully updated Slideshow');
    }

    public function edit($id){
        try {
            $data = $this->SlideshowModel->find($id);
            if(!$data) {
                throw new \Exception('Data Slideshow tidak ditemukan');
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
            $slideshows = $this->SlideshowModel->find($id);
            if($slideshows) {
                $this->SlideshowModel->delete($id);
            } else {
                throw new \Exception('Data Slideshow tidak ditemukan');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $slideshows,
                'message'=> 'Data Slideshow berhasil di hapus',
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
