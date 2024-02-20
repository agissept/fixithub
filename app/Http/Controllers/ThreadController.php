<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ThreadController extends Controller
{

    public function __construct(
        private readonly Request $request
    )
    {
    }

    public function show(int $id): View
    {
        $threads = Thread::query()->join('users', 'users.id', '=', 'threads.user_id')
            ->where('threads.id', $id)
            ->orWhere('parent_id', $id)
            ->get([
                'threads.id as id',
                'threads.content as content',
                'threads.parent_id as parent_id',
                'users.name as username',
                'threads.image as image',
            ]);

        $parentThread = $threads->where('id', $id)->first();
        $comments = $threads->where('parent_id', $id);

        return view('threads.detail-thread', [
            'thread' => $parentThread,
            'comments' => $comments
        ]);
    }

    public function store(?int $parentId = null): RedirectResponse
    {
        Thread::create([
            'user_id' => auth()->id(),
            'content' => $this->request->thread_content,
            'parent_id' => $parentId,
            'image' => $this->uploadImage($this->request->file('thread_image'))
        ]);

        if ($parentId){
            return redirect()->route('threads.show', ['id' => $parentId]);
        }

        return redirect()->route('dashboard');
    }

    private function uploadImage(?UploadedFile $file): string
    {
        if (!$file) {
            return '';
        }
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('/upload/image'), $filename);
        return $filename;
    }
}
