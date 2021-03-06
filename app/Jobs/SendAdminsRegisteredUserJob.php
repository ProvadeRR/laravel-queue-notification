<?php

namespace App\Jobs;

use App\Models\Role;
use App\Models\User;
use App\Notifications\Auth\AdminUserRegistered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendAdminsRegisteredUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admins = User::whereHas('role' , function ($query){
            $query->where('slug' , Role::ADMIN);
        })->get();

        Notification::send($admins, new AdminUserRegistered($this->user));
    }
}
