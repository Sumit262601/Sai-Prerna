<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class Service extends BaseController
{
	
	public function action_update($action = null)
	{
		$data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if($action == 'add_service')
        {
			$check = $this->validate([
                'description' => ['rules' =>  'required','errors' =>  ['required' => 'description id is required']],
                'name' => ['rules' =>  'required','errors' =>  ['required' => 'name id is required']],
                'et-icon' => ['rules' =>  'required','errors' =>  ['required' => 'et-icon is required']]
            ]);
            if($check)
            {
                $frmdata = mysql_clean($frmdata);
                $update_data = array(
                    'status' => 'A',
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'description' => $frmdata['description'],
                    'name' => $frmdata['name'],
                    'et_icon' => $frmdata['et-icon']
                );
                $insert = $this->curd_model->insert('service', $update_data);
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
		else if($action == "update_service")
		{
			$check = $this->validate([
                
                'edt_description' => ['rules' =>  'required','errors' =>  ['required' => 'description is required']],
                'edt_name' => ['rules' =>  'required','errors' =>  ['required' => 'name is required']],
                'edt_et-icon' => ['rules' =>  'required','errors' =>  ['required' => 'et-icon is required']]
          
            ]);
            if($check)
            { 
                $frmdata = mysql_clean($frmdata);
                $update_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'description' => $frmdata['edt_description'],
                    'name' => $frmdata['edt_name'],
                    'et_icon' => $frmdata['edt_et-icon'],
					
                );
                $insert = $this->curd_model->update_table('service', $update_data, array('id'=>$frmdata['edt_id']));
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
        else if($action == "change_service_status")
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
                $insert = $this->curd_model->update_table('service', $upload_data, array('id'=>$frmdata['id']));
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
