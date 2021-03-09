<?php
    namespace App\Models;

    use App\Libraries\Database;

    class User
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getUsers()
        {
            $this->db->query("SELECT * FROM users");
            $result = $this->db->resultSet();
            return $result;
        }

        //Find user by email, passed in by the controller
        public function findUserByEmail($email)
        {
            //Prepared statement
            $this->db->query('SELECT * FROM users WHERE email = :email');

            //Email param will be binded with the email variable
            $this->db->bind(':email', $email);

            //Check if email in alredy registered
            if ($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function register($user)
        {
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

            //Bind values
            $this->db->bind(':name', $user['name']);
            $this->db->bind(':email', $user['email']);
            $this->db->bind(':password', $user['password']);

            //Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
