<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }
        .logout-form button {
            border: none;
            background: none;
            color: blue;
            cursor: pointer;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="flex items-center">
            <h2>Dashboard</h2>
        </div>
       <div class="actions">
            <a href="{{ route('profile.edit') }}" style="color: blue; text-decoration: none;">Profile</a>
            <a href="{{ route('students.index') }}" style="color: blue; text-decoration: none;">Manage Students</a>
            <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
        </div>
    </nav>
    <div class="container">
        <div class="card">
        <a href="{{ route('schedule') }}" style="color: blue; text-decoration: none;">My Schedule </a>
        </div>
        
    </div>
</body>
</html>
