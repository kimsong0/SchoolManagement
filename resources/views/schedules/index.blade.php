

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('director') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
                    <a href="{{ route('schedules.create') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Create Schedule</a>
                    <table class="table-auto w-full mt-6">
                        <thead>
                            <tr>
                            <th style="text-align: left;">Date</th>
                            <th style="text-align: left;">Start Time - End Time</th>
                            <th style="text-align: left;">Classroom</th>
                            <th style="text-align: left;">Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($schedules as $schedule)
                                <tr>
                                <td>{{ $schedule->schedule_date }}</td>
                                <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                <td>{{ $schedule->classroom }}</td>
                                <td>{{ $schedule->teacher->name }}</td>
                                <td>
                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="text-blue-500">Edit</a>
                                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
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
            return confirm('Are you sure you want to remove this class?');
        }
        </script>
</x-app-layout>

