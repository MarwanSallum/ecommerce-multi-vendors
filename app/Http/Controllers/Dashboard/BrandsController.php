<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // parent() هي سكوب موجود في الموديل بهدف تخفيف الكود وإعادة إستخدامه
       $brands = Brand::orderBy('id', 'DESC') -> paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index',compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try{
            DB::beginTransaction();

            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request ->request->add(['is_active' => 1]);

            $fileName ='';
            if($request->has('photo')){
                $fileName = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create([
                'is_active' => $request->is_active,
                'photo' => $fileName,
            ]);
            
            // // لأن الأسم موجود في جدول الترجمة يتم إضافته هنا 
            $brand ->name = $request->name;

            $brand ->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\dashboard.save')]);

        }catch(\Exception $ex){
            
            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);
        }
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
        $brand = Brand::find($id); // لجلب أحدث قسم تم إضافته 
        if(!$brand){
            return redirect()->route('admin.brands')->with(['error' => __('admin\brand.brand_not_exist')]);
        }
        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request ->request->add(['is_active' => 1]);

            $brand = Brand::find($id);

            $fileName ='';
            if($request->has('photo')){

                $storgedImage = Str::after($brand->photo,'brands/');
                $oldPhoto = public_path('assets/images/brands/'. $storgedImage);
                unlink($oldPhoto); // delete image from public folder

                $fileName = uploadImage('brands', $request->photo);
            }

            if(!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);

            $brand ->update([
                'is_active' => $request->is_active,
                'photo' => $fileName,
            ]);
            // لأن الأسم موجود في جدول الترجمة يتم إضافته هنا 
            $brand ->name = $request->name;
    
            $brand ->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\dashboard.update')]);

        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);
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
        try{
    
            $brand = Brand::find($id);

            if(!$brand)
            //TODO:: Make Delete Confirmation with JS
                return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);
            
            $storgedImage = Str::after($brand->photo,'brands/');
            $oldPhoto = public_path('assets/images/brands/'. $storgedImage);
            unlink($oldPhoto); // delete image from public folder

            $brand ->delete();
            return redirect()->route('admin.brands')->with(['success' => __('admin\dashboard.delete')]);

        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);
        }
    }
}
