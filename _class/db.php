<?php
class db{
    private $conn;
    private $dbHost = "localhost:3307";
    private $dbUser = "bobshop";
    private $dbPass = "bob123";
    private $dbName = "db_bobshop";

    function __construct(){
        $this->conn = $this->initConn();
    }
    /** Init DB connection */
    private function initConn(){
        $conn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        return $conn;
    }
    public function DB_SELECT($sql){
        $query = mysqli_query($this->conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            $results[] = $row;
        }
        if (!empty($results)) {
            return $results;
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function DB_PRODUCT_INSERT($name, $description, $category, $imgUrl, $price, $stock){
        $stmt = $this->conn->prepare("insert into products (name, description, category, imgUrl, price, stock) values (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $name, $description, $category, $imgUrl, $price, $stock);
        $stmt->execute();
    }
    public function DB_PRODUCT_UPDATE($name, $description, $category, $price, $stock, $id){
        $stmt = $this->conn->prepare("update products set name=?, description=?, category=?, price=?, stock=? where id=?");
        $stmt->bind_param("sssiii", $name, $description, $category, $price, $stock, $id);
        $stmt->execute();
    }

    function runQuery($query) {
        $result = mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
        if (!empty($results)) {
            return $results;
        } else {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function login(){
        $cred_user = $_POST['email'];
        $cred_pass = $_POST['password'];
        $result = $this->conn->query("select email from users where email ='". $cred_user ."' and password = '". $cred_pass ."' ");
        $user = mysqli_fetch_array($result);
        $_SESSION['user'] = $user['email'];
        $_SESSION['isAdmin'] = $user['isAdmin'];
        header('Location: /');
    }
}
