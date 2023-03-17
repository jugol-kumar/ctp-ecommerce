<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Category/Index', [


            'categories' => Category::query()
                ->with('childrens')
                ->withCount('childrens')
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhereHas('childrens', function ($developer) use($search){
                            $developer->where('title', 'like', "%{$search}%");
                        });
                    ;
                })
                ->latest()
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($category) => [
                    'id' => $category->id,
                    'title' => $category->title,
                    'summery' => $category->summery,
                    'icon' => $category->icon,
                    'banner' => $category->banner,
                    'featured' => $category->featured,
                    'childrens_count' => $category->childrens_count,
                    'top' => $category->top,
                    'type' => $category->type,
                    'created_at' => $category->created_at->format(config('app.date_format')),
                ]),
            'filters' => Request::only(['search','perPage', 'dateRange']),
            'parent_categories' => Category::whereNull('parent_id')->get(),
            'main_url' => URL::route('admin.category.index')
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
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        // we upload our image after saving this category
        $data['icon'] = null;
        $data['banner'] = null;
        Category::create($data);
        return back();
//        return Response::json(['message' => 'Your Category Successfully Added.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Category
     */
    public function show(Category $category)
    {
        $category->load('childrens');
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
