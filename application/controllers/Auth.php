<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database('Auth_model');
        $this->load->library('form_validation');
        $this->load->model('Menu_model');
        
    }
    public function index()
    {
        if($this->session->userdata('email')){
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if($this->form_validation->run() == false){
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');

        } else {
            $this->_login();
        }
                  
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // usernya ada
        if($user){
            //jika usernya aktif
          if($user['is_active'] == 1) {
            
            //cek password
            if(password_verify($password, $user['password'])){
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">  
                Wrong password! </div>' );
                redirect('auth');
            }

          } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">  
            This email has beem activated! </div>' );
            redirect('auth');
          }

        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">  
            Email is not registered! </div>' );
            redirect('auth');
        }
    }

    
    public function register()
    {
        if($this->session->userdata('email')){
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
            'is_unique' => 'This email has alredy registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',[
            'matches' => 'Password dont too match',
            'min_length' => 'Password must be at least 3 characters long',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password1]');
        
        if( $this->form_validation->run() ==false) {

            $data['title'] = 'WPU User Register';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
            
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name',true)),
                'email' => htmlspecialchars($this->input->post('email',true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'),
                 PASSWORD_DEFAULT),
                 'role_id' => 2,
                 'is_active' => 1,
                 'date_created' => time ()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">  
            Congratulation! your account has been created. Please Login </div>' );
            redirect('auth');
        }    
    }


    public function logout(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">  
        You hve been logout </div>' );
        redirect('auth');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Menu';
        
        // Ambil email dari session
        $email = $this->session->userdata('email');
    
        // Ambil data user berdasarkan email
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
    
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();
    
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data); // <-- Data $user dikirim ke sini
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu');
            $this->db->where('id', $id);
            $this->db->update('user_menu', ['menu' => $menu]);
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been updated!</div>');
            redirect('menu');
        }
    }
    
public function delete($id)
{
    // Debugging untuk memastikan parameter $id terkirim
    var_dump($id); 
    if (!$id) {
        show_error('Invalid ID provided');
    }

    // Proses hapus data
    $this->db->where('id', $id);
    $this->db->delete('user_menu');

    // Cek apakah data berhasil dihapus
    if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted!</div>');
    } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to delete menu!</div>');
    }
    
    // Redirect ke halaman menu
    redirect('menu');
}


public function blocked(){
    $this->load->view('auth/blocked');
}



}






