<?php
$file = 'db.txt';
$users = [];
$readDb = fopen($file, 'r');
        while(!feof($readDb)){
            $userString = fgets($readDb);
            if($userString!=''){
            $userArray = unserialize($userString);
            array_push($users, $userArray);
            }
            
        }
        fclose($readDb);

?>