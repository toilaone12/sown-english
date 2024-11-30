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
        dd($response);
    }
}
