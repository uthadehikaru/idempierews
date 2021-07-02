<?php

namespace Uthadehikaru\IdempiereWS;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;

class CompositeService extends IdempiereWS
{
    public $requests = array();
    private $serviceName = '';

    public function __construct($serviceName)
    {
        parent::__construct();
        $this->composite();
        $this->serviceName = $serviceName;
    }

    public function add($request)
    {
        $this->requests[] = $request;
    }

    public function compile()
    {
        $operations = [];
        foreach($this->requests as $request)
        {
            $operation = $request->getModel();
            $operation['@attributes'] = [
                'preCommit'=>"false",
                'postCommit'=>"false",
            ];
            $operation['_0:TargetPort'] = $request->getServiceType();
            $operations['_0:operation'][] = $operation;
        }
        
        $model['_0:CompositeRequest'] = [
            '_0:ADLoginRequest'=> config('idempierews.login_request'),
            '_0:serviceType' => $this->serviceName,
            '_0:operations' => $operations,
        ];

        $this->setModel($model);
        return $this;
    }
}