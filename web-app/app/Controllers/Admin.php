<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class Admin extends BaseController
{
    public function view($url = "")
    {
        $data['session'] = $this->session->get('adminlogin');
        $data = get_menu();
        $url = explode('.',$url);
			if($url[0] != "dashboard")
			{
				$data['other_action'] = explode(" ",$data['action_access'][$url[0]]);
			}	
			if($url[0] == 'dashboard')
			{
				
			}
			else if($url[0] == "user")
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$user_type = $this->curd_model->get_all('*', 'user_type', array(), 'name', 'ASC');
				foreach($user_type as $ut)
				{
					$data['user_type'][$ut->user_key] = $ut;
				}
				$data['emp'] = $this->curd_model->get_all('*', 'login', array('status'=>$data['status']), 'f_name', 'ASC');
			}
			else if($url[0] == "slider")
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'home_slider','status'=>'A'), 'id', 'ACS');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['slider'] = $this->curd_model->get_all('*', 'home_slider', array('status'=>$data['status']), 'id', 'DESC');
			}
			else if($url[0] == "service" )
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'service','status'=>'A'), 'id', 'ACS');
				$data['images'] = array();
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['service'] = $this->curd_model->get_all('*','service',array('status'=>$data['status']),'id','DESC');
			}
			else if($url[0] == "about" )
			{
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'about','status'=>'A'), 'id', 'ACS');
				$data['images'] = array();
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['about'] = $this->curd_model->get_all('*','about',array('status'=>$data['status']),'id','DESC');
			}
			else if($url[0] == "gallery" )
			{
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'gallery','status'=>'A'), 'id', 'ACS');
				$data['images'] = array();
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['gallery'] = $this->curd_model->get_all('*','gallery',array('status'=>$data['status']),'id','DESC');
			}
			else if($url[0] == "web_pages" )
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['pages'] = $this->curd_model->get_all('*','web_pages',array('status'=>$data['status']),'id','DESC');
			}
			else if($url[0] == "slide" )
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$data['images'] = array();
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'slides'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['slides'] = $this->curd_model->get_all('*','mini_slide',array('status'=>$data['status']),'id','DESC');
			}
			else if($url[0] == "menu" )
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['menu'] = $this->curd_model->get_all('*','menu',array('status'=>$data['status']),'sequence','ASC');
			}
			else if($url[0] == "web_settings" )
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['web_settings'] = $this->curd_model->get_all('*','web_settings',array('status'=>$data['status']),'id','ASC');
			}
			
			
			


			
			else if($url[0] == "logout")
			{
				session_destroy();
				redirect(base_url());
			}
			
			if(in_array($url[0], $data['url']) || $url[0] == "dashboard")
			{
				return view('admin/'.$url[0], $data);
			}
			else
			{
				show_404();
			}
		}
	}
?>