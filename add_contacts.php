<?php

require_once __DIR__.'/app/config.php';

use App\Bitrix24\Bitrix24APIException;
use BitrixTestApp\Bitrix;

use function BitrixTestApp\emailGenerator;
use function BitrixTestApp\contactGenerator;

use const BitrixTestApp\BITRIX_WEBHOOK;


$emails     = emailGenerator(30000, 5, 20);
$contacts   = contactGenerator($emails);

try {
    $bitrix     = new Bitrix(BITRIX_WEBHOOK);
    $ids = $bitrix->api->addContacts($contacts);
    print_r($ids);
} catch (Bitrix24APIException $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
} catch (\Exception $e) {
    printf('Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
