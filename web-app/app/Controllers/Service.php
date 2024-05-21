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
                'image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                'description' => ['rules' =>  'required','errors' =>  ['required' => 'description id is required']],
                'name' => ['rules' =>  'required','errors' =>  ['required' => 'name id is required']],
            ]);
            if($check)
            {
                $frmdata = mysql_clean($frmdata);
                $update_data = array(
                    'status' => 'A',
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'img' => $frmdata['image_id'],
                    'description' => $frmdata['description'],
                    'name' => $frmdata['name'],
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
        else if ($action == "upload_service_img") 
        {
			//------------------------------
			$doc1 = $this->request->getFile('service_images');
            if($doc1->isValid())
            {
                $doc1validationRule = [
                    'service_images' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[service_images]'
                            . '|mime_in[service_images,image/png,image/jpg,image/jpeg]'
                            . '|max_size[service_images,1000]'
                            . '|max_dims[service_images,1990,1080]',
                    ],
                ];
                if ($this->validate($doc1validationRule)) {
                    if (! $doc1->hasMoved()) {
                        $file1 = $doc1->getRandomName();
                        $doc1->move(ROOTPATH . '../images/services/', $file1);
						$upload = array(
							'status' => 'A',
							'upload_time' => date('Y-m-d H:i:s'),
							'upload_by' => $data['session']['user_id'],
							'purpose' => 'service',
							'location' => 'services/' . $file1,
						); 
						$sql = $this->curd_model->insert('images', $upload);
						if ($sql) {
							$error['success'] = true;
						} else {
							$error['message']['refrence'] = '<p >Error in storing Image please try again.</p>';
						}
                    }
                }
                else
                {
                    $upload_file = false;
                    $error['message']['file-errors'] = $this->validator->getErrors();
                }
            }
			//--------------------------------- 
        }
		else if($action == "update_service")
		{
			$check = $this->validate([
                
                'edt_image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                'edt_description' => ['rules' =>  'required','errors' =>  ['required' => 'description is required']],
                'edt_name' => ['rules' =>  'required','errors' =>  ['required' => 'name is required']],
          
            ]);
            if($check)
            { 
                $frmdata = mysql_clean($frmdata);
                $update_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'img' => $frmdata['edt_image_id'],
                    'name' => $frmdata['edt_name'],
                    'description' => $frmdata['edt_description'],
					
                );
                $insert = $this->curd_model->update_table('service', $update_data, array('id'=>$frmdata['service_id']));
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
