<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Students Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('teacher') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
                    <a href="{{ route('students.create') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Add New Student</a>
                    <table class="table-auto w-full mt-6">
                        <thead>
                            <tr>
                            <th style="text-align: left;">Name</th>
                            <th style="text-align: left;">Age</th>
                            <th style="text-align: left;">School</th>
                            <th style="text-align: left;">Email</th>
                            <th style="text-align: left;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->age }}</td>
                                    <td>{{ $student->school }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        <a href="{{ route('students.edit', $student->id) }}" class="text-blue-500">Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirmation Script -->
    <script type="text/javascript">
        function confirmDelete() {
            return confirm('Are you sure you want to delete this student?');
        }
        </script>
</x-app-layout>
