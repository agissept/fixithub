<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        $threads = Thread::query()
            ->join('users','users.id', '=', 'user_id')
            ->select([
                'users.name as username',
                'content'
            ])
            ->get();
        return view('dashboard', [
            'threads' => $threads
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Thread::create([
            'user_id' => auth()->id(),
            'content' => $request->thread_content
        ]);
        return redirect()->route('dashboard');
    }
}
