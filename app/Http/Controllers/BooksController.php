<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->eloquent(Book::query()->with('publisher', 'category'))
                ->editColumn('cover', function ($model) {
                    return '<img src="' . asset($model->cover) . '" />';
                })
                ->editColumn('published_at', function ($model) {
                    return $model->published_at->format('Y-m-d');
                })
                ->addColumn('action', 'books.action')
                ->rawColumns(['cover', 'action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create', [
            'categories' => Category::get(),
            'publishers' => Publisher::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('public/cover');
        }

        Book::create([
            'category_id' => $request->category_id,
            'publisher_id' => $request->publisher_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'cover' => str_replace("public","storage",$cover),
            'published_at' => $request->published_at,
        ]);

        session()->flash('success', 'Book added successfully.');

        return redirect()->route('books.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('books.edit', [
            'book' => Book::find($id),
            'categories' => Category::get(),
            'publishers' => Publisher::get(),
        ]);
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
        $book = Book::find($id);

        $cover = $book->cover;

        if ($request->hasFile('cover')) {
            $covers = str_replace("storage","public",$cover);
            if (Storage::exists($covers)) {
                Storage::delete($covers);
            }

            $covers = $request->file('cover')->store('public/cover');
            $cover = str_replace("public","storage",$covers);
        }

        $book->update([
            'category_id' => $request->category_id,
            'publisher_id' => $request->publisher_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'cover' => $cover,
            'published_at' => $request->published_at,
        ]);

        session()->flash('success', 'Book updated.');

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book->cover !== null) {
            $covers = str_replace("storage","public",$cover);
            Storage::delete($covers);
        }

        $book->delete();
    }
}