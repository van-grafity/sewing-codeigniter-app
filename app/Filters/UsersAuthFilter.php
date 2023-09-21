<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsersAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(is_null(session()->get('logged_in')))
        {
            session()->set('last_current_url', current_url());
            return redirect()->to(base_url('login'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        
        $request = \Config\Services::request();
        $ip_address = $request->getIPAddress();
        $current_url = current_url();
        $username = session()->get('name');
        
        $info = [
            'username'   => $username,
            'ip_address' => $ip_address,
            'current_url' => $request->getUri()->getPath(),
            'previous_url' => session()->get('_ci_previous_url'),
        ];
        log_message('debug',"User: <b>{username}</b> <br> Access Path : <b>{current_url}</b> <br> IP Address : <b>{ip_address}</b> <br> Prev URL : <b>{previous_url}</b>", $info);
    }
}