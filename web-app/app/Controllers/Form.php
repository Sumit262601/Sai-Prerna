<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class Form extends BaseController
{
    public function action_update($action = null)
	{
		$agent = $this->request->getUserAgent();
		// $session['session'] = $this->session->get('visitor');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        
        $frmdata = $this->request->getPost();
        
        if($action == 'contact')
        {
			$check = $this->validate([
                'name' 		=> ['rules' =>  'required','errors' =>  ['required' => 'Name is required']],
                'phone' 	=> ['rules' =>  'required','errors'|'is_natural'|'exact_length[10]' =>  ['required' => 'phone is required']],
                'email_id' 	=> ['rules' =>  'required','errors'|'valid_email' =>  ['required' => 'Email id is required']],
                'purpose' 	=> ['rules' =>  'required','errors' =>  ['required' => 'Event is required']],
                'message' 	=> ['rules' =>  'required','errors' =>  ['required' => 'Message id is required']]
            ]);
            if($check)
            {
                $frmdata = mysql_clean($frmdata);
                $data = array(
                    'ip_address' =>$_SERVER['REMOTE_ADDR'],
                    'system_info'=> json_encode(array('browser'=>$agent->getBrowser(),'browser_ver'=>$agent->getVersion(),'platform'=>$agent->getPlatform())),
                    'insert_time' => date('Y-m-d H:i:s'),
                    'name' => $frmdata['name'],
                    'contact' => $frmdata['phone'],
                    'email_id' => $frmdata['email_id'],
                    'purpose' => $frmdata['purpose'],
                    'message' => $frmdata['message']
                );
                $sql = $this->curd_model->insert('frm_contact', $data);
                if($sql)
				{
                    $error['success'] = true;
                    $error['alert1'] = 'Thank you for registration with us.';
                }
				else
				{
                    $error['message']['refrence'] = 'Error in data storing please try again.';
                }
            }else {
                foreach ($_POST as $key => $value) {
                    if ($this->validation->hasError($key)) {
                        $error['message'][$key] = $this->validation->getError($key);
                    }
                }
            }
	    }
		else if($action == 'subscribe')
		{
			$check = $this->validate([
				'email' => ['rules' => 'required','error' =>['required' => 'email is required']]
			]);
			if($check)
		    {	
		    	$suscribe = array(
		    		'email' => $frmdata['email'],
		    		'insert_time' => date('Y-m-d H:i:s'),
		    		'ip_address' => $_SERVER['REMOTE_ADDR'],
		    		'system_info'=> json_encode(array('browser'=>$agent->getBrowser(),'browser_ver'=>$agent->getVersion(),'platform'=>$agent->getPlatform())),
		    	);
		    	$insert = $this->curd_model->insert('frm_subscribe', $suscribe);
		    	if($insert)
		    	{
		    		$error['success'] = true;
		    		$error['alert'] = 'Thank you for registration with us.';
		    	}
		    	else
		    	{
		    		$error['message']['refrence'] ='<p> error in  data submit</p>';
		    	}
		    }
		    else
		    {
		    foreach ($_POST as $key => $value)
		    	{
		    		if($this->validation->hasError($key))
		    		{
		    			$error['message'][$key] =$this->validation->getError($key);
		    		}
		    	}
		    }

		}
		echo json_encode($error);	
	}
}

?>
