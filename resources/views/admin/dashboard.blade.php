<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        body {
            background-image: url('{{ asset(' images/quranbackground.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </header>

        <main class="flex-grow py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-6">
                        Welcome, {{ Auth::user()->name }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-lg font-medium leading-6 text-gray-900 mb-4">Admin Information</h4>
                            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Phone Number:</strong> {{ Auth::user()->phone }}</p>
                            <p><strong>Gender:</strong> {{ Auth::user()->gender }}</p>
                            <p><strong>Age:</strong> {{ Auth::user()->age }}</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h4 class="text-lg font-medium leading-6 text-gray-900 mb-4">Additional Information</h4>
                            <p>Group TheJannahSeekers</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-15 py-2">Number</th>
                                        <th class="w-15 py-2">User ID</th>
                                        <th class="w-25 py-2">Name</th>
                                        <th class="w-25 py-2">Email</th>
                                        <th class="w-25 py-2">Phone</th>
                                        <th class="w-25 py-2">Role</th>
                                        <th class="w-15 py-2">Status</th>
                                        <th class="w-15 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $i => $u)
                                    <tr>
                                    <td class="border px-4 py-2">{{ $i+1 }}</td>
                                    <td class="border px-4 py-2">{{ $u->user_id }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admin.bookings', $u->user_id) }}">
                                            {{ $u->name }}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $u->email }}</td>
                                    <td class="border px-4 py-2">{{ $u->phone ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">{{ $u->role_id === 1 ? 'Administrator' : 'Ordinary user / Student' }}</td>
                                    <td class="border px-4 py-2">
                                        <form method="POST"
                                        action="{{ route('admin.users.toggle', $u->user_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form check form-switch">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="status"
                                                id="active-switch-{{ $u->user_id }}"
                                                onchange="this.form.submit()"
                                                {{ $u->status ? 'checked' : '' }}>
                                            <label
                                                class="form-check-label"
                                                for="active-switch-{{ $u->user_id }}">
                                                {{ $u->status ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>
                                        </form>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('admin.users.destroy', $u->user_id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('booking.create') }}" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700 text-center inline-block mb-4">Add Class</a>
                        <form action="{{ route('student.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700">Logout</button>
                        </form>
                        <div class="mt-4 text-center">
                            <a href="{{ url('/') }}" class="text-red-600 hover:underline">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white shadow mt-6">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-gray-500">
                &copy; 2023 Quran Booking System. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>