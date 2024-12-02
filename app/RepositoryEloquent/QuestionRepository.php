<?php
namespace App\RepositoryEloquent;

use App\Models\Question;
use App\Repositories\QuestionRepositoryInterface;
use App\RepositoryEloquent\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface {

    public function model()
    {
        return Question::class;
    }
}
