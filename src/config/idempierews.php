<?php

return  [

    'host' => env('IDEMPIEREWS_HOST','http://localhost:8080'),
    'login_request' => [
        '_0:user'=>env('IDEMPIEREWS_USER','SuperUser'),
        '_0:pass'=>env('IDEMPIEREWS_PASS','System'),
        '_0:lang'=>env('IDEMPIEREWS_LANG','EN'),
        '_0:ClientID'=>env('IDEMPIEREWS_CLIENT','11'),
        '_0:RoleID'=>env('IDEMPIEREWS_ROLE','50004'),
        '_0:OrgID'=>env('IDEMPIEREWS_ORG','0'),
        '_0:WarehouseID'=>env('IDEMPIEREWS_WH','0'),
        '_0:stage'=>'1',
    ]

];