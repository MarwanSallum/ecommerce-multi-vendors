<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRequest;

class SettingsController extends Controller
{

    // هذا الكود يعمل مع 3 أنواع التوصيل بشكل داينمك

    public function editShippingMethods($type){
        
        if($type === 'free')
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        elseif($type === 'local')
            $shippingMethod = Setting::where('key', 'local_shipping_label')->first();

        elseif($type === 'outer')
            $shippingMethod = Setting::where('key', 'outer_shipping_label')->first();

        else 
            $shippingMethod = Setting::where('key', 'free_shipping_label')->first();

        return view('dashboard.settings.shippings.edit', compact('shippingMethod'));
    }

    public function updateShippingMethods(ShippingsRequest $request, $id){
        try{
            $shippingMethod = Setting::find($id);

            DB::beginTransaction();
            $shippingMethod -> update(['plain_value' => $request -> plain_value]);
            $shippingMethod -> value = $request -> value;

            $shippingMethod -> save();
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.update')]);
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error' =>  __('messages.error')]);

        }
   
    }
}
