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
        $this->registerService('Login', 'App\Services\AuthService\Login');

        $this->registerService('DestroyAnswer', 'App\Services\AnswerService\DestroyAnswer');
        $this->registerService('GetAnswer', 'App\Services\AnswerService\GetAnswer');
        $this->registerService('StoreAnswer', 'App\Services\AnswerService\StoreAnswer');
        $this->registerService('ToggleHelpfulAnswer', 'App\Services\AnswerService\ToggleHelpfulAnswer');
        $this->registerService('UpdateAnswer', 'App\Services\AnswerService\UpdateAnswer');

        $this->registerService('DestroyQuestion', 'App\Services\QuestionService\DestroyQuestion');
        $this->registerService('FollowQuestion', 'App\Services\QuestionService\FollowQuestion');
        $this->registerService('GetQuestion', 'App\Services\QuestionService\GetQuestion');
        $this->registerService('StoreQuestion', 'App\Services\QuestionService\StoreQuestion');
        $this->registerService('UpdateQuestion', 'App\Services\QuestionService\UpdateQuestion');

        $this->registerService('DestroyReply', 'App\Services\ReplyService\DestroyReply');
        $this->registerService('GetReply', 'App\Services\ReplyService\GetReply');
        $this->registerService('StoreReply', 'App\Services\ReplyService\StoreReply');
        $this->registerService('UpdateReply', 'App\Services\ReplyService\UpdateReply');

        $this->registerService('DestroyRole', 'App\Services\RoleService\DestroyRole');
        $this->registerService('GetRole', 'App\Services\RoleService\GetRole');
        $this->registerService('StoreRole', 'App\Services\RoleService\StoreRole');
        $this->registerService('UpdateRole', 'App\Services\RoleService\UpdateRole');

        $this->registerService('DestroyTopic', 'App\Services\TopicService\DestroyTopic');
        $this->registerService('GetTopic', 'App\Services\TopicService\GetTopic');
        $this->registerService('JoinTopic', 'App\Services\TopicService\JoinTopic');
        $this->registerService('StoreTopic', 'App\Services\TopicService\StoreTopic');
        $this->registerService('UpdateTopic', 'App\Services\TopicService\UpdateTopic');

        $this->registerService('DestroyUser', 'App\Services\UserService\DestroyUser');
        $this->registerService('GetUser', 'App\Services\UserService\GetUser');
        $this->registerService('StoreUser', 'App\Services\UserService\StoreUser');
        $this->registerService('UpdateUser', 'App\Services\UserService\UpdateUser');
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
