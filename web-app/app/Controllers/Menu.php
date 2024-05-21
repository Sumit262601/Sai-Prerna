<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class Menu extends BaseController
{
    public function view()
    {}


    public function update_page($sequence)
    {    
        $data['session'] = $this->session->get('adminlogin');
        
        $data['menu'] = $this->curd_model->get_1('*','menu',array('sequence'=>$sequence)); 
        return view('admin/menu',$data);
    } 

   
    public function action_update($action = null)
    {
        $data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if ($action == 'add-menu') 
        {
            $check = $this->validate([
                'menu'        => ['rules' =>  'required','errors' =>  ['required' => 'Menu is required']],
                'sequence'    => ['rules' =>  'required','errors' =>  ['required' => 'Sequence is required']],
                'url'         => ['rules' =>  'required','errors' =>  ['required' => 'Url is required']],
            ]);
            if($check)
            {
                $frmdata =mysql_clean($frmdata);
                $menu = array(
                    'status'        => 'A',
                    'last_update'  => date('Y-m-d H:i:s'),
                    'update_by'    => $data['session']['user_id'],
                    'menu'         => $frmdata['menu'],
                    'sequence'     => $frmdata['sequence'],
                    'href_url'          => $frmdata['url']
                );
                $insert = $this->curd_model->insert('menu', $menu);
                if($insert)
                    {
                        $error['success']= true;
                    }
                else 
                    {
                        $error['message']['refrence'] = '<p> Error in Add Data</p>';
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
        
        else if($action == "editpage") {
            $data = get_menu();
            if(in_array('1',$data['sequence']))
            {
                $data['other_action'] = explode(" ",$data['action_access']['sequence']);
                if(in_array('1',$data['other_action']))
                {
                    $data['menu_info'] = $this->curd_model->get_1('*','menu',array('status'=>'A'));
                    $emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
                    foreach($emp as $em)
                    {
                        $data['user_info'][$em->id] = $em;
                    }
                    return view('admin/menu', $data);
                }
                else
                {
                    redirect();
                }
            }
            else
            {
              redirect();
            }
        }

        else if ($action == 'update_menu') {
            $check = $this->validate([
                'menu_id' => ['rules' => 'required', 'errors' => ['required' => 'Menu_Id is required']],
                'edit_menu' => ['rules' => 'required', 'errors' => ['required' => 'Menu is required']],
                'edit_sequence' => ['rules' => 'required', 'errors' => ['required' => 'Sequence is required']],
                'edit_url' => ['rules' => 'required', 'errors' => ['required' => 'Url is required']],
            ]);
            if ($check) {
                
                $frmdata = mysql_clean($frmdata);
                $upload_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'menu'      => $frmdata['edit_menu'],
                    'sequence'      => $frmdata['edit_sequence'],
                    'href_url'      => $frmdata['edit_url'],
                    'id'        => $frmdata['menu_id']
                );
                $insert = $this->curd_model->update_table('menu', $upload_data, array('id'=>$frmdata['menu_id']));
                if($insert)
                {
                   $error['success'] = true;
                }
                else
                {
                   $error['message']['refrence'] = '<p>Error in Update Data.</p>';
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
        else if($action == 'change_menu_status')
            {
                $check = $this->validate([
                    'id' => ['rules' =>  'required','errors' =>  ['required' => 'Id is required']],
                    'status' => ['rules' =>  'required','errors' =>  ['required' => 'Status is required']]
                ]);
                
                if($check)
                { 
                    $frmdata = mysql_clean($frmdata);
                    $upload_data = array(
                        'last_update' => date('Y-m-d H:i:s'),
                        'update_by' =>  $data['session']['user_id'],
                        'status' => (($frmdata['status']=='D')?'A':'D')
                    );
                    $insert = $this->curd_model->update_table('menu', $upload_data, array('id'=>$frmdata['id']));
                if($insert)
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

