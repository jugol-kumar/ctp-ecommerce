<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Brand/Index', [
            'brands' => Brand::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($brand) => [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'summery' => $brand->summery,
                    'featured' => $brand->featured,
                    'icon' => $brand->icon != null ? config("app.url")."/storage/".$brand->icon : null,
                    'banner' =>$brand->banner != null ? config("app.url")."/storage/".$brand->banner : null,
                    'top' => $brand->top,
                    'created_at' => $brand->created_at->format(config('app.date_format')),
                ]),
            'filters' => Request::only(['search','perPage', 'dateRange']),
            'main_url' => URL::route('admin.brand.index')
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data =  Request::all();

        if (Request::hasFile('icon')){
            $type = Request::file('icon')->getClientOriginalExtension();
            $icon = Request::file('icon')->store('uploads/all', 'public');
            if ($type != 'svg' || $type != 'gif'){
                fileResize(Request::file('icon'), $icon, 60, 60);
            }
            $data['icon'] = $icon;
        }

        if (Request::hasFile('banner')){
            $banner = Request::file('banner')->store('uploads/all', 'public');
            $data['banner'] = $banner;
        }

        Brand::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return Brand
     */
    public function show(Brand $brand)
    {
        return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = Request::all();
        $brand = Brand::findOrFail($id);

        if (Request::hasFile('icon')){
            $type = Request::file('icon')->getClientOriginalExtension();
            $icon = Request::file('icon')->store('uploads/all', 'public');
            if ($type != 'svg' || $type != 'gif'){
                fileResize(Request::file('icon'), $icon, 60, 60);
            }
            $data['icon'] = $icon;
        }

        if (Request::hasFile('banner')){
            $banner = Request::file('banner')->store('uploads/all', 'public');
            $data['banner'] = $banner;
        }

        $brand->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back();
    }
}
