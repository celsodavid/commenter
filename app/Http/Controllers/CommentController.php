<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CommentValidationRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('comments.index', [
            'comments' => Comment::with('user')->latest()->get(), // eager-loading
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentValidationRequest $request): RedirectResponse
    {
//        auth()->user()->comments()->create($validated); // description: get global function
//        Auth::user()->comments()->create($validated); // description: get facade function use OO
        $request->user()->comments()->create($request->validated());

        return to_route('comments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment): View
    {
        $this->authorize('update', $comment); // quem ta logado possui permissao para alterar

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentValidationRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', $comment); // quem ta logado possui permissao para alterar

        $comment->update($request->validated());

        return to_route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return to_route('comments.index');
    }
}
