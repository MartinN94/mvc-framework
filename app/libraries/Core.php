<?php
    namespace App\Libraries;

    /*
    * App Core Class
    * Creates URL & loads core controller
    * URL FORMAT - /controller/method/params
    */
    class Core
    {
        protected $currentController = 'Home';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url = $this->getUrl();
            unset($url[0]);

            // Look in BLL for first value
            if (!empty($url[1]) && file_exists('../app/controllers/' . ucwords($url[1]). '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[1]);
                // Unset 0 Index
                unset($url[1]);
            } elseif (isset($url[1]) && !file_exists('../app/controllers/' . ucwords($url[1]). '.php')) {
                $this->currentController = '';
                echo '<img style="margin: 0 auto; display:block;" src="/public/img/404.png">';
            }
            
                

            // Require the controller
            require_once '../app/controllers/'. $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of url
            if (isset($url[2])) {
                // Check to see if method exists in controller
                if (method_exists($this->currentController, $url[2])) {
                    $this->currentMethod = $url[2];
                    // Unset 1 index
                    unset($url[2]);
                } else {
                    echo '<img style="margin: 0 auto; display:block;" src="/public/img/404.png">';
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array(array($this->currentController, $this->currentMethod), array( $this->params));
        }

        public function getUrl()
        {
            if (isset($_SERVER['REQUEST_URI'])) {
                $url = rtrim($_SERVER['REQUEST_URI'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
