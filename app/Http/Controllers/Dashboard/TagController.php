<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index',compact('tags'));
    }

    public function create(){
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request)
    {
        try{
            DB::beginTransaction();

            $tag = Tag::create([
                'slug' => str_replace(' ','-',$request->name),
            ]);
            // // لأن الأسم موجود في جدول الترجمة يتم إضافته هنا
            $tag ->name = $request->name;

            $tag ->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => __('admin\dashboard.save')]);
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);

        }
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        if(!$tag)
            return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);
        return view('dashboard.tags.edit',compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        try{
            $tag = Tag::find($id);
            if(!$tag)
                return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);
            
            DB::beginTransaction();

            // $tag->update($request->all());
            $tag->name = $request->name;
            $tag->slug = str_replace(' ','-',$request->name);
            $tag->save();

            return redirect()->route('admin.tags')->with(['success' => __('admin\dashboard.update')]);
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);

        }
    }

    public function destroy($id)
    {
        try{
            $tag = Tag::find($id);
            if(!$tag)
            return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);
            $tag ->deleteTranslations();
            $tag ->delete();
            return redirect()->route('admin.tags')->with(['success' => __('admin\dashboard.delete')]);


        }catch(\Exception $ex){
            return redirect()->route('admin.tags')->with(['error' => __('admin\dashboard.error')]);

        }
    }
}
