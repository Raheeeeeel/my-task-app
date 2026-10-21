<!DOCTYPE html>
<html>
<head>
    <title>My Task List 📋</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        /* Search & Add Forms */
        .search-form, .add-form {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
            align-items: center;
        }
        .search-form input, .add-form input[type="text"], .add-form input[type="date"] {
            padding: 10px 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
        }
        .search-form input {
            flex: 1;
        }
        .search-form button {
            padding: 10px 14px;
            background: #666;
            font-size: 15px;
        }
        .clear-btn {
            padding: 6px 12px;
            color: #888;
            text-decoration: none;
            font-size: 18px;
        }
        .add-form input[type="text"] {
            flex: 1;
        }
        .add-form input[type="date"] {
            flex: 0 0 auto;
        }
        form button {
            padding: 10px 20px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }
        form button:hover {
            background: #00a8cc;
        }
        ul {
            list-style: none;
        }
        li {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        li form button {
            padding: 6px 15px;
            background: #ff6b6b;
            font-size: 14px;
        }
        li form button:hover {
            background: #ee5a5a;
        }
        .empty {
            text-align: center;
            color: #999;
            padding: 20px;
        }
        /* Completed task style */
        li.completed .task-title {
            text-decoration: line-through;
            color: #999;
        }
        .toggle-form {
            margin: 0;
        }
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .task-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .task-title {
            font-size: 16px;
        }
        .due-date {
            font-size: 12px;
            color: #888;
        }
        .edit-link {
            text-decoration: none;
            font-size: 18px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }
        .edit-link:hover {
            opacity: 1;
        }
        /* Overdue Highlight */
        li.overdue {
            border-left: 4px solid #ff6b6b;
            background: #fff1f1;
        }
        li.overdue .due-date {
            color: #e63946;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 My Tasks</h1>

        <!-- Search Form -->
        <form action="{{ url('/tasks') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}">
            <button type="submit">🔍</button>
            @if(request('search'))
                <a href="{{ url('/tasks') }}" class="clear-btn" title="Clear search">✕</a>
            @endif
        </form>

        <!-- Add Task Form -->
        <form action="{{ url('/tasks') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="title" placeholder="Add a new task..." required>
            <input type="date" name="due_date">
            <button type="submit">Add</button>
        </form>

        <ul>
            @if($tasks->isEmpty())
                <p class="empty">
                    @if(request('search'))
                        No tasks match your search 🔍
                    @else
                        No tasks yet! Add your first one above ✨
                    @endif
                </p>
            @else
                @foreach($tasks as $task)
                    <li class="{{ $task->completed ? 'completed' : '' }} {{ method_exists($task, 'isOverdue') && $task->isOverdue() ? 'overdue' : '' }}">
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="toggle-form">
                            @csrf
                            <input 
                                type="checkbox" 
                                name="completed" 
                                {{ $task->completed ? 'checked' : '' }}
                                onchange="this.form.submit()"
                            >
                        </form>
                        <a href="{{ route('tasks.edit', $task) }}" class="edit-link">✏️</a>
                        <div class="task-content">
                            <span class="task-title">{{ $task->title }}</span>
                            @if($task->due_date)
                                <span class="due-date">📅 {{ $task->due_date->format('M j, Y') }}</span>
                            @endif
                        </div>
                        <form action="{{ url('/tasks/' . $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</body>
</html>