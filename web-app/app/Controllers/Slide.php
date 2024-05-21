<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class Slide extends BaseController
{
    public function view()
    {}
    public function action_update($action = null)
    {
        $data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if ($action == "change-status-slide")
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
                $insert = $this->curd_model->update_table('mini_slide', $upload_data, array('id' => $frmdata['id']));

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

            else if ($action == "upload_slide_img") 
            {
				//------------------------------
				$doc1 = $this->request->getFile('slide_images');
                if($doc1->isValid())
                {
                    $doc1validationRule = [
                        'slide_images' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[slide_images]'
                                . '|mime_in[slide_images,image/png,image/jpg,image/jpeg]'
                                . '|max_size[slide_images,2000]'
                                . '|max_dims[slide_images,1990,1080]',
                        ],
                    ];
                    if ($this->validate($doc1validationRule)) {
                        if (! $doc1->hasMoved()) {
                            $file1 = $doc1->getRandomName();
                            $doc1->move(ROOTPATH . '../images/slides/', $file1);
							$upload = array(
								'status' => 'A',
								'upload_time' => date('Y-m-d H:i:s'),
								'upload_by' => $data['session']['user_id'],
								'purpose' => 'slides',
								'location' => 'slides/' . $file1,
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
          else if ($action == "add_slide") 
            { 
                $check = $this->validate([
                    'image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'alt' => ['rules' => 'required', 'errors' => ['required' => 'Top Line is required']],

                ]);
                if ($check) {
                    $frmdata = mysql_clean($frmdata);
                    $update_data = array(
                        'status' => 'A',
                        'last_update' => date('Y-m-d H:i:s'),
                        'update_by' => $data['session']['user_id'],
                        'img' => $frmdata['image_id'],
                        'alt' => $frmdata['alt'],

                    );
                    $insert = $this->curd_model->insert('mini_slide', $update_data);
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

               else if ($action == "update_slide") 
                {
                    $check = $this->validate([

                    'edt_image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'edt_alt' => ['rules' => 'required', 'errors' => ['required' => 'Middle Lime is required']],
    
                    ]); 
                    if ($check) {
                        $frmdata = mysql_clean($frmdata);
                        $update_data = array(
                            'last_update' => date('Y-m-d H:i:s'),
                            'update_by' => $data['session']['user_id'],
                            'img' => $frmdata['edt_image_id'],
                            'alt' => $frmdata['edt_alt'],
                        );
                        $insert = $this->curd_model->update_table('mini_slide', $update_data, array('id'=>$frmdata['slide_id']));
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