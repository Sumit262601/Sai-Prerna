<?php
//if(!defined('BASEPATH')) exit('No direct script access allowed');

$CI_INSTANCE = [];  # It keeps a ref to global CI instance

function register_ci_instance(\App\Controllers\BaseController &$_ci)
{
    global $CI_INSTANCE;
    $CI_INSTANCE[0] = &$_ci;
}


function &get_instance(): \App\Controllers\BaseController
{
    global $CI_INSTANCE;
    return $CI_INSTANCE[0];
}

if ( ! function_exists('data_encode'))
{
	function data_encode($string)
	{
		$ciphering = "AES-128-CTR"; 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$encryption_iv = '1234567891011121'; 
		$encryption_key = "GeniusWebSolutionsWorkingWithPCTIL"; 
		$encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv); 
		return $encryption;
	}
}

if ( ! function_exists('data_decode'))
{
	function data_decode($string)
	{
		$ciphering = "AES-128-CTR"; 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$decryption_iv = '1234567891011121'; 
		$decryption_key = "GeniusWebSolutionsWorkingWithPCTIL"; 
		$decryption=openssl_decrypt ($string, $ciphering, $decryption_key, $options, $decryption_iv); 
		return $decryption;
	}
}

if ( ! function_exists('mysql_clean'))
{
	function mysql_clean($data)
	{
		$clean_input = array();
		if(is_array($data))
		{
			foreach($data as $k => $v)
			{
				$clean_input[$k] = mysql_clean($v);
			}
		}
		else
		{
			$data=str_replace('{','',$data);
			$data=str_replace('}','',$data);
			$data=str_replace('(','',$data);
			$data=str_replace(')','',$data);
			$data=str_replace('<','',$data);
			$data=str_replace('>','',$data);
			$data=str_replace('"','',$data);
			$data=str_replace("'",'',$data);
			$data=str_replace(';','',$data);
			$data=str_replace('^','',$data);
			$clean_input = trim(htmlentities(strip_tags($data)));
		}
		$not_allowd_char = array("'", '"', ";");
		return str_replace($not_allowd_char, '', $clean_input);
	}
}


if(!function_exists('get_menu'))
{
	function get_menu()
	{
		$ci =& get_instance(); 
		$data['session'] = $ci->session->get('adminlogin');
		/*----------Prepare Tab---------------*/
		$join = array(
			array(
				'table'=>'tab',
				'condition' => 'user_access.tab_id=tab.id',
				'type' => 'left'
				),
			array(
				'table' => 'tab_group',
				'condition' => 'tab.tab_group=tab_group.id',
				'type' => 'left'
			)
		);
		//$whr = array('user_id'=>$data['session']['user_id'],'user_access.status'=>'A');
		$whr = array('user_access.status'=>'A');
		$tab = $ci->curd_model->jointable('tab.name,tab.page_url,tab_group.themify,tab_group.name as group_name,user_access.other_action', 'user_access', $join, $whr, 'true', 'tab_group.id', 'desc');
		foreach($tab as $tb)
		{
			
			$data['tab'][$tb->group_name]['icon'] = $tb->themify;
			$data['tab'][$tb->group_name]['menu'][$tb->name] = $tb->page_url;
			$data['url'][] = $tb->page_url;
			$data['action_access'][$tb->page_url] = $tb->other_action;
			
		}
		/*---------------Prepare Tab---------------*/
		return $data;
	}
}

if(!function_exists('web_file_location'))
{
    function web_file_location()
    {
		$var = "../";
        return $var;
    }   
}


if(!function_exists('web_url'))
{
    function web_url($url = '')
    {
		$var = "http://wethevirtual.com/".$url;
		//$var = "http://localhost/wethevirtual/";
        return $var;
    }   
}



?>