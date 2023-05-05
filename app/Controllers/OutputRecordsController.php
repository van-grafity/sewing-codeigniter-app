<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OutputRecordModel;
use App\Models\GlModel;
use App\Models\LineModel;


class OutputRecordsController extends BaseController
{
    protected $OutputRecordModel;
    protected $GlModel;
    protected $LineModel;

    public function __construct()
    {
        $this->OutputRecordModel = new OutputRecordModel();
        $this->GlModel = new GlModel();
        $this->LineModel = new LineModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Output Records',
            'page_title' => 'Output Records',
            'output_records' => $this->OutputRecordModel->getData(),
            'gls' => $this->GlModel->getData(),
            'lines' => $this->LineModel->getData()
        ];
        // dd($data);
        return view('output-records/index', $data);
    }

    public function dtableOutputRecord()
    {
        dd("load datatable");
    }

    public function show($id) {
        dd("masuk",$id);
    }

    public function store(){
        // dd($this->request->getPost());
        $rules = [
            'time_date' => 'required',
            'gl_number' => 'required',
            'line' => 'required',
            'time_hours_of' => 'required',
            'target' => 'required',
            'output' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('output-records')->with('error', 'Something is wrong!');
        }

        $time_date = $this->request->getPost('time_date');
        $line = $this->request->getPost('line');
        $time_hours_of = $this->request->getPost('time_hours_of');

        $check_double_record = $this->OutputRecordModel
                                ->where('time_date', $time_date)
                                ->where('line_id', $line)
                                ->where('time_hours_of', $time_hours_of)
                                ->find();
        
        if($check_double_record) {
            return redirect()->to('output-records')->with('error', 'Data output pada tanggal '. $time_date .' untuk Line '. $line .' pada jam ke '. $time_hours_of . ' sudah ada!');
        }

        $this->OutputRecordModel->insert([
            'time_date' => $this->request->getPost('time_date'),
            'gl_id' => $this->request->getPost('gl_number'),
            'line_id' => $this->request->getPost('line'),
            'time_hours_of' => $this->request->getPost('time_hours_of'),
            'target' => $this->request->getPost('target'),
            'output' => $this->request->getPost('output'),
            'defact_qty' => $this->request->getPost('defact_qty'),
            'endline_ftt' => $this->request->getPost('endline_ftt'),
        ]);
        return redirect()->to('output-records')->with('success', 'Successfully added Output Record');
    }

    public function update($id){
        $rules = [
            'time_date' => 'required',
            'gl_number' => 'required',
            'line' => 'required',
            'time_hours_of' => 'required',
            'target' => 'required',
            'output' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('output-records')->with('error', 'Something is wrong!');
        }

        $time_date = $this->request->getPost('time_date');
        $line = $this->request->getPost('line');
        $time_hours_of = $this->request->getPost('time_hours_of');
        
        $check_double_record = $this->OutputRecordModel
                                ->where('time_date', $time_date)
                                ->where('line_id', $line)
                                ->where('time_hours_of', $time_hours_of)
                                ->where('id !=', $id)
                                ->first();
        
        if($check_double_record) {
            return redirect()->to('output-records')->with('error', 'Data output pada tanggal '. $time_date .' untuk Line '. $line .' pada jam ke '. $time_hours_of . ' sudah ada!');
        }
        
        $data = [
            'time_date' => $this->request->getPost('time_date'),
            'gl_id' => $this->request->getPost('gl_number'),
            'line_id' => $this->request->getPost('line'),
            'time_hours_of' => $this->request->getPost('time_hours_of'),
            'target' => $this->request->getPost('target'),
            'output' => $this->request->getPost('output'),
            'defact_qty' => $this->request->getPost('defact_qty'),
            'endline_ftt' => $this->request->getPost('endline_ftt'),
        ];
        $this->OutputRecordModel->update($id,$data);

        return redirect()->to('output-records')->with('success', 'Successfully updated Output Record');
    }

    public function edit($id){
        try {
            $data = $this->OutputRecordModel->find($id);
            if(!$data) {
                throw new \Exception('Data Output Record tidak ditemukan');
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
                throw new \Exception('Data Output Record tidak ditemukan');
            }
            $date_return = [
                'status' => 'success',
                'data'=> $output_records,
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
}
