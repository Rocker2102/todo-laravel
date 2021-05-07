<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
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
