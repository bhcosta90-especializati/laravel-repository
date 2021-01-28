<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    const TOTAL_PAGE = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->orderBy('id', 'desc')
            ->paginate(self::TOTAL_PAGE);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateCategory $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        DB::table('categories')->insert($request->validated());
        return redirect()->route('admin.categories.index')->withSuccess('Categoria cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if(!$category->id)
            return redirect()->back();

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdateCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        DB::table('categories')->where('id', $id)->update($request->validated());
        return redirect()->route('admin.categories.index')->withSuccess('Categoria editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('admin.categories.index');
    }

    public function search(Request $request)
    {
//        $search = $request->search;
//        $categories = DB::table('categories')
//            ->where('name', $search)
//            ->orWhere('url', $search)
//            ->orWhere('description', 'LIKE', "%{$search}%")->get();

        $name = $request->name;
        $url = $request->url;
        $description = $request->description;

        $categories = DB::table('categories')
            ->where(function($builder) use($name, $url, $description){
                if($name){
                    $builder->where('name', $name);
                }

                if($url){
                    $builder->orWhere('url', $url);
                }

                if($description){
                    $builder->orWhere('description', 'LIKE', "%{$description}%");
                }

            })
            ->orderBy('id', 'desc')
            ->paginate(self::TOTAL_PAGE);

        $data = $request->except('_token');

        return view('admin.categories.index', compact('categories', 'data'));
    }
}
