<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $user_model;

    public function __construct(){
        $this->user_model=new UserModel();
    }

    public function register($data) {
        $user_name=trim($data['name'] ?? '');
        $user_email=trim($data['email'] ?? '');
        $user_pass=$data['password'] ?? '';

        if ($user_name=='' || $user_email=='' || $user_pass=='') {
            return ['status'=>'error', 'message'=>'Please fill all fields'];
        }

        if ($this->user_model->check_email($user_email)) {
            return ['status'=>'error', 'message'=>'This email is already registered'];
        }

        $hashed_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        $added = $this->user_model->add_user($user_name, $user_email, $hashed_pass);

        if ($added) {
            return['status'=>'success', 'message'=>'User registered successfully'];
        } else {
            return['status'=>'error', 'message'=>'Registration failed'];
        }
    }

    public function login($form_data) {
        $email = trim($form_data['email'] ?? '');
        $password = $form_data['password'] ?? '';
    
        if (!$email || !$password) {
            return ['status' => 'fail', 'message' => 'Email and password are needed'];
        }
    
        $found_user = $this->user_model->get_user_by_email($email);
    
        if (!$found_user || !password_verify($password, $found_user['password_hash'])) {
            return ['status' => 'fail', 'message' => 'Wrong email or password'];
        }
    
        $login_token = bin2hex(random_bytes(16));
        $this->save_token($login_token, $found_user['id']);
    
        return ['status' => 'success', 'message' => 'Logged in', 'token' => $login_token];
    }
    
    private function save_token($token, $user_id) {
        $file_path = __DIR__ . '/../storage/tokens.json';
    
        $all_tokens = file_exists($file_path) ? json_decode(file_get_contents($file_path), true) : [];
        $all_tokens[$token] = ['user_id' => $user_id, 'time' => time()];
    
        file_put_contents($file_path, json_encode($all_tokens, JSON_PRETTY_PRINT));
    }

    public function logout_user($input) {
        $token_input = trim($input['token'] ?? '');
    
        if (!$token_input) {
            return ['status' => 'fail', 'message' => 'Token is missing'];
        }
    
        $token_file = __DIR__ . '/../storage/tokens.json';
    
        if (!file_exists($token_file)) {
            return ['status' => 'fail', 'message' => 'Token storage not found'];
        }
    
        $all_tokens = json_decode(file_get_contents($token_file), true);
    
        if (!isset($all_tokens[$token_input])) {
            return ['status' => 'fail', 'message' => 'Token not valid'];
        }
    
        unset($all_tokens[$token_input]);
    
        file_put_contents($token_file, json_encode($all_tokens, JSON_PRETTY_PRINT));
    
        return ['status' => 'success', 'message' => 'User logged out'];
    }    
    
}
