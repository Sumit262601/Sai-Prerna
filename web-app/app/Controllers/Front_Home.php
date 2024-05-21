<?php

namespace App\Controllers;

class Front_Home extends BaseController
{
    public function index()
    {
      // $data['page_info'] = $this->curd_model->get_1("*","web_pages",array('status'=>'A'), 'id','ACS');
      

      $images = $this->curd_model->get_all('*', 'images', array('status'=>'A'), 'id', 'ACS');
      foreach($images as $img)
      {
        $data['image_detail'][$img->id] = $img->location;
      }
      $settings = $this->curd_model->get_all('*', 'web_settings', array('status'=>'A'), 'id', 'ASC');
      foreach($settings as $set)
      {
        $data['settings'][$set->name] = $set->value;
      }
      
      $data['menus'] = $this->curd_model->get_all('*','menu',array('status'=>'A'),'sequence','ASC');
      $data['gallerys'] = $this->curd_model->get_all('*', 'gallery', array('status'=>'A'), 'id', 'ACS');
      $data['slider'] = $this->curd_model->get_all('*', 'home_slider', array('status'=>'A'), 'id', 'ACS');
      $data['slides'] = $this->curd_model->get_all('*', 'mini_slide', array('status'=>'A'), 'id', 'ACS');
      $data['about'] = $this->curd_model->get_all('*', 'about', array('status'=>'A'), 'id', 'ACS');
      $data['services'] = $this->curd_model->get_all('*', 'service', array('status'=>'A'), 'id', 'ACS');

      $visitor = $this->curd_model->get_all('*', 'visitor', array(), 'id', 'DESC');
      $data['visitor_count'] = count($visitor);
      return view('home', $data);
    }
}