<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LineModel;
use App\Models\GroupModel;
use App\Models\LineGroupModel;


class GroupsController extends BaseController
{
    protected $LineModel;
    protected $GroupModel;
    protected $LineGroupModel;

    public function __construct()
    {
        $this->LineModel = new LineModel();
        $this->GroupModel = new GroupModel();
        $this->LineGroupModel = new LineGroupModel();
    }

    public function index()
    {
        $groups = $this->GroupModel->findAll();
        foreach ($groups as $key => $group) {
            $group->linelist = $this->LineGroupModel->getLinesByGroupId($group->id);
        }
        
        $data = [
            'title' => 'Master Data Group',
            'page_title' => 'Master Data Group',
            'lines' => $this->LineModel->findAll(),
            'groups' => $groups,
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
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('groups')->with('error', 'Something is wrong!');
        }

        $recent_group_id = $this->GroupModel->insert([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);

        $linelist = $this->request->getPost('linelist');
        if($linelist) {
            foreach ($linelist as $key => $line_id) {
                $this->LineGroupModel->insert([
                    'group_id' => $recent_group_id,
                    'line_id' => $line_id,
                ]);
            }
        }
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
        
        $this->LineGroupModel->where('group_id',$id)->delete();
        $linelist = $this->request->getPost('linelist');
        if($linelist) {
            foreach ($linelist as $key => $line_id) {
                $this->LineGroupModel->insert([
                    'group_id' => $id,
                    'line_id' => $line_id,
                ]);
            }
        }
        return redirect()->to('groups')->with('success', 'Successfully updated Group');
    }

    public function edit($id){
        try {
            $group = $this->GroupModel->find($id);
            $linelist = $this->LineGroupModel->getLinesByGroupId($group->id);

            if(!$group) {
                throw new \Exception('Data Group not Found!');
            }

            $date_return = [
                'status' => 'success',
                'data'=> [
                    'group' => $group,
                    'linelist' => $linelist,
                ],
                'message'=> 'Data Output Record berhasil di hapus',
            ];
            return $this->response->setJSON($date_return, 200);

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
