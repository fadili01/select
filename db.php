<?php
    class Database {
        public $pdo;

        public function __construct($db = "select", $user="root", $pwd="", $host="localhost:3307")
        {
            try {
                $this->pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pwd);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "connected to database $db";
            }
            catch(PDOException $e){
                echo("Connection failed: " . $e->getMessage());
            }
        }
        public function insertUser($email, $password){
            $stmt = $this->pdo->prepare("insert into user(email, password) values (?, ?)");
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([$email, $password]);
        }
    
        public function select(){
            $stmt = $this->pdo->query("SELECT * FROM user");
            $resultaat = $stmt->fetchAll();
            return $resultaat;
        }
    
        public function selectOneUser($id){
            try {
                $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
                $stmt->execute([$id]);
                
                $resultaat = $stmt->fetch();
                
                if ($resultaat === false) {
                    return null;
                }
        
                return $resultaat;
            } catch (PDOException $e) {
                error_log("PDOException in selectOneUser: " . $e->getMessage());
                return null;
            }
        }
    }



?>