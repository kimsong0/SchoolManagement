

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
                    <a href="{{ route('director.schedules.create') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Create Schedule</a>
                    <table class="table-auto w-full mt-6">
                        <thead>
                            <tr>
                            <th style="text-align: left;">Date</th>
                            <th style="text-align: left;">Start Time - End Time</th>
                            <th style="text-align: left;">classroom</th>
                            <th style="text-align: left;">Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($schedules as $schedule)
                                <tr>
                                <td>{{ $schedule->schedule_date }}</td>
                                <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                <td>{{ $schedule->schedule_date }}</td>
                                <td>{{ $schedule->teacher->name }}</td>  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</x-app-layout>

