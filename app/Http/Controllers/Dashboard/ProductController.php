<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $data = [];
        $data['brands'] = Brand::active()->select('id') ->get(['name'])->makeHidden(['translations']);
        $data['tags'] = Tag::select('id') ->get();
        $data['categories'] = Category::active()->select('id') ->get();

        return view('dashboard.products.general.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralProductRequest $request)
    {
        try{
            DB::beginTransaction();
            (!$request ->has('is_active')) 
           ? $request->request ->add(['is_active' => 0])
           : $request->request ->add(['is_active' => 0]);

        $product = Product::create([
            'slug' => str_replace(' ','-',$request->name),
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        
        // Save Translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->description;
        $product->save();

        // Save Product Categories
        $product->categories()->attach($request->categories);

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\dashboard.save')]);

        }catch(\Exception $ex){

            DB::rollBack();
            return redirect()->route('admin.brands')->with(['error' => __('admin\dashboard.error')]);
        }
       
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
