<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndonesiaRegionController extends Controller
{
    public function getProvinces(Request $request)
    {
        $provinces = \Indonesia::allProvinces()->pluck('name', 'id');
        return response()->json($provinces);
    }

    public function getCities(Request $request, $province_id)
    {
        $cities = \Indonesia::findProvince($province_id)->cities()->pluck('name', 'id');

        return $this->success($cities);
    }

    public function getDistricts(Request $request, $city_id)
    {
        $districts = \Indonesia::findCity($city_id)->districts()->pluck('name', 'id');

        return $this->success($districts);
    }

    public function getVillages(Request $request, $district_id)
    {
        $villages = \Indonesia::findDistrict($district_id)->villages()->pluck('name', 'id');

        return $this->success($villages);
    }

    public function getVillage($id)
    {
        $village = \Indonesia::findVillage($id, ['district.city.province'])->toArray();

        return $this->success($village);
    }
}
