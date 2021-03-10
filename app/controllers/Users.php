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
                    'nameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => ''
                ];

                $nameValidation = "/^[a-zA-Z]*$/";
                $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

                // Validate username on letters
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
                        
                        //Redirect to home page
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
    }
