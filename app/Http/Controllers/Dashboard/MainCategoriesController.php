<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // parent() هي سكوب موجود في الموديل بهدف تخفيف الكود وإعادة إستخدامه
       $categories = Category::parent() -> paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index',compact('categories'));

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
            $category ->save();

            return redirect()->route('admin.main_categories')->with(['success' => __('admin\dashboard.success')]);

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
        //
    }
}
