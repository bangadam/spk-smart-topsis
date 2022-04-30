<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // user
        $province_id = auth()->user()->province_id;
        $city_id = auth()->user()->city_id;
        $district_id = auth()->user()->district_id;
        $village_id = auth()->user()->village_id;

        $data['user'] = User::find(auth()->user()->id);
        $data['provinces'] = \Indonesia::allProvinces()->pluck('name', 'id');
        $data['cities'] = \Indonesia::findProvince($province_id)->cities()->pluck('name', 'id');
        $data['districts'] = \Indonesia::findCity($city_id)->districts()->pluck('name', 'id');
        $data['villages'] = \Indonesia::findDistrict($district_id)->villages()->pluck('name', 'id');
        $data['my_province_id'] = $province_id;
        $data['my_city_id'] = $city_id;
        $data['my_district_id'] = $district_id;
        $data['my_village_id'] = $village_id;

        return view('profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $account = $user->account;

            $input = $request->all();

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = time() . '.' . $photo->getClientOriginalExtension();
                $photo->storeAs('public/', $photo_name);
                $input['photo'] = $photo_name;
            }

            $account->fill($input);
            $account->save();

            Flash::success('Data berhasil diubah');

            return redirect()->back();
        } catch (\Throwable $th) {
            Flash::error('Data gagal diubah');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
