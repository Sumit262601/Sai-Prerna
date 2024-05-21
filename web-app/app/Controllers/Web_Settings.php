<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class Web_Settings extends BaseController
{
    public function view()
    {

    }

    public function action_update($action = null)
    {
        $data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if ($action == 'add_web_settings') 
        {
            $check = $this->validate([        
                'name'   => ['rules' =>  'required','errors' =>  ['required' => 'name is required']],
                'value'       => ['rules' =>  'required','errors' =>  ['required' => 'value is required']]
            ]);


            if($check)
            {
                $frmdata =mysql_clean($frmdata);
                $web_settings = array(
                    'status'       => 'A',
                    'last_update'  => date('Y-m-d H:i:s'),
                    'update_by'   => $data['session']['user_id'],
                    'name'      => $frmdata['name'],
                    'value'     => $frmdata['value']
                );
                   
                $insert = $this->curd_model->insert('web_settings',$web_settings);
                
                if($insert)
                    {
                        $error['success']= true;
                    }
                else 
                    {
                        $error['message']['refrence'] = '<p>Error in Add Data</p>';
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
        } else if ($action == "change_web_settings_status") {
            $check = $this->validate([
                'id' => ['rules' => 'required', 'errors' => ['required' => 'Id is required']],
                'status' => ['rules' => 'required', 'errors' => ['required' => 'Status is required']]
            ]);
            if ($check) {
                $frmdata = mysql_clean($frmdata);
                $upload_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'status' => (($frmdata['status'] == 'D') ? 'A' : 'D')
                );
                $insert = $this->curd_model->update_table('web_settings', $upload_data, array('id' => $frmdata['id']));
                if ($insert) {
                    $error['success'] = true;
                } else {
                    $error['message']['refrence'] = '<p>Error in Update.</p>';
                }
            } else {
                foreach ($_POST as $key => $value) {
                    if ($this->validation->hasError($key)) {
                        $error['message'][$key] = $this->validation->getError($key);
                    }
                }
            }
        } else if ($action == 'update_web_settings') {
            $check = $this->validate([
                'web_settingsid' => ['rules' => 'required', 'errors' => ['required' => 'id is required']],
                'edt_name' => ['rules' => 'required', 'errors' => ['required' => 'Menu is required']],
                'edt_value' => ['rules' => 'required', 'errors' => ['required' => 'value is required']]
            ]);
            if ($check) {
                
                $frmdata = mysql_clean($frmdata);
                $upload_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'name' => $frmdata['edt_name'],
                    'value' => $frmdata['edt_value'],
                    'id' => $frmdata['web_settingsid']
                );
                     $insert = $this->curd_model->update_table('web_settings', $upload_data, array('id'=>$frmdata['web_settingsid']));
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

        echo json_encode($error);

    }
}   
?>