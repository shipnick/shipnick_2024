<?php 

$ch = curl_init(); // init the resource
            
    $headr = array();
        
    $headr[] = 'Authorization: Key '.$authKey;
    $headr[] = 'Content-type: application/json'; 
     
    curl_setopt_array(
        $ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER,$headr,
        CURLOPT_POSTFIELDS => $data
        )
    );

?>