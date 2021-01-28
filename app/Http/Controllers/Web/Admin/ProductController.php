<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    const TOTAL_PAGE = 15;

    private ProductRepositoryInterface $product;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->repository->with('category')->paginate(self::TOTAL_PAGE);
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
        $this->repository->create($request->validated());
        return redirect()->route('admin.products.index')->withSuccess('Produto cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->repository->findById($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->repository->findById($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProduct $request
     * @param int $id
     * @return Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        $this->repository->update($id, $request->validated());
        return redirect()->route('admin.products.index')->withSuccess('Produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.products.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        $products = $this->repository->search($data);

        return view('admin.products.index', compact('products', 'data'));
    }
}
