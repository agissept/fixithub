<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        $threads = Thread::query()
            ->join('users','users.id', '=', 'user_id')
            ->whereNull('parent_id')
            ->orderBy('threads.id', 'desc')
            ->select([
                'threads.id as id',
                'users.name as username',
                'content',
                'image'
            ])
            ->get();
        return view('dashboard', [
            'threads' => $threads
        ]);
    }
}
