<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Requests;
use App\Mail\ListSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodoListController extends Controller
{
    public function index(){
        $user_id = auth()->id();
        $todolists = TodoList::where('user_id', $user_id)->get();
        $todos = session('todos', []);
        return view('todolists.index',
        [
            'todolists' => $todolists,
            'todos' => $todos

        ]);
    }
    public function create(){
        return view('todolists.create');
    }
    public function store(TodoListRequest $request){

        $request->validated();
        $user_id = auth()->id();
        TodoList::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date
        ]);


        $request->session()->flash('alert success','Todo Created Successfully');

        return redirect()->route('todolists.index');
    }
    public function add(TodoListRequest $request){
        $request->validated();
        $user_id = auth()->id();
        $todos = $request->session()->get('todos', []);
        $newTodo = ['user_id' => $user_id,'title' => $request->title,'description' => $request->description,'due_date' => $request->due_date];
        if (!is_array($todos)) {
            $todos = [];
        }
        array_push($todos, $newTodo);
        $request->session()->put('todos', $todos);
        $request->session()->flash('alert success','Todo Created Successfully');
        return redirect()->route('todolists.index');
    }
    


    public function email(){
        $user_id = auth()->id();
        $todolists = TodoList::where('user_id', $user_id)->get();
        Mail::to("alexougriniouk@gmail.com")->send(new ListSent($todolists));
        return view('todolists.index', [
            'todolists' => $todolists
        ]);
        return redirect()->route('todolists.index')->with('success', 'TODO list items are emailed');

    }
    public function save(Request $request)
    {
        $user_id = Auth::user()->id;
        $todo_list_items = $request->session()->get('todos', []);
            foreach ($todo_list_items as $todo_item) {
                $new_todo = new TodoList;
                $new_todo->user_id = $user_id;
                $new_todo->title = $todo_item['title'];
                $new_todo->description = $todo_item['description'];
                $new_todo->due_date = $todo_item['due_date'];
                $new_todo->save();
            }
            return redirect()->route('todolists.index')->with('success', 'TODO list items saved to database');
    }


    public function DeleteAll()
    {
        session()->forget('todos');
        return redirect()->route('todolists.index')->with('success', 'Unsaved TODO list items have been deleted');
    }
    public function restoreTodoList()
    {
     
        $user_id = Auth::user()->id;
        $todolists = TodoList::where('user_id', $user_id)->get();
        $todo_list_items = [];
        foreach ($todolists as $todolist) {
            $todo_list_items[] = [
                'title' => $todolist->title,
                'description' => $todolist->description,
                'due_date' => $todolist->due_date,
                'is_active' => $todolist->is_active,
            ];
        }
        session(['todo_list_items' => $todo_list_items]);
        session()->forget('todos');
        return redirect()->route('todolists.index')->with('success', 'TODO list items restored from database');
}

}
