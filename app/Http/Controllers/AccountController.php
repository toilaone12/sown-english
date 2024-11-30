<?php

namespace App\Http\Controllers;

use App\Http\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService) {
        $this->accountService = $accountService;
    }

    //danh sach
    public function list() {
        $response = $this->accountService->list();
        if ($response['status'] == "success") {
            $lists = $response['data'];
            return view('account.list', compact('lists'));
        } else return view('account.list', ['error' => $response['message']]);
    }
    //form them
    public function create() {
        return view('account.create');
    }
    //them tai khoan
    public function insert(Request $request) {
        $response = $this->accountService->insert($request);
    }
}
