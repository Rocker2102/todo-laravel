<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Todo;

class TodoController extends Controller
{
    private $validate = [
        'title' => 'required',
        'description' => 'nullable',
        'due_date' => 'nullable | date'
    ];

    public function todoView() {
        $todos = User::find(Auth::id())->todos()->orderByDesc('created_at')->paginate(5);
        return \view('app')->with('todos', $todos->toArray());
    }

    public function editView($id) {
        $todo = Todo::find($id);
        if (\is_null($todo)) {
            return abort(404);
        }
        if ($todo->user->id !== Auth::id()) {
            return abort(403);
        }
        return \view('todo-edit')->with('todo', $todo->toArray());
    }

    public function add() {
        return 'add';
    }

    public function update(Request $request, $id) {
        $validator = $request->validate($this->validate);

        try {
            $todo = Todo::where('id', $id)->first();
            $todo->title = $request->input('title');
            $todo->description = $request->input('description');
            $todo->due_date = $request->input('due_date');
            $todo->save();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Item updated'
            ]);
        } catch (\Exception $e) {
            return back()->withErrors([
                'Internal server error!',
                'Unknown error!'
            ]);
        }
    }

    public function delete(Request $request, $id) {
        return 'delete: ' . $id;
    }
}
