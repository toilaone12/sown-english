<?php
namespace App\RepositoryEloquent;

use App\Models\TypeQuestion;
use App\Repositories\TypeQuestionRepositoryInterface;
use App\RepositoryEloquent\BaseRepository;

class TypeQuestionRepository extends BaseRepository implements TypeQuestionRepositoryInterface {

    public function model()
    {
        return TypeQuestion::class;
    }
}
