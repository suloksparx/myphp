<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managepagecontaint extends CI_Controller {
	function  __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library("session");
		$this->load->library('pagination');
		$this->load->model('menu_model');
		$this->load->model('login_model');
		$this->load->model('pagecontaint_model');
		$this->load->model('general_model');

	}
	public function index()
	{
		$result=$this->login_model->checkSession();
		if($result){
			if($this->input->post('submit')=="Submit"){
				$this->multyAction($_POST);
			}
			$data['name'] = $this->input->post('name');
			$data['pageId']     	= $this->uri->segment(3,0);
			$data['page']     	= $this->uri->segment(4,0);
			$data['per_page']   = $this->uri->segment(5,0)?$this->uri->segment(5,0):10;
			$data['orderby'] = $this->uri->segment(6,0)? $this->uri->segment(6,0):"id";
			$data['order'] = $this->uri->segment(7,0)? $this->uri->segment(7,0):"ASC";
                        
			$this->load->view('maintemplate/header');
			$this->load->view('maintemplate/left');
			$this->load->view('pagecontaint/manage',$data);
			$this->load->view('maintemplate/footer');
		}else{
			redirect('welcome');
		}
	}
	public function add($post=0)
	{
		$result=$this->login_model->checkSession();
		if($result){
			$data['staticpagename'] = $this->input->post('staticpagename');
			$data['staticpage_title'] = $this->input->post('staticpage_title');
			$data['staticpage_containt'] = $this->input->post('staticpage_containt');
			$data['pageId']= $this->uri->segment(3,0);
			$path = '../../../js/ckfinder';
			$width = '1000px';
			$this->editor($path, $width);
			
			$this->load->view('maintemplate/header');
			$this->load->view('maintemplate/left');
			$this->load->view('pagecontaint/add',$data);
			$this->load->view('maintemplate/footer');
		}else{
			redirect('welcome');
		}
	}
	function addrecord()
	{
		$staticpage_containt = $this->input->post("staticpage_containt", FALSE);
		/*$this->form_validation->set_rules('langid', 'language', 'trim|required|xss_clean');*/
		$this->form_validation->set_rules('staticpage_title', ' static page title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('staticpage_containt', ' static page containt', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('meta_title', ' static page metatitle', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('key_word', ' static page keyword', 'trim|required|xss_clean');
//                $this->form_validation->set_rules('description', ' static page description', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == TRUE)
		{
                    
			$this->pagecontaint_model->addrecords($_POST,$staticpage_containt);
		}else{
			$this->add($_POST);
			return false;
		}
	}
	public function delete()
	{
		$get['id'] = $this->uri->segment(4,0);
		$get['pageId']= $this->uri->segment(3,0);
		$this->pagecontaint_model->deleteRecord($get);

	}
	public function edit($post=0)
	{
		$result=$this->login_model->checkSession();
		if($result){

			$id = $this->uri->segment(4,0);
			$data =  $this->pagecontaint_model->getrecord($id);
               
               $path = '../../../../js/ckfinder';
			$width = '1000px';
			$this->editor($path, $width);
               
			$data['pageId']= $this->uri->segment(3,0);
			$this->load->view('maintemplate/header');
			$this->load->view('maintemplate/left');
			$this->load->view('pagecontaint/edit',$data);
			$this->load->view('maintemplate/footer');
		}else{
			redirect('welcome');
		}
	}
	function editrecord()
	{
            
		$staticpage_containt = $this->input->post("staticpage_containt", FALSE);
		/*$this->form_validation->set_rules('langid', 'language', 'trim|required|xss_clean');*/
		$this->form_validation->set_rules('staticpage_title', ' static page title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('staticpage_containt', ' static page containt', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run() == TRUE)
		{
			$this->pagecontaint_model->editrecords($_POST,$staticpage_containt);
		}else{
			$this->edit();
			return false;
		}
	}
	public function view()
	{
		$result=$this->login_model->checkSession();
		if($result){
			$id = $this->uri->segment(4,0);
			$data =  $this->pagecontaint_model->getrecord($id);
			$data['pageId']= $this->uri->segment(3,0);
			$this->load->view('pagecontaint/view',$data);
		}else{
			redirect('welcome');
		}
	}
	public function multyAction($post)
	{
		$this->pagecontaint_model->multyAction($post);
	}
	/***************************************for editor *************************/
	function editor($path,$width) {
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = base_url().'js/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
  /***************************************for editor *************************/
	
}
