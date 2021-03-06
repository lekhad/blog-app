<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index(){
        // fetch all todos from the database

        // display them in the todos.index page
        $todos = Todo::all();
        // return view('todos.index')->with('todos', $todos);
        return view('todos.index')->with('todos', $todos);
    }

    // public function show($todoId){
    //     // $todo = Todo::find($todoId);
    //     return view('todos.show')->with('todo', Todo::find($todoId));
    // }

    public function show(Todo $todo){
        return view('todos.show')->with('todo', $todo);
    }

    public function create(){
        return view('todos.create');
    }

    public function store(Request $request){
        // dd($request()->all()); die;
        // $this->validate($request(), [
        //     'name' => 'required|min:6|max:12', 
        //     'description' => 'required'    
        // ]);

        $rules = [
            'name'=> 'required|min:6|max:12',
            'description' => 'required',
        ];
        
        $customMessages = [
            'name.required' =>  'Name is required', 
            'description.required'=> 'Description is required',
        ];

        $this->validate($request, $rules, $customMessages);
        
        $data = $request->all();

        // dd($data); die;
        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        session()->flash('success', 'Todo Created Successfully');

        return redirect('/todos');
    }

    // public function edit($todoId){
    //     $todo = Todo::find($todoId);
    //     return view('todos.edit')->with('todo', $todo);
    // }

    public function edit(Todo $todo){
        return view('todos.edit')->with('todo', $todo);
    }

    // public function update(Request $request, $todoId){
    //     // $this->validate($request(), )
    //     $data = $request->all();
        
    //     // dd($data); die;
    //     $rules = [
    //         'name'=> 'required|min:6|max:12',
    //         'description' => 'required',
    //     ];
        
    //     $customMessages = [
    //         'name.required' =>  'Name is required', 
    //         'description.required'=> 'Description is required',
    //     ];

    //     $this->validate($request, $rules, $customMessages);

    //     $todo = Todo::find($todoId); 
    //     $todo->name = $data['name'];

    //     $todo->description = $data['description'];

    //     $todo->save();
    //     return redirect('/todos');
    // }

    public function update(Request $request, Todo $todo){
        $data = $request->all();
        
        // dd($data); die;
        $rules = [
            'name'=> 'required|min:6|max:12',
            'description' => 'required',
        ];
        
        $customMessages = [
            'name.required' =>  'Name is required', 
            'description.required'=> 'Description is required',
        ];

        $this->validate($request, $rules, $customMessages);
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();
        session()->flash('success', 'Todo Updated Successfully');
        return redirect('/todos');
    }

    // public function delete($todoId){
    //     $todo = Todo::find($todoId);
    //     $todo->delete();
    //     return redirect('/todos');
    // }

    public function delete(Todo $todo){
        $todo->delete();
        session()->flash('success', 'Todo Deleted Successfully');
        return redirect('/todos');
    }

    public function complete(Todo $todo){
        $todo->completed = true;
        $todo->save();
        session()->flash('success', 'Todo completed successfully');

        return redirect('/todos');
    }
}
