<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use App\Services\Book\BookService;
use App\Services\User\UserService;

class BookController extends Controller
{
    private $bookService;
    private $userService;

    public function __construct(BookService $bookService, UserService $userService)
    {
        $this->bookService = $bookService;
        $this->userService = $userService;
    }

    public function index()
    {
        $books = $this->bookService->all();
        if (sizeof($books) == 0) {
            return ResponseFormatter::error(null, 'Books not found', 404);
        }
        return ResponseFormatter::success($books, 'Books retrieved successfully');
    }

    public function store(BookRequest $request)
    {
        $payload = $request->validated();
        $user = $this->userService->find($payload['user_id']);
        if (!$user) {
            return ResponseFormatter::error(null, 'User not Found', 404);
        }
        $book = $this->bookService->store($payload);
        return ResponseFormatter::success($book, 'Book created successfully');
    }

    public function update(BookRequest $request, $id)
    {
        $payload = $request->validated();
        $user = $this->userService->find($payload['user_id']);
        if (!$user) {
            return ResponseFormatter::error(null, 'User not Found', 404);
        }
        $book = $this->bookService->update($id, $payload);
        return ResponseFormatter::success($book, 'Book update successfully');
    }

    public function destroy($id)
    {
        $book = $this->bookService->find($id);
        if (!$book) {
            return ResponseFormatter::error(null, 'Book not Found', 404);
        }
        $book->delete();
        return ResponseFormatter::success(null, 'Book deleted successfully');
    }
}
