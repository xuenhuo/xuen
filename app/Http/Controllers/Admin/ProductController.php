<?php

namespace App\Http\Controllers\Admin;

use App\model\products\Attribute;
use Illuminate\Http\Request;
use App\model\products\Product;
use App\model\products\Category;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return view('admin.products.index', [
            'products' => Product::paginate(10),
        ]);
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
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'price' => 'required|string',
            'sale' => 'string',
            'description' => 'required|string',
            'additional_information' => 'required|string',
            'featured' => 'boolean',
            'position' => 'required|string',
            'photo' => 'required',
            'categories' => 'string|max:255',
            'attributes' => 'string|max:255',
        ]);
        //
        $path = $request->file('photo')->store('public/products');
        $product = Product::create([
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'price' => $request['price'],
            'sale' => $request['sale'],
            'description' => $request['description'],
            'additional_information' => $request['additional_information'],
            'featured' => $request['featured'],
            'position' => $request['position'],
            'photo' => explode("/", $path)[2],
        ]);
        
        $categories = $request->get('categories');
        if (!empty($categories)) {
            $categoryList = array_filter(explode(",", $categories));
    
            // Loop through the category array that we just created
            foreach ($categoryList as $categories) {
                $category = Category::firstOrCreate(['title' => $categories]);
            }
    
            $categories = Category::whereIn('title', $categoryList)->get()->pluck('id');
    
            $product->categories()->sync($categories);
        }
        $attributes = $request->get('attributes');
        if (!empty($attributes)) {
            $attributeList = array_filter(explode(",", $attributes));
    
            // Loop through the attribute array that we just created
            foreach ($attributeList as $attributes) {
                $attribute = Attribute::firstOrCreate(['title' => $attributes]);
            }
    
            $attributes = Attribute::whereIn('title', $attributeList)->get()->pluck('id');
    
            $product->attributes()->sync($attributes);
        }
        return [$product, $categories, $attributes];
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
        $product = Product::find($id);
        $categories = $product->categories()->get()->pluck('title');
        $attributes = $product->attributes()->get()->pluck('title');
        return [$product, $categories, $attributes];
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
        $product = Product::find($id);
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|string',
            'sale' => 'sometimes|string',
            'description' => 'sometimes|required|string',
            'additional_information' => 'sometimes|required|string',
            'featured' => 'sometimes|boolean',
            'position' => 'sometimes|required|string',
            'photo' => 'sometimes|required',
            'categories' => 'sometimes|string|max:255',
            'attributes' => 'sometimes|string|max:255',
        ]);
        //
        $product->title = $request->get('title');
        $product->subtitle = $request->get('subtitle');
        $product->price = $request->get('price');
        $product->sale = $request->get('sale');
        $product->description = $request->get('description');
        $product->additional_information =  $request->get('additional_information');
        $product->featured = $request->get('featured');
        $product->position = $request->get('position');
        if ($request->file('photo') != null) {
            $path = $request->file('photo')->store('public/products');
            $product->photo = explode("/", $path)[2];
        }
        $product->save();

        $comma = ',';
        $categories = $request->get('categories');
        if (!empty($categories)) {
            if (strpos($categories, $comma) !== false) {
                $categoryList = explode(",", $categories);
                // Loop through the category array that we just created
                foreach ($categoryList as $categories) {
                    // Get any existing categories
                    $category = Category::where('title', '=', $categories)->first();
                    // If the category exists, sync it, otherwise create it
                    if ($category != null) {
                        $c[] = $category->id;
                    } else {
                        $category = new Category();
                        $category->title = $categories;
                        $category->save();
                        $c[] = $category->id;
                    }
                }
            } else {
                // Only one category
                $category = Category::where('title', '=', $categories)->first();
                if ($category != null) {
                    $c[] = $category->id;
                } else {
                    $category = new Category();
                    $category->title = $categories;
                    $category->save();
                    $c[] = $category->id;
                }
            }
        }
        $attributes = $request->get('attributes');
        if (!empty($attributes)) {
            if (strpos($attributes, $comma) !== false) {
                $attributeList = explode(",", $attributes);
                // Loop through the attribute array that we just created
                foreach ($attributeList as $attributes) {
                    // Get any existing attributes
                    $attribute = Attribute::where('title', '=', $attributes)->first();
                    // If the attribute exists, sync it, otherwise create it
                    if ($attribute != null) {
                        $a[] = $attribute->id;
                    } else {
                        $attribute = new Attribute();
                        $attribute->title = $attributes;
                        $attribute->save();
                        $a[] = $attribute->id;
                    }
                }
            } else {
                // Only one attribute
                $attribute = Attribute::where('title', '=', $attributes)->first();
                if ($attribute != null) {
                    $a[] = $attribute->id;
                } else {
                    $attribute = new Attribute();
                    $attribute->title = $attributes;
                    $attribute->save();
                    $a[] = $attribute->id;
                }
            }
        }
        $product->categories()->sync($c);
        $product->attributes()->sync($a);
        return [$product, $categories, $attributes];
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
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success']);
    }
}
