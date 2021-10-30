<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use \Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\ResponseObject;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($limit)
    {
        $books = Book::select("*")->orderBy("id", "desc")->paginate($limit);
        return response()->json([
            'res' => true,
            'message' => 'ok',
            'data' => $books->setPath(env('URI') . $limit)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $newBook = new Book();

        $newBook->name = $request->name;
        $newBook->description = $request->description;
        $newBook->save();

        return response()->json([
            'res' => true,
            'message' => 'Registro exitoso',
            'data' => $newBook
        ], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $date =  Date('Y-m-d h:i');
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'res' => false,
                'message' => 'EL libro no esxiste'
            ], 400);
        }

        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $validator->errors();
        }
        $book->name = $request->name;
        $book->description = $request->description;
        $book->updated_at = $date;
        $book->update();
        return response()->json([
            'res' => true,
            'message' => 'Registro actualizado con exito',
            'data' => $book
        ], 200);
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
        if (!$book){
            return response()->json([
                'res' => false,
                'message' => 'El registro no existe',
                'data' => $book
            ], 402);
        }
        $book->delete();
        return response()->json([
            'res' => true,
            'message' => 'Registro eliminado con exito'
        ], 200);
    }
}
