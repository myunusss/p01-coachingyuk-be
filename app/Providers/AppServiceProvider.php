<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerService('GetAnswer', 'App\Services\AnswerService\GetAnswer');
        $this->registerService('StoreAnswer', 'App\Services\AnswerService\StoreAnswer');
        $this->registerService('UpdateAnswer', 'App\Services\AnswerService\UpdateAnswer');
        $this->registerService('DestroyAnswer', 'App\Services\AnswerService\DestroyAnswer');

        $this->registerService('GetQuestion', 'App\Services\QuestionService\GetQuestion');
        $this->registerService('StoreQuestion', 'App\Services\QuestionService\StoreQuestion');
        $this->registerService('UpdateQuestion', 'App\Services\QuestionService\UpdateQuestion');
        $this->registerService('DestroyQuestion', 'App\Services\QuestionService\DestroyQuestion');

        $this->registerService('GetTopic', 'App\Services\TopicService\GetTopic');
        $this->registerService('StoreTopic', 'App\Services\TopicService\StoreTopic');
        $this->registerService('UpdateTopic', 'App\Services\TopicService\UpdateTopic');
        $this->registerService('DestroyTopic', 'App\Services\TopicService\DestroyTopic');
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerService($serviceName, $className)
    {
        $this->app->singleton($serviceName, function () use ($className) {
            return new $className();
        });
    }
}
