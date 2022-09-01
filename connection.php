<?php

class Database {

    public $connection;
    
    public function connect(){
        $this->connection = mysqli_connect('127.0.0.1', 'root','','Products');
        if(mysqli_connect_error()){
            return true;
        }else{
            return false;
        }
    }

    public function insertForDvd($sku, $name, $price,$type, $size){
        $sql = "INSERT INTO `products` (sku, name, price, type, size) VALUES ('$sku', '$name', '$price','$type', '$size')";
        $result = mysqli_query($this->connection, $sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function insertForFurniture($sku, $name, $price, $type, $height, $width, $length){
        $sql = "INSERT INTO `products` (sku, name, price, type, height, width, length) VALUES ('$sku', '$name', '$price', '$type', '$height', '$width', '$length')";
        $result = mysqli_query($this->connection, $sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function insertForBook($sku, $name, $price,$type, $weight){
        $sql = "INSERT INTO `products` (sku, name, price, type, weight) VALUES ('$sku', '$name', '$price', '$type', '$weight')";
        $result = mysqli_query($this->connection, $sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function view(){
        $sql = "SELECT * FROM `products`";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function delete($del_id){
        $sql = "DELETE FROM `products` WHERE sku = '".$del_id."'";
        $result = mysqli_query($this->connection, $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }


}

$database = new Database();
$database->connect();


?>