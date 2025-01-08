<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <a href="{{ route('schedules.index') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>

            {{ __('Edit Schedule') }}
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
                    <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="schedule_date">Date:</label>
                            <input type="date" name="schedule_date" required>
                        </div>
                        <div>
                            <label for="start_time">Start Time:</label>
                            <input type="time" name="start_time" required>
                        </div>
                        <div>
                            <label for="end_time">End Time:</label>
                            <input type="time" name="end_time" required>
                        </div>
                        <div>
                            <label for="classroom">Classroom:</label>
                            <input type="text" name="classroom" id="classroom" class="form-input" required>
                        </div>  
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
