<?php
    use App\Libraries\Controller;
    use App\Models\User;

    class Users extends Controller
    {
        private $userModel;

        public function __construct()
        {
            $this->userModel = new User;
        }

        public function register()
        {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'nameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'type' => '',
                    'subtype' => '',
                    'nameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => '',
                    'skillsError' => ''
                ];

                //Checking user skills and assigning types and subtypes
                $skills = $_POST['skills'];
                
                $data['subtype'] = join(',', array_diff($skills, array('backend', 'frontend')));

                if (in_array("backend", $skills) && in_array("frontend", $skills)) {
                    $data['type'] = 'backend,frontend';
                } elseif (in_array("backend", $skills) && !in_array("frontend", $skills)) {
                    $data['type'] = 'backend';
                } else {
                    $data['type'] = 'frontend';
                }

                //Validate skills
                if (empty($skills)) {
                    $data['skillsError'] = 'Please select skills';
                } elseif (!in_array("backend", $skills) && !in_array("frontend", $skills)) {
                    $data['skillsError'] = 'Please select Backend or Frontend';
                }

                // Validate username on letters
                $nameValidation = "/^[a-zA-Z]*$/";
                if (empty($data['name'])) {
                    $data['nameError'] = 'Please enter name';
                } elseif (!preg_match($nameValidation, $data['name'])) {
                    $data['nameError'] = 'Name can only contain letters';
                }

                //Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email';
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = 'Please enter correct email format';
                } else {
                    //Check if email exists
                    if ($this->userModel->findUserByEmail($_POST['email'])) {
                        $data['emailError'] = 'Email is already taken';
                    }
                }

                //Validate password on lenght and numeric values
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter password';
                } elseif (strlen($data['password']) < 6) {
                    $data['passwordError'] = 'Password must be at least 8 characters';
                } elseif (preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must contais letters and numbers';
                }

                //Validate confirm password
                if (empty($data['confirmPassword'])) {
                    $data['confirmPasswordError'] = 'Please enter password confirmation';
                } else {
                    if ($data['password'] != $data['confirmPassword']) {
                        $data['confirmPasswordError'] = 'Passwords do not match, please try again';
                    }
                }



                //Check if validation is passed and error fields are empty
                if (empty($data['nameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                    
                    //Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //Register user with model function
                    if ($this->userModel->register($data)) {
                        //Redirect to login page
                        header("Location: /users/login");
                    } else {
                        die('Something went wrong...');
                    }
                }
            }

            $this->view('users/register', $data);
        }

        public function login()
        {
            //Check for post
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => ''
                ];

                //Validate email
                if (empty($data['email'])) {
                    $data['emailError'] = 'Please enter email';
                }

                //Validate email
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter password';
                }

                //Check if validation is passed and error fields are empty
                if (empty($data['emailError']) && empty($data['passwordError'])) {
                    $loggedUser = $this->userModel->login($data['email'], $data['password']);

                    //Check if logged user is set
                    if ($loggedUser) {
                        $this->createUserSession($loggedUser);
                    } else {
                        $data['passwordError'] = 'Password or email is incorrect';

                        $this->view('users/login', $data);
                    }
                }
            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'emailError' => '',
                    'passwordError' => ''
                ];
            }

            $this->view('users/login', $data);
        }

        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->name;
            $_SESSION['email'] = $user->email;

            header('location:../home/index');
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);

            header('location: login');
        }

        public function search()
        {
            if (isLogged()) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                    if (!empty($_POST['keyword']) || !empty($_POST['type'])) {
                        $users = $this->userModel->search($_POST['keyword'], $_POST['type']);
                        
                        $subtypes = [];
                        foreach ($users as $key => $value) {
                            $subtypes[] = join(',', [$value['subtype']]);
                        }
                        $textToCount = [];
                        foreach ($subtypes as $key => $value) {
                            $textToCount[] = explode(',', $value);
                        }
                        
                        $angular = 0;
                        $angularjs = 0;
                        $react = 0;
                        $reactNative = 0;
                        $vue = 0;
                        $php = 0;
                        $symfony = 0;
                        $silex = 0;
                        $laravel = 0;
                        $lumen = 0;
                        $nodejs = 0;
                        $express = 0;
                        $nestjs = 0;
                        foreach ($textToCount as $key => $v) {
                            if (array_search('angular', $v) != false) {
                                $angular++;
                            }
                            if (array_search('angularjs', $v) != false) {
                                $angularjs++;
                            }
                            if (array_search('react', $v) != false) {
                                $react++;
                            }
                            if (array_search('react-native', $v) != false) {
                                $reactNative++;
                            }
                            if (array_search('vue', $v) != false) {
                                $vue++;
                            }
                            if (array_search('php', $v) != false) {
                                $php++;
                            }
                            if (array_search('symfony', $v) != false) {
                                $symfony++;
                            }
                            if (array_search('silex', $v) != false) {
                                $silex++;
                            }
                            if (array_search('laravel', $v) != false) {
                                $laravel++;
                            }
                            if (array_search('lumen', $v) != false) {
                                $lumen++;
                            }
                            if (array_search('nodejs', $v) != false) {
                                $nodejs++;
                            }
                            if (array_search('express', $v) != false) {
                                $express++;
                            }
                            if (array_search('nestjs', $v) != false) {
                                $nestjs++;
                            }
                        }
                        
                        $counter = [
                            'angular' => $angular,
                            'angularjs' => $angularjs,
                            'react' => $react,
                            'reactNative' => $reactNative,
                            'vue' => $vue,
                            'php' => $php,
                            'symfony' => $symfony,
                            'silex' => $silex,
                            'laravel' => $laravel,
                            'lumen' => $lumen,
                            'nodejs' => $nodejs,
                            'express' => $express,
                            'nestjs' => $nestjs
                        ];

                        $data = [
                            'users' => $users,
                            'counter' => $counter
                        ];

                        unset($_SESSION['keyword']);
                        unset($_SESSION['type']);

                        $this->view('users/results', $data, $subtypes);
                    } else {
                        $data = [
                            'message' => 'Enter keyword or select type to search'
                        ];

                        $this->view('home/index', $data);
                    }
                }
            } else {
                $_SESSION['keyword'] = $_POST['keyword'];
                $_SESSION['type'] = $_POST['type'];

                $data = [
                    'message' => 'Please log in or register to be able to search'
                ];

                $this->view('users/login', $data);
            }
        }
    }
