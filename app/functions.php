<?php

namespace BitrixTestApp;


function emailGenerator(int $number, int $minLength, int $maxLenght) : array
{
    $emails         = array(); 
    $characters     = '0123456789abcdefghijklmnopqrstuvwxyz'; 
    $domain         = 'example';
    $tld            = array("com", "net", "biz");
    for($i=0; $i<$number; $i++){
        $randomName = ''; 
        $lenght     = mt_rand($minLength, $maxLenght);
        for($j=0; $j<$lenght; $j++){
            $randomName.= $characters[mt_rand(0, strlen($characters) -1)];
        }
        $k              = array_rand($tld); 
        $extension      = $tld[$k]; 
        $fullAddress    = "$randomName@$domain.$extension"; 
        $emails[]       = $fullAddress; 	
    }
    return $emails;
}


function contactGenerator(array $emails) : array
{
    $contacts   = [];
    foreach($emails as $key => $email) {
        $contacts[$key]['EMAIL'][] = [
            'VALUE' => $email,
            'VALUE_TYPE' => 'WORK',
            'TYPE_ID' => 'EMAIL'
        ];
        $emailArr   = explode('@', $email);
        $username   = $emailArr[0];
        $host       = $emailArr[1];
        $tempCount  = mt_rand(1, 5);
        $i = 0;
        while($i !== $tempCount) {
            $i++;
            $tempID     = mt_rand(1000, 9999);
            $tempEmail  = $username.'_temp_'.$tempID.'@'.$host;
            $contacts[$key]['EMAIL'][] = [
                'VALUE' => $tempEmail,
                'VALUE_TYPE' => 'OTHER',
                'TYPE_ID' => 'EMAIL'
            ];
        }
    }
    return $contacts;
}



function isEmail(string $email) : bool
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}
