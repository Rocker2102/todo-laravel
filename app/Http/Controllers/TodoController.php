<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Todo;

class TodoController extends Controller
{
    public function todoView() {
        $todos = User::find(Auth::id())->todos()->orderByDesc('created_at')->paginate(5);
        return \view('app')->with('todos', $todos->toArray());
    }

    public function get(Request $request, $id) {
        return 'get: ' . $id;
    }

    public function getAll(Request $request, $page = 1, $items = 5) {
        if ($items == 0 || $items > 10) {
            return redirect()->route('todo.getAll', [$page, 5]);
        } else if ($page == 0) {
            return redirect()->route('todo.getAll', [1, $items]);
        }

        return 'getAll: ' . $page . ', ' . $items;
    }

    public function add() {
        return 'add';
    }

    public function update(Request $request, $id) {
        return 'update ' . $id;
    }

    public function delete(Request $request, $id) {
        return 'delete: ' . $id;
    }
}
