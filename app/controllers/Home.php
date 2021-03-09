<?php
    use App\Libraries\Controller;

    class Home extends Controller {
        public function __construct() {
            $this->userModel = $this->model('User');
        }

        public function index() {
            $users = $this->userModel->getUsers();
            
            $data = [
                'title' => 'Home page',
                'users' => $users
            ];

            $data = json_encode($data);

            $this->view('index', $data);
        }
    }
