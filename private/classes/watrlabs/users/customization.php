<?php

namespace watrlabs\authentication;

class customization {
    public function __construct() {
        return "Hello World!";
    }
    
    public function changeusername($username) {
        
        if(empty($username)){
            $returnvar = array(
            "code" => "400",
            "message" => "Username is empty.",
            );
            
            return json_encode($returnvar);
            exit();
        }
        
        if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            $returnvar = array(
                "code" => "400",
                "message" => "Username contains special characters.",
            );
            return json_encode($returnvar);
            exit();
        }
        
        if (strpos($username, ' ') !== false) {
            $returnvar = array(
            "code" => "400",
            "message" => "Username contains special characters.",
            );
                    
            return json_encode($returnvar);
            exit();
        }
        
        if (strlen($username) >= 55){
            $returnvar = array(
                "code" => "400",
                "message" => "Username is too long.",
            );
                
            return json_encode($returnvar);
            exit();
        }
            
        if (strlen($username) <= 2){
            $returnvar = array(
                "code" => "400",
                "message" => "Username is too short.",
            );
                
            return json_encode($returnvar);
            exit();
        }
        
        include("/www/wwwroot/fun.watrlabs.lol/private/conn.php");
        $stmt = $pdo->prepare('SELECT username FROM users WHERE username = ?');
        $stmt->execute([$username]);
            
        if ($stmt->rowCount() > 0) {
            $returnvar = array(
                "code" => "400",
                "message" => "Username is already taken.",
            );
                    
            return json_encode($returnvar);
            exit();
        }
        

        $query = "UPDATE users WHERE id = :id SET username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
    }
}
