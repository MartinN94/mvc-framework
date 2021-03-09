<?php

    use App\Libraries\Controller;
    use App\Models\User;

    class Home extends Controller
    {
        public function index()
        {
            $this->view('home/index');
        }
    }
