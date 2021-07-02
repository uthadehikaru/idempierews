<?php

namespace Uthadehikaru\IdempiereWS;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;

class IdempiereWS
{
    private $response = null;
    private $isComposite = false;
    private $serviceType = '';
    private $model = [];

    public function __construct()
    {

    }

    public function composite()
    {
        $this->isComposite = true;
        $this->serviceType = 'compositeOperation';
        return $this;
    }

    public function setServiceType($value)
    {
        $this->serviceType = $value;
        return $this;
    }

    public function getServiceType()
    {
        return $this->serviceType;
    }

    public function setModel($array)
    {
        $this->model = $array;
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }
    
    public function modelCRUD($serviceType, $data)
    {
        $model['_0:ModelCRUD'] = $data;
        $this->setServiceType($serviceType);
        if($this->isComposite)
            $this->model = $model;
        else
            $this->request($model);
        return $this;
    }

    public function modelGetList($serviceName)
    {
        $data['_0:ModelGetList'] = [
                    '_0:serviceType'=>$serviceName
                ];

        $this->setServiceType('getList');
        if($this->isComposite)
            $this->model = $data;
        else
            $this->request($data);
        return $this;
    }

    public function modelSetDocAction($serviceName, $record_id)
    {
        $data['_0:ModelSetDocAction'] = [
            '_0:serviceType'=>$serviceName,
            '_0:recordID'=>$record_id,
        ];

        $this->setServiceType('setDocAction');
        if($this->isComposite)
            $this->model = $data;
        else
            $this->request($data);
        return $this;
    }

    public function modelRunProcess($serviceName, $params)
    {
        $fields = [];

        foreach($params as $column=>$value){
            $field['@attributes']['column'] = $column;
            $field['_0:val'] = $value;
            $fields['_0:field'][] = $field;
        }

        $data['_0:ModelRunProcess'] = [
            '_0:serviceType'=>$serviceName,
            '_0:ParamValues'=>$fields
        ];

        $this->setServiceType('runProcess');
        if($this->isComposite)
            $this->model = $data;
        else
            $this->request($data);
        return $this;
    }

    public function request($data)
    {
        $data = array_merge($data, ['_0:ADLoginRequest'=> config('idempierews.login_request')]);
        
        if($this->serviceType=='runProcess'){
            $model = [
                '_0:ModelRunProcessRequest'=> $data
            ];
        }elseif($this->serviceType=='setDocAction'){
            $model = [
                '_0:ModelSetDocActionRequest'=> $data
            ];
        }elseif($this->serviceType=='getList'){
            $model = [
                '_0:ModelGetListRequest'=> $data
            ];
        }else{
            $model = [
                '_0:ModelCRUDRequest'=> $data
            ];
        }
        
        $this->model = $model;

        return $this;
    }

    public function execute()
    {
        $curl = curl_init();

        $root = [
            'rootElementName' => 'soapenv:Envelope',
            '_attributes' => [
                'xmlns:soapenv' => 'http://schemas.xmlsoap.org/soap/envelope/',
                'xmlns:_0'=>'http://idempiere.org/ADInterface/1_0'
            ],
        ];
        $array = [
            'soapenv:Header' => [],
            'soapenv:Body' => [
                '_0:'.$this->serviceType => $this->model,
            ],
        ];
        $arrayToXml = new ArrayToXml($array, $root);
        
        $xml = $arrayToXml->dropXmlDeclaration()->toXml();
        //dd($xml);

        $host = config('idempierews.host');
        if($this->isComposite)
            $host .= '/ADInterface/services/compositeInterface';
        else
            $host .= '/ADInterface/services/ModelADService';
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => $host,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$xml,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
        ),
        ));

        $this->response = curl_exec($curl);

        curl_close($curl);

        return $this;
    }

    public function response()
    {
        return $this->response;
    }

    public function to_array()
    {
        if($this->response)
            return xml_to_array($this->response);

        return [];
    }
}