<?php

namespace App\Services\CategoryService;

use App\Models\Category;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetCategory extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $categories = Category::with('topics')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $categories->where('id', $dto['id']);
            $data = $this->convert($categories->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail(
                $dto['per_page'],
                $dto['page'],
                $categories->count()
            );
            $categories = $this->paginateData($categories, $dto['per_page'], $dto['page']);
            $data = $categories->get()->map(function ($category) {
                return $this->convert($category);
            });
        }

        $this->results['message'] = 'Category data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($category)
    {
        $response = $category;
        $response->topics = $category->topics->map(function ($topic) {
            $newTopic = $topic;

            $newTopic->total_users = $topic->joinedUsers->count();
            $newTopic->total_coach_users = $topic->joinedUsers
                ->filter(function ($user) {
                    return $user->role->code == 'coach';
                })->count();
            $newTopic->total_answers = $topic->questions
                ->map(function ($question) {
                    return $question->answers->count();
                })->sum();

            unset($newTopic->joinedUsers);
            unset($newTopic->questions);
        });
        
        return $response;
    }
}
