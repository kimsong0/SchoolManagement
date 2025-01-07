<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @if ($errors->any())
                        <div class="mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-500">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('teachers.students.store') }}">
                        @csrf
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-input" required>
                        </div>
                        <div>
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age" class="form-input" required>
                        </div>
                        <div>
                            <label for="school">School:</label>
                            <input type="text" name="school" id="school" class="form-input" required>
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-input" required>
                        </div>
                        <a href="{{ route('teachers.students.index') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Go Back</a>
                    
                        <button type="submit" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
