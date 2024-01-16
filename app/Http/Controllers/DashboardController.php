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
            ->select([
                'threads.id as id',
                'users.name as username',
                'content'
            ])
            ->get();
        return view('dashboard', [
            'threads' => $threads
        ]);
    }
}
