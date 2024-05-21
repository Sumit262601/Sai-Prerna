<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class About extends BaseController
{
    public function view()
    {}
    public function action_update($action = null)
    {
        $data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if ($action == "change-status-about")
        {
            $check = $this->validate([
                'id' => ['rules' => 'required', 'errors' => ['required' => 'Id is required']],
                'status' => ['rules' => 'required', 'errors' => ['required' => 'Status is required']]
            ]);
            if($check) 
            {
                $frmdata = mysql_clean($frmdata);
                $upload_data = array(
                    'last_update' => date('Y-m-d H:i:s'),
                    'update_by' => $data['session']['user_id'],
                    'status' => (($frmdata['status'] == 'D') ? 'A' : 'D')
                );
                $insert = $this->curd_model->update_table('about', $upload_data, array('id' => $frmdata['id']));

                if ($insert) {
                    $error['success'] = true;
                } else {
                    $error['message']['refrence'] = '<p>Error in Update.</p>';
                }
            } 
            else 
            {
                foreach ($_POST as $key => $value) 
                {
                    if ($this->validation->hasError($key)) 
                    {
                        $error['message'][$key] = $this->validation->getError($key);
                    }
                }
            } 
         
        }

            else if ($action == "upload_about_img") 
            {
				//------------------------------
				$doc1 = $this->request->getFile('about_images');
                if($doc1->isValid())
                {
                    $doc1validationRule = [
                        'about_images' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[about_images]'
                                . '|mime_in[about_images,image/png,image/jpg,image/jpeg]'
                                . '|max_size[about_images,1000]'
                                . '|max_dims[about_images,1990,1080]',
                        ],
                    ];
                    if ($this->validate($doc1validationRule)) {
                        if (! $doc1->hasMoved()) {
                            $file1 = $doc1->getRandomName();
                            $doc1->move(ROOTPATH . '../images/about/', $file1);
							$upload = array(
								'status' => 'A',
								'upload_time' => date('Y-m-d H:i:s'),
								'upload_by' => $data['session']['user_id'],
								'purpose' => 'about',
								'location' => 'about/' . $file1,
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
           else if ($action == "add_about") 
            { 
                $check = $this->validate([
                    'image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'heading' => ['rules' => 'required', 'errors' => ['required' => 'heading Line is required']],
                    'description' => ['rules' => 'required', 'errors' => ['required' => 'Middle Lime is required']],

                ]);
                if ($check) {
                    $frmdata = mysql_clean($frmdata);
                    $update_data = array(
                        'status' => 'A',
                        'last_update' => date('Y-m-d H:i:s'),
                        'update_by' => $data['session']['user_id'],
                        'img' => $frmdata['image_id'],
                        'heading' => $frmdata['heading'],
                        'description' => $frmdata['description'],

                    );
                    $insert = $this->curd_model->insert('about', $update_data);
                    if ($insert) {
                        $error['success'] = true;
                    } else {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                } else 
                {
                    foreach ($_POST as $key => $value) 
                    {
                        if ($this->validation->hasError($key)) 
                        {
                            $error['message'][$key] = $this->validation->getError($key);
                        }
                    }
                }
            }

               else if ($action == "update_about") 
                {
                    $check = $this->validate([

                    'edt_image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'edt_heading' => ['rules' => 'required', 'errors' => ['required' => 'heading Line is required']],
                    'edt_description' => ['rules' => 'required', 'errors' => ['required' => 'Description Lime is required']],
    
                    ]); 
                    if ($check) {
                        $frmdata = mysql_clean($frmdata);
                        $update_data = array(
                            'last_update' => date('Y-m-d H:i:s'),
                            'update_by' => $data['session']['user_id'],
                            'img' => $frmdata['edt_image_id'],
                            'heading' => $frmdata['edt_heading'],
                            'description' => $frmdata['edt_description'],
                        );
                        $insert = $this->curd_model->update_table('about', $update_data, array('id'=>$frmdata['about_id']));
                    if ($insert) {
                        $error['success'] = true;
                    } else {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                } else 
                {
                    foreach ($_POST as $key => $value) 
                    {
                        if ($this->validation->hasError($key)) 
                        {
                            $error['message'][$key] = $this->validation->getError($key);
                        }
                    }
                }
            }
        echo json_encode($error);
    }
}




?>