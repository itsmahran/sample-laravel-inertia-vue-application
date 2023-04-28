<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Book/List');
    }

    public function get()
    {
        $books = DB::table('books')->get();
        return response()->json($books);
    }

    public function create()
    {
        return Inertia::render('Book/Create');
    }

    public function store(Request $request)
    {
        Book::create($request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:300'],
            'year_published' => ['required', 'max:50'],
            'author' => ['required', 'max:50'],
        ]));

        return inertia()->location(route('books'));
    }

    public function edit($id)
    {
        $books = DB::table('books')->where('id', '=', $id)->first();
        return Inertia('Book/Edit', ['book' => $books]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:300'],
            'year_published' => ['required', 'max:50'],
            'author' => ['required', 'max:50'],
        ]);

        $book = Book::findOrFail($id);

        $book->update($validatedData);

    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
    }
}
