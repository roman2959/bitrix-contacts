<?php

require_once __DIR__.'/app/config.php';

use App\Bitrix24\Bitrix24APIException;
use BitrixTestApp\Bitrix;
use BitrixTestApp\Database;

use function BitrixTestApp\isEmail;

use const BitrixTestApp\BITRIX_WEBHOOK;
use const BitrixTestApp\DB_CHARSET;
use const BitrixTestApp\DB_HOST;
use const BitrixTestApp\DB_NAME;
use const BitrixTestApp\DB_PASS;
use const BitrixTestApp\DB_USER;


set_time_limit(3600);

try {
    
    $db     = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET);
    $bitrix = new Bitrix(BITRIX_WEBHOOK);

    $params = ['select' => [
        "ID", "EMAIL"
    ]];
    $contacts = $bitrix->api->request('crm.contact.list', $params);

    $params['start'] = $bitrix->api->lastResponse['next'];

    while(!empty($bitrix->api->lastResponse['next'])) {
        $params['start'] = $bitrix->api->lastResponse['next'];
        $contacts = array_merge($bitrix->api->request('crm.contact.list', $params), $contacts);
    }

} catch (Bitrix24APIException $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
} catch (\Exception $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}

if(empty($contacts))
    exit('nothing found');


foreach($contacts as $contact) {

    $tempEmails = [];
    $insertData = [];
    $insertData['contact_id'] = intval($contact['ID']);
    
    if(empty($contact['EMAIL']))
        continue;
    
    foreach($contact['EMAIL'] as $email) {
        if(!isEmail($email['VALUE']))
            continue;
        if($email['VALUE_TYPE'] === 'WORK') {
            $insertData['contact_email'] = $email['VALUE'];
        } else {
            $tempEmails[] = $email['VALUE'];
        }
    }

    foreach($tempEmails as $key => $email) {
        $tempID = $key+1;
        if($tempID > 5)
            break;
        $emailKey = 'temp_email_'.$tempID;
        $insertData[$emailKey] = $email;
    }

    if(!isset($insertData['contact_email']))
        continue;

    $db->insert('contacts', $insertData);
}

exit('success');
