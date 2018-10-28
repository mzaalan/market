<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use MetroMarket\MobilePanel\Http\Requests\CreateMobileDeviceRequest;
use MetroMarket\MobilePanel\Models\MobileDevice;

class MobileDevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateMobileDeviceRequest $request)
    {
        $data = $request->only(array_keys($request->rules()));

        $old_device = MobileDevice::where('device_os', $data['device_os'])->where(function ($query) use ($data) {
            $query->where('device_id', $data['device_id'])
                ->orWhere('device_token', $data['device_token']);
        })->active()->first();

        $new_device = new MobileDevice($data);

        if ($old_device) {
            if (!$old_device->equals($new_device)) {
                $old_device->active = 0;
                $old_device->save();
                $new_device->save();
            } else {
                $old_device->fill($data)->save();
            }
        } else {
            $new_device->save();
        }

        return response()->json([
            'status' => 'success',
        ]);
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
        //
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
