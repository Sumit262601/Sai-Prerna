<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Polyclinics_Ml;

class Gallery extends BaseController
{
    public function view()
    {}
    public function action_update($action = null)
    {
        $data['session'] = $this->session->get('adminlogin');
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        if ($action == "change-status-gallery")
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
                $insert = $this->curd_model->update_table('gallery', $upload_data, array('id' => $frmdata['id']));

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

            else if ($action == "upload_gallery_img") 
            {
				//------------------------------
				$doc1 = $this->request->getFile('gallery_images');
                if($doc1->isValid())
                {
                    $doc1validationRule = [
                        'gallery_images' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[gallery_images]'
                                . '|mime_in[gallery_images,image/png,image/jpg,image/jpeg]'
                                . '|max_size[gallery_images,1800]'
                                . '|max_dims[gallery_images,1990,1080]',
                        ],
                    ];
                    if ($this->validate($doc1validationRule)) {
                        if (! $doc1->hasMoved()) {
                            $file1 = $doc1->getRandomName();
                            $doc1->move(ROOTPATH . '../images/gallery/', $file1);
							$upload = array(
								'status' => 'A',
								'upload_time' => date('Y-m-d H:i:s'),
								'upload_by' => $data['session']['user_id'],
								'purpose' => 'gallery',
								'location' => 'gallery/' . $file1,
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
          else if ($action == "add_gallery") 
            { 
                $check = $this->validate([
                    'image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'alt' => ['rules' => 'required', 'errors' => ['required' => 'Top Line is required']],
                    'detail' => ['rules' => 'required', 'errors' => ['required' => 'Middle Lime is required']],

                ]);
                if ($check) {
                    $frmdata = mysql_clean($frmdata);
                    $update_data = array(
                        'status' => 'A',
                        'last_update' => date('Y-m-d H:i:s'),
                        'update_by' => $data['session']['user_id'],
                        'img' => $frmdata['image_id'],
                        'alt' => $frmdata['alt'],
                        'detail' => $frmdata['detail'],

                    );
                    $insert = $this->curd_model->insert('gallery', $update_data);
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

               else if ($action == "update_gallery") 
                {
                    $check = $this->validate([
                    'edt_image_id' => ['rules' => 'required', 'errors' => ['required' => 'image  is required']],
                    'edt_detail' => ['rules' => 'required', 'errors' => ['required' => 'detail Line is required']],
                    'edt_alt' => ['rules' => 'required', 'errors' => ['required' => 'Middle Lime is required']],
    
                    ]); 
                    if ($check) {
                        $frmdata = mysql_clean($frmdata);
                        $update_data = array(
                            'last_update' => date('Y-m-d H:i:s'),
                            'update_by' => $data['session']['user_id'],
                            'img' => $frmdata['edt_image_id'],
                            'detail' => $frmdata['edt_detail'],
                            'alt' => $frmdata['edt_alt']
                        );
                        $insert = $this->curd_model->update_table('gallery', $update_data, array('id'=>$frmdata['gallery_id']));
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