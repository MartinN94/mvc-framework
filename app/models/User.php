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

        //Find user by email, passed in by the controller
        public function findUserByEmail($email)
        {
            //Prepared statement
            $this->db->query('SELECT * FROM users WHERE email = :email');

            //Email param will be binded with the email variable
            $this->db->bind(':email', $email);

            //Check if email in alredy registered
            if ($this->db->rowCount > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function register($user)
        {
            $this->db->query('INSERT INTO users (name, email, password, type, subtype) VALUES (:name, :email, :password, :type, :subtype)');

            //Bind values
            $this->db->bind(':name', $user['name']);
            $this->db->bind(':email', $user['email']);
            $this->db->bind(':password', $user['password']);
            $this->db->bind(':type', $user['type']);
            $this->db->bind(':subtype', $user['subtype']);

            //Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function login($email, $password)
        {
            $this->db->query('SELECT * FROM users WHERE email = :email');

            //Bind
            $this->db->bind(':email', $email);
            
            $row = $this->db->single();

            $hashedPassword = $row->password;

            if (password_verify($password, $hashedPassword)) {
                return $row;
            } else {
                return false;
            }
        }

        public function getUsers()
        {
            $this->db->query("SELECT * FROM users");
            $result = $this->db->resultSet();
            return $result;
        }

        public function search($keyword, $type)
        {
            $name = $keyword;
            $this->db->query('SELECT name, email, type, subtype FROM users WHERE type = :type OR name = :name OR email LIKE :email');

            $this->db->bind(':name', $name);
            $this->db->bind(':email', '%'. $keyword. '%');
            $this->db->bind(':type', '%'.$type.'%');

            $result = $this->db->resultSet();
            return $result;
        }
    }
