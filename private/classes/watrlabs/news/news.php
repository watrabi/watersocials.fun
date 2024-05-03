<?php

namespace watrlabs\news;
use PDO;

class news {
    public function __construct() {
        return "Hello World!";
    }
    
    public function helloworld() {
        return "Hello World!";
    }

    public function getnews($limit) {
        if(isset($limit)){
            include(baseurl . "/private/conn.php");
            $getnews = $pdo->prepare("SELECT * FROM news ORDER BY id DESC LIMIT :limit ");
            $getnews->bindParam(':limit', $limit, PDO::PARAM_INT);
		    $getnews->execute();
		    $allnews = $getnews->fetchAll(PDO::FETCH_ASSOC);
		    
		    if ($getnews->rowCount() == 0) {
		        $returnvar = array(
                    "code" => "200",
                    "message" => "No news is avalible currently.",
                );
            
                return json_encode($returnvar);
                exit();
		    } else {
		        return json_encode($allnews);
		        exit();
            }
        } else {
            $returnvar = array(
                    "code" => "400",
                    "message" => "News limit is required.",
            );
            
                return json_encode($returnvar);
                exit();
        }
        
    }
}
