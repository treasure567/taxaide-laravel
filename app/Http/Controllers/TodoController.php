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
            'title' => ['required', 'string', 'min:10'],
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
        } else {
            $msg = $req['msg'];
            return redirect()->back()->with(['danger_alert' => $msg]);
        }
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
        $data =  $request->only(['title', 'description', 'completed']);
        $data['todo_id'] = $todo;
        $req = socket('update', 'POST', $data);
        if ($req['status'] == true) {
            $req = $req['resp'];
            $msg = $req->message;
            return redirect()->back()->with(['success_alert' => $msg]);
        } else {
            $msg = $req['msg'];
            return redirect()->back()->with(['danger_alert' => $msg]);
        }
    }

    public function delete($todo) {
        info($todo);
        $data['todo_id'] = $todo;
        $req = socket('delete', 'POST', $data);
        if ($req['status'] == true) {
            $req = $req['resp'];
            $msg = $req->message;
            return redirect()->back()->with(['success_alert' => $msg]);
        } else {
            $msg = $req['msg'];
            return redirect()->back()->with(['danger_alert' => $msg]);
        }
    }
}
