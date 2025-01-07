<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('teacher.students.update', $student->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-input" value="{{ $student->name }}" required>
                        </div>
                        <div>
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age" class="form-input" value="{{ $student->age }}" required>
                        </div>
                        <div>
                            <label for="school">School:</label>
                            <input type="text" name="school" id="school" class="form-input" value="{{ $student->school }}" required>
                        </div>
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-input" value="{{ $student->email }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
