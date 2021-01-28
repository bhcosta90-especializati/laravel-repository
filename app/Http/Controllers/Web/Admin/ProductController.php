<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    const TOTAL_PAGE = 15;

    private Product $product;

    /**
     * ProductController constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->with('category')->paginate(self::TOTAL_PAGE);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProduct $request
     * @return Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $this->product->create($request->validated());
        return redirect()->route('admin.products.index')->withSuccess('Produto cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProduct $request
     * @param Product $product
     * @return Response
     */
    public function update(StoreUpdateProduct $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('admin.products.index')->withSuccess('Produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $url = $request->url;
        $description = $request->description;
        $category = $request->category_id;

        $products = $this->product
            ->where(function($builder) use($name, $url, $description, $category){
                if($name){
                    $builder->where('name', $name);
                }

                if($url){
                    $builder->orWhere('url', $url);
                }

                if($description){
                    $builder->orWhere('description', 'LIKE', "%{$description}%");
                }

                if($category){
                    $builder->orWhere('category_id', $category);
                }

            })
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(self::TOTAL_PAGE);

        $data = $request->except('_token');

        return view('admin.products.index', compact('products', 'data'));
    }
}
