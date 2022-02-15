<?php


namespace App\Http\Controllers\api;

use Illuminate\Support\Carbon;
use App\Http\Controllers\AppBaseController;
use App\Services\TodoService;
use App\Services\UserService;

use Illuminate\Support\Facades\Mail;

use App\Mail\NotifyMail;


class SendEmailController extends AppBaseController
{
    private $todoService;
    private $userService;

    public function __construct(TodoService $todoService, UserService $userService)
    {
        $this->todoService = $todoService;
        $this->userService = $userService;
    }

    public function index()
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
        return response()->json(
            [
                'message' => 'success'
            ],
            200
        );
    }
}
