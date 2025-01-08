<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <a href="{{ route('teacher') }}" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            {{ __('My Schedule') }} 
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: '/teacher/schedules/events', // Fetch data controller
                slotDuration: '00:30:00',
                slotLabelInterval: '00:30:00', 
                slotMinTime: '07:00:00',
                slotMaxTime: '21:00:00',
                allDaySlot: false,
                slotLabelFormat: { // Custom format for time slots
                hour: '2-digit', 
                minute: '2-digit', 
                hour12: true, 
                meridiem: 'short'
            },
                editable: false,
                eventColor: '#3174ad',
            });
            calendar.render();
         
        });
    </script>
</x-app-layout>
