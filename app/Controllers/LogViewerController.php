<?php

namespace App\Controllers;

use CILogViewer\CILogViewer;

use App\Controllers\BaseController;

class LogViewerController  extends BaseController
{
    public function index() {
        $logViewer = new CILogViewer();
        return $logViewer->showLogs();
    }
}
