<!DOCTYPE html>
<html>
<head>
    <title>Edit Task ✏️</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f093fb, #f5576c);
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
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            color: #333;
            margin-top: 5px;
        }
        input[type="text"],
        input[type="date"] {
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        input[type="text"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #f5576c;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        button, .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        button {
            background: #f5576c;
            color: white;
        }
        button:hover {
            background: #e04a5a;
        }
        .btn.cancel {
            background: #eee;
            color: #333;
        }
        .btn.cancel:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Edit Task</h1>
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <label>Task Title:</label>
            <input 
                type="text" 
                name="title" 
                value="{{ $task->title }}"
                required
            >
            
            <label>Due Date:</label>
            <input 
                type="date" 
                name="due_date" 
                value="{{ $task->due_date ?? '' }}"
            >
            
            <div class="btn-group">
                <a href="{{ url('/tasks') }}" class="btn cancel">Cancel</a>
                <button type="submit">Update Task</button>
            </div>
        </form>
    </div>
</body>
</html>