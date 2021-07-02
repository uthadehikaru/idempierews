<?php

use Uthadehikaru\IdempiereWS\ModelADService;

Route::get('idempierews', function() {
    echo 'Hello from the idempiere WS!';
});

Route::get('idempierews/query', function() {
    $service = new ModelADService();
    return $service->query(request()->get('name'))->execute()->to_array();
});

Route::get('idempierews/read', function() {
    $service = new ModelADService();
    return $service->read(request()->get('name'), request()->get('id'))->execute()->to_array();
});

Route::get('idempierews/delete', function() {
    $service = new ModelADService();
    return $service->delete(request()->get('name'), request()->get('id'))->execute()->to_array();
});

Route::get('idempierews/setdocaction', function() {
    $service = new ModelADService();
    return $service->setDocAction(request()->get('name'), request()->get('id'))->execute()->to_array();
});

Route::get('idempierews/list', function() {
    $service = new ModelADService();
    return $service->list(request()->get('name'))->execute()->to_array();
});