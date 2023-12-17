<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Log;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryRequest;

use Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd(Category::all());

        //Auth::user()->userAdmin();
        return Inertia::render('Category/Index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->userAdmin();
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Auth::user()->userAdmin();

        $category = Category::create($request->validated());

        /*
        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "crear locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha creado marca " . $category->name . " (ID " . $category->id . ")";
        $log->save();
        */

        return Redirect::route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        Auth::user()->userAdmin();

        $category = Category::find($id);

        if ($request->wantsJson()) {
            return response()->json([
                'selectedCategory' => $category,
            ]);
        }

        return Inertia::render('Category/Show', [
            'record' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->userAdmin();

        return Inertia::render('Category/Edit', [
            'record' => Category::find($id),
        ]);
    }


    public function update(CategoryRequest $request, Category $category)
    {
        Auth::user()->userAdmin();

       $category->update($request->validated());


        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "editar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha editado locomotora " . $category->name . " (ID " . $category->id . ")";
        $log->save();

        return Redirect::route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->userAdmin();

        $category = Category::find($id);
        $category->delete();

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "eliminar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha eliminado locomotora " . $category->name . " (ID " . $category->id . ")";
        $log->save();

        return Redirect::route('categories.index');
    }
}
