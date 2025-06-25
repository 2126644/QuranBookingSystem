<!DOCTYPE html>
<html>
<head>
    <title>Student Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('images/quranbackground.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Use min-height instead of fixed height */
        overflow-y: auto;   /* Allow vertical scroll if needed */
        padding: 1rem;      /* Prevent content from touching screen edges */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-brown-700">Student Register</h1>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('student.register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full p-2 border border-gray-300 rounded"
                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                <small class="text-sm text-gray-500">Only letters and spaces are allowed.</small>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full p-2 border border-gray-300 rounded">
                <small class="text-sm text-gray-500">Please enter a valid email (e.g., name@example.com)</small>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="w-full p-2 border border-gray-300 rounded">
            <small class="text-sm text-gray-500">Minimum 8 characters required.</small>            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-gray-700">Gender:</label>
                <select id="gender" name="gender" required class="w-full p-2 border border-gray-300 rounded">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="mb-6">
                <label for="age" class="block text-gray-700">Age:</label>
                <input type="number" id="age" name="age" value="{{ old('age') }}" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700">Register</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ url('/') }}" class="text-red-600 hover:underline">Back to Home</a>
        </div>
    </div>
</body>
</html>
