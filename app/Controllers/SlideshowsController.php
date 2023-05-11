<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\GlModel;
use App\Models\LineModel;
use App\Models\SlideshowModel;
use App\Models\GroupModel;
use App\Models\LineGroupModel;

class SlideshowsController extends BaseController
{
    protected $SlideshowModel;
    protected $GroupModel;
    protected $LineGroupModel;

    public function __construct()
    {
        helper('date');
        $this->SlideshowModel = new SlideshowModel();
        $this->GroupModel = new GroupModel();
        $this->LineGroupModel = new LineGroupModel();
    }

    public function index()
    {
        $slideshows = $this->SlideshowModel->getData();
        
        foreach ($slideshows as $key => $slideshow) {
            $slideshow->linelist = $this->LineGroupModel->getLinesByGroupId($slideshow->group_id);
        }
        
        $data = [
            'title' => 'Master Data Slideshow',
            'page_title' => 'Master Data Slideshow',
            'slideshows' => $slideshows,
            'groups' => $this->GroupModel->getData(),
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
            'group' => 'required',
            'time_date' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('slideshows')->with('error', 'Something is wrong!');
        }
        $time_date = $this->request->getPost('time_date') ? $this->request->getPost('time_date') : now();
        $this->SlideshowModel->insert([
            'group_id' => $this->request->getPost('group'),
            'time_date' => $time_date,
        ]);
        return redirect()->to('slideshows')->with('success', 'Successfully added Slideshow');
    }

    public function update($id){
        $rules = [
            'group' => 'required',
            'time_date' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('slideshows')->with('error', 'Something is wrong!');
        }
        
        $data = [
            'group_id' => $this->request->getPost('group'),
            'time_date' => $this->request->getPost('time_date'),
        ];
        $this->SlideshowModel->update($id,$data);

        return redirect()->to('slideshows')->with('success', 'Successfully updated Slideshow');
    }

    public function edit($id){
        try {
            $data = $this->SlideshowModel->find($id);
            if(!$data) {
                throw new \Exception('Data Slideshow not Found');
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
                throw new \Exception('Data Slideshow not Found');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $slideshows,
                'message'=> 'Successfully deleted Slideshow',
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
