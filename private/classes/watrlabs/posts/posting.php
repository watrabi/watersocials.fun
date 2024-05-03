<?php

namespace watrlabs\posts;
use PDO;

class posting {
    public function __construct() {
        return "Hello World!";
    }
    
    public function getposts($limit) {
        if(isset($limit)){
            include(baseurl ."/private/conn.php");
            $getnews = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :limit ");
            $getnews->bindParam(':limit', $limit, PDO::PARAM_INT);
		    $getnews->execute();
		    $allnews = $getnews->fetchAll(PDO::FETCH_ASSOC);
		    
		    if ($getnews->rowCount() == 0) {
		        $returnvar = array(
                    "code" => "200",
                    "message" => "No posts could be fetched.",
                );
            
                return json_encode($returnvar);
		    } else {
		        foreach ($allnews as &$news) {
		            $getauthor = $pdo->prepare("SELECT id, username FROM users WHERE id = :id ");
                    $getauthor->bindParam(':id', $news["author"], PDO::PARAM_STR); 
		            $getauthor->execute();
		            $author = $getauthor->fetch(PDO::FETCH_ASSOC); 
		            
		            if ($author) {
		                $news["username"] = $author["username"]; 
		            }
		        }
		        return json_encode($allnews);
            }
        } else {
            $returnvar = array(
                    "code" => "400",
                    "message" => "Post limit is required.",
            );
            
            return json_encode($returnvar);
        }
    }
}
