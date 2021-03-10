<?php
session_start();

        function isLogged()
        {
            if (isset($_SESSION['user_id'])) {
                return true;
            } else {
                return false;
            }
        }

        function userName()
        {
            if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
            }
        }
