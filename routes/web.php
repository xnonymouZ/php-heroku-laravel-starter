<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome_bak');
});


Route::group(['middleware' => ['web']], function() {

    Route::get('/b', ['middleware' => 'auth', function() {
        $books = Book::all();
        return view('books', ['books' => $books]);
    }]);

    Route::post('/book', ['middleware' => 'auth', function(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            ]);

        if($validator->fails()) {
            return redirect('/b')
                ->withInput()
                ->withErrors($validator);
        }

        $book = new Book;
        $book->title = $request->name;
        $book->save();

        return redirect('/b');
    }]);

    Route::delete('/book/{book}', ['middleware' => 'auth', function(Book $book) {
        $book->delete();
        return redirect('/b');
    }]);

    Route::auth();

});