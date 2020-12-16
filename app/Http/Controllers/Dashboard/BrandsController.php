<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Client\Request;

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

            $filePath ='';
            if($request->has('photo')){
                $filePath = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create([
                'is_active' => $request->is_active,
                'photo' => $filePath,
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
        $category = Category::orderBy('id','DESC')->find($id); // لجلب أحدث قسم تم إضافته 
        if(!$category){
            return redirect()->route('admin.main_categories')->with(['error' => __('admin\category.category_not_exist')]);
        }
        return view('dashboard.categories.edit',compact('category'));
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
        try{
            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request ->request->add(['is_active' => 1]);

            $category = Category::find($id);

            if(!$category)
                return redirect()->route('admin.main_categories')->with(['error' => __('admin\dashboard.error')]);

            $category ->update($request->all());
            // لأن الأسم موجود في جدول الترجمة يتم إضافته هنا 
            $category ->name = $request->name;
            // تم عمل إعادة صياغة slug
            // لتصبح تضاف بشكل تلقائي بمجرد إدخال الأسم 
            $category->slug = str_replace(' ','-',$request->name);
            $category ->save();

            return redirect()->route('admin.main_categories')->with(['success' => __('admin\dashboard.update')]);

        }catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error' => __('admin\dashboard.error')]);
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
    
            $category = Category::find($id);

            if(!$category)
            
            //TODO:: Make Delete Confirmation with JS

                return redirect()->route('admin.main_categories')->with(['error' => __('admin\dashboard.error')]);

            $category ->delete();
            return redirect()->route('admin.main_categories')->with(['success' => __('admin\dashboard.delete')]);

        }catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error' => __('admin\dashboard.error')]);
        }
    }
}
