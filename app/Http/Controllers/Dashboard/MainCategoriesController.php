<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;

class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // parent هي سكوب موجود في الموديل بهدف تخفيف الكود وإعادة إستخدامه
       $categories = Category::with('_parent') ->orderBy('id', 'DESC') -> paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','parent_id')->with('_children')->get();

        return view('dashboard.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {
        try{
            DB::beginTransaction();

            (!$request->has('is_active')) 
            ?  $request->request->add(['is_active' => 0])
            :  $request ->request->add(['is_active' => 1]);

            if($request ->type == CategoryType::mainCategory)
            {
                $request ->request->add(['parent_id' => null]);
            }
             $category = Category::create([
                 'slug' => str_replace(' ','-',$request->name),
                 'parent_id' => $request->parent_id,
                 'is_active' => $request->is_active,
             ]);

            // // لأن الأسم موجود في جدول الترجمة يتم إضافته هنا 
            $category ->name = $request->name;
            $category->slug = 
  

            $category ->save();
            DB::commit();
            return redirect()->route('admin.main_categories')->with(['success' => __('admin\dashboard.save')]);

        }catch(\Exception $ex){
            return $ex;
            DB::rollback();
            return redirect()->route('admin.main_categories')->with(['error' => __('admin\dashboard.error')]);
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
    public function update(MainCategoryRequest $request, $id)
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
