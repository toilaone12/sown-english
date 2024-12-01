<?php

namespace App\Http\Controllers;

use App\Http\Services\TypeQuestionService;
use Illuminate\Http\Request;

class TypeQuestionController extends Controller
{
    protected $typeQuestionService;

    public function __construct(TypeQuestionService $typeQuestionService) {
        $this->typeQuestionService = $typeQuestionService;
    }

    //danh sach
    public function list() {
        $response = $this->typeQuestionService->list();
        if ($response['status'] == "success") {
            $lists = $response['data'];
            return view('type.list', compact('lists'));
        } else return view('type.list', ['error' => $response['message']]);
    }
    //form them
    public function create() {
        $numbers = ['1' => 'Một', '2' => 'Hai', '3' => 'Ba', '4' => 'Bốn'];
        return view('type.create', compact('numbers'));
    }
    //them
    public function insert(Request $request) {
        $response = $this->typeQuestionService->insert($request);
        if(isset($response['message']['number'][0])) $response['message'] = $response['message']['number'][0];
        if(isset($response['message']['name'][0])) $response['message'] = $response['message']['name'][0];
        return redirect()->route('type.create')->with($response['status'],$response['message']);
    }
    //cho vao thung rac
    public function delete(Request $request) {
        $result = $this->typeQuestionService->delete($request);
        if ($result['status'] == 'success') {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 500);
        }
    }
    //form thung rac
    public function trash() {
        $response = $this->typeQuestionService->trash();
        if ($response['status'] == "success") {
            $lists = $response['data'];
            return view('type.trash', compact('lists'));
        } else return view('type.trash', ['error' => $response['message']]);
    }
    //khoi phuc
    public function restore(Request $request) {

        $response = $this->typeQuestionService->restore($request);
        // dd($response);
        return redirect()->route('type.trash')->with($response['status'],$response['message']);
    }
}
