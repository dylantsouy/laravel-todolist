<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use App\Services\TodoService;
use App\Services\UserService;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending mail when deadline is close';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $todoService;
    private $userService;
    public function __construct(TodoService $todoService, UserService $userService)
    {
        parent::__construct();
        $this->todoService = $todoService;
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $todos = $this->todoService->getDeadline();
        foreach ($todos as $todo) {
            $deadline = $todo->deadline;
            $name = $todo->user_name;
            $user = $this->userService->getUserByName($name);
            // One Day Later
            if (Carbon::tomorrow()->toDateString() === Carbon::parse($deadline)->toDateString()) {
                Mail::to($user->email)->send(new NotifyMail(1, $todo));
            }
            // Five Days Later
            if (Carbon::now()->subDays(-5)->toDateString() === Carbon::parse($deadline)->toDateString()) {
                Mail::to($user->email)->send(new NotifyMail(5, $todo));
            }
        }
    }
}
