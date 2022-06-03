<?php

namespace BitrixTestApp;

use App\Bitrix24\Bitrix24API;


class Bitrix
{

    public Bitrix24API $api;

    function __construct(private string $_webhook)
    {
        $this->api = new Bitrix24API($_webhook);
    }

}
