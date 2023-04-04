<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends CI_Controller{


    function __construct()
	{
		parent::__construct();
		$this->load->model('testmodel');
        $this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation'));
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding');

        
	}


	public function index(){
       
        $this->load->view('post/header');
        $this->load->library('session');
        if($this->session->userdata('user')){
			redirect('new_home');
            // $this->load->view('new_home');
		}else{
			$this->load->view('login');
		}


        
       
	}
    public function user_index(){
        $this->load->view('post/user_header');
        $this->load->library('session');
        if($this->session->userdata('user')){
			redirect('ordinary_home');
            // $this->load->view('new_home');
		}else{
			$this->load->view('login');
		}





        // $data['data'] = $this->testmodel->get_entries('tbl_list');
		// $this->load->view('post/user_home',$data);
	
	}

    public function home(){
		//load session library
		$this->load->library('session');
 
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			// $this->load->view('post/home');



            
            $data['data'] = $this->testmodel->get_entries('tbl_list');
           
            $this->load->view('post/home',$data);
		}
		else{
            $this->session->set_flashdata('error','You cannot go back');
            $this->load->view('post/login_page');
            
		}
    
 
	}


    public function user_home(){
        $this->load->library('session');
 
		//restrict users to go to home if not logged in
		if($this->session->userdata('user')){
			// $this->load->view('post/home');



            
            $data['data'] = $this->testmodel->get_entries('tbl_list');
           
            $this->load->view('post/user_home',$data);
		}
		else{
			$this->load->view('post/login_page');
            $this->session->set_flashdata('error','You cannot go back');
		}

    }

    public function practice(){
        echo "practice display controller";
    }
    public function create(){
        $this->load->view('post/create');
    }
    public function login_page(){
        $this->load->view('post/login_page');
    }

    public function login(){
        // $this->load->view('post/login');

        $this->load->library('session');
 
		$username = $_POST['username'];
		$password = $_POST['password'];
        $data = $this->testmodel->login($username, $password);

        $Old_username = $this->input->post('userID');
        $Old_password = $this->input->post('passID');
 
		

        $this->db->where('username', $username);
        $this->db->where('password', $password);
      
      
        $query = $this->db->get('tbl_list');
        

        
 
		if($data){
			$this->session->set_userdata('user', $data);
            $this->session->set_userdata('role',$query->row()->type);
            if($this->session->userdata('role')==0){
                $data = array('response' => "success", 'role' => 'Admin');
                // var_dump($data);
                redirect('home');
            }  
            if($this->session->userdata('role')==1){
                $data = array('response' => "success", 'role' => 'User');
                redirect('user_home');
                // var_dump($data);
            }
			
		}
		else{
			header('location: login_page');
			$this->session->set_flashdata('error','Invalid login. User not found');
            // echo "no accounts";


            
		} 
    }
    
   
    public function login_entry(){
        $username = $this->input->post('userID');
        $password = $this->input->post('passID');

      $this->db->where('username', $username);
      $this->db->where('password', $password);
      
      
      $query = $this->db->get('tbl_list');
      $find_user=$query->num_rows($query);

      if($find_user>0) {
       
            
            $this->load->library('session');
            
            $new_username = $_POST['username'];
            $new_password = $_POST['password'];

            $data = $this->testmodel->login($new_username,$new_password);
            
            if($data){
                $this->session->set_userdata('user', $data);
                $this->session->set_userdata('username',$query->row()->username);
                $this->session->set_userdata('firstname',$query->row()->firstName);
                $this->session->set_userdata('lastname',$query->row()->lastName);
                $this->session->set_userdata('role',$query->row()->type);
                $this->session->set_userdata('log','Logged');
                $this->session->set_flashdata('suc','Login Granted');

                if($this->session->userdata('role')==0){
                    $data = array('response' => "success", 'role' => 'Admin');

                    
                }   
                if($this->session->userdata('role')==1){
                    $data = array('response' => "success", 'role' => 'User');
                }

            }
            else{
                $this->session->set_flashdata('error','invalid login. User not found');
            }

            
        
            
            
            


            // $data = array('response' => "success", 'message' => 'Login successful');
            // redirect('testcontroller/index');
           
        // redirect('home');

    } else {
        $this->session->set_flashdata('warning','Incorrect Authentication');
        $data = array('response' => 'error', 'message' => 'Invalid username or password');
    }

      
        echo json_encode($data);
    }

    public function store(){
                $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'firstName' => $this->input->post('firstname'),
                'lastName' => $this->input->post('lastname'),
                'type' => $this->input->post('role')

            );
             $this->db->insert('tbl_list', $data);
             echo 'success';


        }


    public function delete(){
       if($this->input->is_ajax_request()){
        $del_id = $this->input->post('del_id');

        if($this->testmodel->delete_entry($del_id)){
            $data = array('response'=>"success");
        }else{
            $data = array('response'=>"error");
        }
        echo json_encode($data);
       }
    }
    public function search()
    {
      $searchTerm = $this->input->post('searchTerm');
      $data['results'] = $this->testmodel->search($searchTerm); // call the search method of your model
      $this->load->view('post/results', $data); // load a view file that displays the search results
    }
    public function user_search(){
      $searchTerm = $this->input->post('searchTerm');
      $data['results'] = $this->testmodel->search($searchTerm); // call the search method of your model
      $this->load->view('post/user_results', $data); // load a view file that displays the search results
    }
 
  
    public function results(){
        $this->load->view('post/results');
    }
   
    public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->testmodel->get_entries();
			echo json_encode($posts);
		} else {
			echo "'No direct script access allowed'";
		}
	}

    public function edit(){
        if($this->input->is_ajax_request()){
            $this->input->post('edit_id');
            $edit_id = $this->input->post('edit_id');
            
            if($post = $this->testmodel->single_entry($edit_id)){
               $data = array('response'=>"success",'post'=> $post);
            }else{
            $data = array('response'=>"error at edit method","message"=>'failed');
            } 
        }else{
            
            echo "wazzup";
        }
        echo json_encode($data);
    
        
    }

    //ajax create

    // public function edit(){
    //     $var_data = $this->input->post();
    //     if($this->testmodel->insert_entry($var_data)){
    //         $data = array('response'=> 'success','message' => 'Success!');
    //     }else{
    //         $data = array('response'=>'success','message'=>'Fail');
    //     }
       

    // }

    public function update(){
        if($this ->input->is_ajax_request()){
            // $this->form_validation->set_rules('fname','Name','required');
            // $this->form_validation->set_rules('lname','Name','required');

            // if($this->form_validation->run()==FALSE){
            //     $data = array('responce' =>'error','message'=>validation_errors());
            // }
            // else{
                $data['id'] = $this->input->post('edit_id');
                $data['firstName'] = $this->input->post('edit_first');
                $data['lastName'] = $this->input->post('edit_last');
                $data['type'] = $this->input->post('edit_role');
                if($this->testmodel->insert_entry($data)){
                    $data = array('response'=>'success','message'=>'success');
                }else{
                    $data = array('response'=>'error','message'=>'failed');
                }
            // }
        }else{
            echo "No direct script access allowed";
        }
        echo json_encode($data);
    }

   
    

    public function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('login_page');
	}




    }
