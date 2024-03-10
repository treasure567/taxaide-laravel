<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index() {
        $req = socket("get", "GET");
        if ($req['status'] == true) {
            $req = $req['resp'];
            $todos = $req->data;
        } else {
            $todos = [];
        }
        $data['items'] = $todos;
        return view('todo.index', $data);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['danger_alert' => $validator->errors()->first()]);
        }
        $req = socket('create', 'POST', $request->only(['title', 'description']));
        if ($req['status'] == true) {
            $req = $req['resp'];
            $msg = $req->message;
            return redirect()->back()->with(['success_alert' => $msg]);
        }
        return redirect()->back()->with(['danger_alert' => "An error occured while trying to create the Todo, Please try again later"]);
    }

    public function update($todo, Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'completed' => ['required', 'in:yes,no']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['danger_alert' => $validator->errors()->first()]);
        }
        $data =  $request->only(['title', 'description']);
        $data['todo_id'] = $todo; 
        $data['completed'] = ($request->completed == 'yes') ? true : false;
        $req = socket('update', 'POST', $data);
        if ($req['status'] == true) {
            $req = $req['resp'];
            $msg = $req->message;
            return redirect()->back()->with(['success_alert' => $msg]);
        }
        return redirect()->back()->with(['danger_alert' => "An error occured while trying to update the Todo, Please try again later"]);
    }
}
