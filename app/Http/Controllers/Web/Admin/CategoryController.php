<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    const TOTAL_PAGE = 15;

    private CategoryRepositoryInterface $repository;

    /**
     * ProductController constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
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
        $categories = $this->repository->orderBy('id', 'DESC')->paginate(self::TOTAL_PAGE);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateCategory $request
     * @return Response
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->validated());
        return redirect()->route('admin.categories.index')->withSuccess('Categoria cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->repository->findById($id);
        if(!$category->id)
            return redirect()->back();

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->repository->findById($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdateCategory  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        $this->repository->update($id, $request->validated());
        return redirect()->route('admin.categories.index')->withSuccess('Categoria editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->route('admin.categories.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        $categories = $this->repository->search($data);
        return view('admin.categories.index', compact('categories', 'data'));
    }
}
