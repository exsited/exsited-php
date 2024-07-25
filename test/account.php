<?php
use Api\AppService\Account\AccountData;

$accountInfo= new AccountData();

print_r($accountInfo->readAll());

