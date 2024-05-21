<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $chk = $this->curd_model->get_1('ip_address', 'allowed_ip', array('status'=>'A', 'ip_address'=>$_SERVER['REMOTE_ADDR']));
		if(isset($chk->ip_address))
		{
			$data['allow'] = true;   
			return view('loginpage',$data);
		}
		else
		{
			$data['allow'] = false;   
			$data['ip'] = $_SERVER['REMOTE_ADDR'];   
			return view('loginpage',$data);
		}
    }
}
