<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // ✅ Index — with Search!
    public function index(Request $request): View
    {
        $query = Task::latest();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $tasks = $query->get();
        return view('tasks.index', compact('tasks'));
    }

    // ✅ Store — now accepts due_date!
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'     => 'required|max:255',
            'due_date'  => 'nullable|date',
        ]);
        
        Task::create($request->all());
        return redirect()->back();
    }

    // ✅ Destroy
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->back();
    }

    // ✅ Toggle complete status
    public function toggle(Task $task): RedirectResponse
    {
        $task->update([
            'completed' => !$task->completed
        ]);
        return redirect()->back();
    }

    // ✅ Edit
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    // ✅ Update — now accepts due_date!
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title'     => 'required|max:255',
            'due_date'  => 'nullable|date',
        ]);
        
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }
}