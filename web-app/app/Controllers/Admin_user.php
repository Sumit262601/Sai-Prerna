<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Admin_user extends BaseController
{
    public function view()
    {
        $data['session'] = $this->session->get('adminlogin');
        $data = get_menu();
        if(in_array('user',$data['url']))
        {
            $data['other_action'] = explode(" ",$data['action_access']['user']);
            $data['user_id'] = '';
            if(isset($_GET['user_id']))
            {
                $_GET = mysql_clean($_GET);
                $data['user_id'] = (isset($_GET['user_id'])?$_GET['user_id']:'');
                
            }
            else if(isset($_POST['user_id']))
            {
                $_GET = mysql_clean($_POST);
                $data['user_id'] = (isset($_GET['user_id'])?$_GET['user_id']:'');
            }
            if($data['user_id'] != "")
            {
                $data['usr_id'] = ($data['user_id']);
                $data['user_id'] = data_decode($data['user_id']);
                $emp = $this->curd_model->get_all('*','login',array(),'f_name','ASC');
                foreach($emp as $em)
                {
                    $data['user_info'][$em->id] = $em;
                }
                $join = array(
                    array(
                        'table' => 'tab_group',
                        'condition' => 'tab.tab_group=tab_group.id',
                        'type' => 'left'
                    )
                );
                $whr = array();
                $menu = $this->curd_model->jointable('tab.other_action,tab.id as tab_id,tab.name,tab.page_url,tab_group.themify,tab_group.name as group_name', 'tab', $join, $whr, 'true', 'tab_group.id', 'desc');
                foreach($menu as $mn)
                {
                    $data['menu'][$mn->group_name]['icon'] = $mn->themify;
                    $data['menu'][$mn->group_name]['menu'][$mn->name] = array('url'=>$mn->page_url,'id'=>$mn->tab_id,'other_action'=>$mn->other_action);
                }
                $data['emp'] = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
                $data['user_type'] = $this->curd_model->get_all('*', 'user_type', array('status'=>'A'), 'name', 'ASC');
                $data['emp_info'] = $this->curd_model->get_1('*', 'login', array('id'=>$data['user_id']));
                //print_r($data['user_id']);
                $user_access = $this->curd_model->get_all('*', 'user_access', array('user_id'=>$data['user_id']), 'tab_id', 'ASC');
                foreach($user_access as $ua)
                {
                    $data['user_access'][$ua->tab_id] = array('user_id'=>$ua->user_id,'status'=> $ua->status,'other_action' => $ua->other_action);
                }
                return view('admin/user_access',$data);
            }
            else{
                redirect('user');
            }
        }
        else
        {
            redirect("web-admin/dashboard");
        }
    }

    public function action_update($action = null)
    {
        $error = array('success' => false, 'message' =>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()));
        $frmdata = $this->request->getPost();
        $session = $this->session->get('adminlogin');
        if($action == 'add_user_info')
        {
            $check = $this->validate([
                'f_name' => ['rules' =>  'required','errors' =>  ['required' => 'First Name is required']],
                'l_name' => ['rules' =>  'required','errors' =>  ['required' => 'Last Name is required']],
                'email' => ['rules' =>  'required|valid_email','errors' =>  ['required' => 'User Email is required','valid_email'   =>  'You must provide a valid email address.']],
                'password' => ['rules' =>  'required','errors' =>  ['required' => 'Password is required']],
                'phone' => ['rules' =>  'required|max_length[10]|min_length[10]','errors' =>  ['required' => 'Phone is required']],
                'designation' => ['rules' =>  'required','errors' =>  ['required' => 'Designation is required']],
                'office_name' => ['rules' =>  'required','errors' =>  ['required' => 'office_name is required']],
            ]);
            if($check)
            {            
                $update_data = array(
                    'status' => $frmdata['status'],
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                    'update_by' => $session['user_id'],
                    'type' => $frmdata['type'], 
                    'f_name' => $frmdata['f_name'],
                    'l_name' => $frmdata['l_name'],
                    'email_id' => $frmdata['email'],
                    'password' => hash('sha256', $frmdata['password']),
                    'phone' => $frmdata['phone'],
                    'designation' => $frmdata['designation'],
                    'office_name' => $frmdata['office_name']
                );
                $insert = $this->curd_model->insert('login', $update_data);
                if($insert)
                {
                    $error['success'] = true;
                }
                else
                {
                    $error['message']['refrence'] = '<p>Error in Insert.</p>';
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
        }
        else if($action == 'update_user_info')
        {
            $check = $this->validate([
                'f_name' => ['rules' =>  'required','errors' =>  ['required' => 'First Name is required']],
                'l_name' => ['rules' =>  'required','errors' =>  ['required' => 'Last Name is required']],
                'email' => ['rules' =>  'required|valid_email','errors' =>  ['required' => 'User Email is required','valid_email' => 'You must provide a valid email address.']],
                'user_id' => ['rules' =>  'required','errors' =>  ['required' => 'User is required']],
                'phone' => ['rules' =>  'required|max_length[10]|min_length[10]','errors' =>  ['required' => 'Phone is required']],
                'designation' => ['rules' =>  'required','errors' =>  ['required' => 'Designation is required']],
                'office_name' => ['rules' =>  'required','errors' =>  ['required' => 'office_name is required']]
            ]);
            if($check)
            {
                $frmdata = mysql_clean($frmdata);
                $user = $this->curd_model->get('*', 'login', array('id'=>$frmdata['user_id']));
                // print_r($user);
                if(isset($user->id) && ($user->password != ''))
                {
                    $update_data = array(
                        'status' => $frmdata['status'],
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $session['user_id'],
                        'type' => $frmdata['type'], 
                        'f_name' => $frmdata['f_name'],
                        'l_name' => $frmdata['l_name'],
                        'email_id' => $frmdata['email'],
                        'phone' => $frmdata['phone'],
                        'designation' => $frmdata['designation'],
                        'office_name' => $frmdata['office_name']
                    );
                    $update = $this->curd_model->update_table('login', $update_data, array('id'=>$frmdata['user_id']));
                    if($update)
                    {
                        $error['success'] = true;
                    }
                    else
                    {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                }
                else
                {
                    $error['message']['alert'] = "Please generate user password.";
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
        }
        else if($action == 'update_user_password')
        {
            $session = $this->session->get('adminlogin');
            $check = $this->validate([
                'new_password' => ['rules' =>  'required','errors' =>  ['required' => 'New Password is required']],
                'con_password' => ['rules' =>  'required','errors' =>  ['required' => 'Confirm Password is required']],
            ]);
            if($check)
            {
                //$frmdata = mysql_clean($frmdata);
                if($frmdata['new_password'] == $frmdata['con_password'])
                {
                
                    $update_data = array(
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $session['user_id'],
                        'password' => hash('sha256', $frmdata['new_password']), 
                    );
                    $update = $this->curd_model->update_table('login', $update_data, array('id'=>$frmdata['user_id']));
                    if($update)
                    {
                        $error['success'] = true;
                    }
                    else
                    {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                }
                else
                {
                    $error['message']['refrence'] = "Password not match.";
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
        }
        else if($action == 'update_access')
        {
            $check = $this->validate([
                'user_id' => ['rules' =>  'required','errors' =>  ['required' => 'User is required']]
            ]);
            if($check)
            {
                $rmv_link = $this->curd_model->update_table('user_access',array('status'=>'D','other_action'=>''),array('user_id'=>$frmdata['user_id']));
               // print_r($rmv_link);
                if($rmv_link)
                {
                    foreach($frmdata['tab'] as $tab)
                    {
                        $action_tab = "";
                        if(isset($frmdata['action'][$tab]))
                        {
                            $action_tab = implode(" ",$frmdata['action'][$tab]);
                        }
                        $this->curd_model->customquery("
                            INSERT INTO user_access (`user_id`,`tab_id`,`status`,`other_action`) VALUES (".$frmdata['user_id'].",".$tab.",'A','".$action_tab."') 
                            ON DUPLICATE KEY UPDATE 
                            `status` = 'A',
                            `other_action` = '".$action_tab."'
                        ");
                    }
                    
                    $error['success'] = true;
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
        }
        else if($action == 'update_type_access')
        {
            $check = $this->validate([
                'type' => ['rules' =>  'required','errors' =>  ['required' => 'type is required']]
            ]);
            if($check)
            {
                $rmv_link = $this->curd_model->update_table('user_type_access',array('status'=>'D','other_action'=>''),array('user_key'=>$frmdata['type']));
                if($rmv_link)
                {
                    
                    foreach($frmdata['tab'] as $tab) // this tab is a table of slide bar menu and submenu
                    {
                        $action_tab = "";
                        if(isset($frmdata['action'][$tab]))
                        {
                            $action_tab = implode(" ",$frmdata['action'][$tab]);
                        }
                        
                        $this->curd_model->customquery("
                            INSERT INTO user_type_access (`user_key`,`tab_id`,`status`,`other_action`) VALUES ('".$frmdata['type']."',".$tab.",'A','".$action_tab."') 
                            ON DUPLICATE KEY UPDATE 
                            `status` = 'A',
                            `other_action` = '".$action_tab."'
                        "); // this is the join table for joining the two of tab and table_group
                       
                    }
                    $error['success'] = true;
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
        }
       
        echo json_encode($error);
    }
}

?>