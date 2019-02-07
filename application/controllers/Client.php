<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        define('REST_API_SERVER','http://localhost/restful-services-in-codeigniter');
    }
	public function index()
	{
		
	}


	public function isbn()
	{	
		if (!empty($this->input->post("isbn"))) 
		{
			$fields = array(
				'isbn'=> $this->input->post("isbn")
			);
			$fields_string ="";
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			$url = REST_API_SERVER.'/api/bookbyIsbn?'.$fields_string;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_exec($ch);
			curl_close($ch);
		}
		else
		{
			$this->load->view('isbn');
		}
	}

	public function allbooks()
	{	
		$url = REST_API_SERVER.'/api/books';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_exec($ch);
		curl_close($ch);
	}

	public function addbook()
	{
		$this->load->view('addbook');
	}

	public function addbook_post()
	{
		if (!empty($this->input->post("name"))) 
		{
			$url = REST_API_SERVER.'/api/addbook';
			$fields = array(
				'name'=> $this->input->post("name"),
				'price'=> $this->input->post("price"),
				'author'=> $this->input->post("author"),
				'language'=> $this->input->post("language"),
				'isbn'=> $this->input->post("isbn"),
				'publish_date'=> $this->input->post("publish_date"),
				'category'=> $this->input->post("category")
			);

			$fields_string ="";
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_exec($ch);
			curl_close($ch);
		}

	}

	public function updatebook()
	{
		$this->load->view('updatebook');
	}

	public function updatebook_post()
	{
		if (!empty($this->input->post("id"))) 
		{
			$url = REST_API_SERVER.'/api/updatebook';
			$fields = array(
				'id'=> $this->input->post("id"),
				'name'=> $this->input->post("name"),
				'price'=> $this->input->post("price"),
				'author'=> $this->input->post("author"),
				'language'=> $this->input->post("language"),
				'isbn'=> $this->input->post("isbn"),
				'publish_date'=> $this->input->post("publish_date"),
				'category'=> $this->input->post("category")
			);

			$fields_string ="";
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_exec($ch);
			curl_close($ch);
		}

	}

	public function deletebook()
	{
		$this->load->view('deletebook');
	}

	public function deletebook_post()
	{
		if (!empty($this->input->post("id"))) 
		{
			$url = REST_API_SERVER.'/api/deletebook';
			$fields = array(
				'id'=> $this->input->post("id")
			);
			$fields_string ="";
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
			curl_exec($ch);
			curl_close($ch);
		}

	}
}
