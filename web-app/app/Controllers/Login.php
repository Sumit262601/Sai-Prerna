<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Login extends BaseController
{
	public function admin()
    {
        $error = array('success' => false, 'message' =>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()));
        $frmdata = $this->request->getPost();
        $check = $this->validate([
            'user_email' => [
                'rules' =>  'required|valid_email',
                'errors' =>  [
                    'required' => 'User Email is required',
                    'valid_email'   =>  'You must provide a valid email address.'
                ]
            ],
            'user_pass' => [
                'rules' =>  'required',
                'errors' =>  [
                    'required' => 'User Password is required'
                ]
            ]
        ]);
        if($check)
        {
            $l_user = $this->curd_model->get_1('*', 'login', array('email_id'=>$frmdata['user_email'], 'status'=>'A'));
            if(isset($l_user->id))
            {
                if($l_user->password === hash('sha256', $frmdata['user_pass']))
                {
                    $login_data = array('user_id'=>$l_user->id,'login_time'=>date('Y-m-d H:i:s'),'ip_address'=>$_SERVER['REMOTE_ADDR'],'last_activity_time'=>date('Y-m-d H:i:s'));
                    $login_id = $this->curd_model->insert('login_history', $login_data);
                    $data = array(
                        'user_id' => $l_user->id,
                        'login_id' => $login_id,
                        'f_name' => $l_user->f_name,
                        'l_name' => $l_user->l_name,
                        'type' => $l_user->type,
                        'email_id' => $l_user->email_id
                    );
                    $this->curd_model->update_table('login',array('session_id'=>$login_id),array('id'=>$l_user->id));
                    $this->session->set('adminlogin', $data);
                    $error['success'] = true;
                    $error['rlink'] = 'web-admin/dashboard';
                }
                else
                {
                    $error['message']['alert'] = "Invalid User or Password";
                }
            }
            else
            {
                $error['message']['alert'] = "Invalid User or Password";
            }
        }
        else
        {
            foreach($_POST as $key =>$value)
            {
                if ($this->validation->hasError($key)) {
                    $error['message'][$key] = $this->validation->getError($key);
                }
            }
        }
        echo json_encode($error);
    }
}

?>