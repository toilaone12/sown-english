<?php

namespace App\Http\Controllers;

use App\Http\Services\QuestionService;
use App\Http\Services\TypeQuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $questionService;
    protected $typeQuestionService;

    public function __construct(QuestionService $questionService, TypeQuestionService $typeQuestionService) {
        $this->questionService = $questionService;
        $this->typeQuestionService = $typeQuestionService;
    }

    //danh sach
    public function list() {
        $response = $this->questionService->list();
        if ($response['status'] == "success") {
            $lists = $response['data'];
            return view('question.list', compact('lists'));
        } else return view('question.list', ['error' => $response['message']]);
    }
    //form them
    public function create() {
        $response = $this->typeQuestionService->list();
        $types = [];
        if($response['status'] == 'success') {
            foreach($response['data'] as $one) {
                $types[] = ['number' => $one['number'], 'name' => $one['number'] == 1 ? 'Một' : ($one['number'] == 2 ? 'Hai' : ($one['number'] == 3 ? 'Ba' : 'Bốn'))];
            }
            return view('question.create', compact('types'));
        } else return view('question.list', ['error' => $response['message']]);
    }
    //them
    public function insert(Request $request) {
        $response = $this->questionService->insert($request);
        // dd($request->all());
        $noti = '';
        if(isset($response['message']['name'][0])) $noti .= $response['message']['name'][0];
        if(isset($response['message']['type_id'][0])) {
            if ($noti != '') $noti .= ' và ';
            $noti .= $response['message']['type_id'][0]; 
        } 
        if(isset($response['message']['answer'][0])) {
            if ($noti != '') $noti .= ' và ';
            $noti .= $response['message']['answer'][0];
        } 
        if(isset($response['message']['correct'][0])) {
            if ($noti != '') $noti .= ' và ';
            $noti .= $response['message']['correct'][0];
        } 
        if($noti != '') $response['message'] = $noti;
        return redirect()->route('question.create')->with($response['status'],$response['message']);
    }
    //form sua
    public function edit(Request $request) {
        $response = $this->questionService->getOne($request);
        if($response['status'] == 'success') {
            $numbers = ['1' => 'Một', '2' => 'Hai', '3' => 'Ba', '4' => 'Bốn'];
            $one = $response['data'];
            return view('question.edit', compact('numbers','one'));
        } else {
            return redirect()->route('question.list')->with('error',$response['message']);
        }
    }
    //sua 
    public function update(Request $request) {
        $response = $this->questionService->update($request);
        if(isset($response['message']['number'][0])) $response['message'] = $response['message']['number'][0];
        if(isset($response['message']['name'][0])) $response['message'] = $response['message']['name'][0];
        return redirect()->route('question.edit',['id' => $request->get('id')])->with($response['status'],$response['message']);
    }
    //cho vao thung rac
    public function delete(Request $request) {
        $result = $this->questionService->delete($request);
        if ($result['status'] == 'success') {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 500);
        }
    }
    //form thung rac
    public function trash() {
        $response = $this->questionService->trash();
        if ($response['status'] == "success") {
            $lists = $response['data'];
            return view('question.trash', compact('lists'));
        } else return view('question.trash', ['error' => $response['message']]);
    }
    //khoi phuc
    public function restore(Request $request) {

        $response = $this->questionService->restore($request);
        return redirect()->route('question.trash')->with($response['status'],$response['message']);
    }
}
