<?php
namespace App\RepositoryEloquent;

use App\Models\Account;
use App\Repositories\AccountRepositoryInterface;
use App\RepositoryEloquent\BaseRepository;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface {
    
    public function model()
    {
        return Account::class;
    }
}