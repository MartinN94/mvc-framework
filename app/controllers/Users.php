<?php
    use App\Libraries\Controller;

    class Users extends Controller {
        public function __construct() {
            // $this->userModel = $this->model('User');
        }

        public function index() {

            $this->view('users');
        }


    }
