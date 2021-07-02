<?php

namespace Uthadehikaru\IdempiereWS;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;

class ModelADService extends IdempiereWS
{

    public function __construct()
    {
        parent::__construct();
    }

    public function query($serviceName)
    {
        $modelCRUD  = [
            '_0:serviceType'=>$serviceName,
        ];
        return $this->modelCRUD('queryData', $modelCRUD);
    }

    public function read($serviceName, $record_id)
    {
        $modelCRUD  = [
            '_0:serviceType'=>$serviceName,
            '_0:RecordID'=>$record_id,
        ];
        return $this->modelCRUD('readData', $modelCRUD);
    }

    public function create($serviceName, $values = [])
    {
        $fields = [];

        foreach($values as $column=>$value){
            $field['@attributes']['column'] = $column;
            $field['_0:val'] = $value;
            $fields['_0:field'][] = $field;
        }
        
        $modelCRUD  = [
            '_0:serviceType'=>$serviceName,
            '_0:DataRow'=>$fields
        ];
        return $this->modelCRUD('createData', $modelCRUD);
    }

    public function update($serviceName, $record_id, $values = [])
    {
        $fields = [];

        foreach($values as $column=>$value){
            $field['@attributes']['column'] = $column;
            $field['_0:val'] = $value;
            $fields['_0:field'][] = $field;
        }

        $modelCRUD  = [
            '_0:serviceType'=>$serviceName,
            '_0:RecordID'=>$record_id,
            '_0:DataRow'=>$fields
        ];
        return $this->modelCRUD('updateData', $modelCRUD);
    }

    public function delete($serviceName, $record_id)
    {
        $modelCRUD  = [
            '_0:serviceType'=>$serviceName,
            '_0:RecordID'=>$record_id,
        ];
        return $this->modelCRUD('deleteData', $modelCRUD);
    }

    public function setDocAction($serviceName, $record_id)
    {
        return $this->modelSetDocAction($serviceName, $record_id);
    }

    public function runProcess($serviceName, $params)
    {
        return $this->modelRunProcess($serviceName, $params);
    }

    public function list($serviceName)
    {
        return $this->modelGetList($serviceName);
    }
}