<?php
include_once dirname(__FILE__) . '/city.model.php';
include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';

class cityController
{
    public function getCityByProvinceID($province_id)
    {
        $city = city::getBy_province_id($province_id)->getList();
        echo json_encode($city['export']['list']);
        die();
    }

    public static function getCity($province_id)
    {
        $city = city::getBy_province_id($province_id)->getList();
        return $city['export']['list'];
    }

    public static function find($city_id)
    {
        return city::find($city_id);
    }


    public function service_getRow($id)
    {
        return city::getBy_City_id($id)->getList();
    }

    public function api_getRow($id)
    {
        $result = $this->service_getRow($id);
        Response::json($result, 'get', 200);
    }

    public function service_get($input)
    {
        include_once ROOT_DIR . 'component/province/model/province.model.php';
        if ($input == '') {
            return province::getAll()
                ->getList();
        } else {
            return city::getAll()
                ->where('province_id', '=', $input)
                ->getList();
        }
    }


    public function api_getAll($input)
    {
        $result = $this->service_get($input);
        Response::json($result, 'get');
    }
}
