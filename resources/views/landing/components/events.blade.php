@foreach ($events as $event)
<a href="{{ route('event_details', ['event_id' => $event->event_id]) }}">
    <div class="card bg-white">
        <div class="imgDisplay">
            <div class="relative pb-[56.25%] bg-gray-200">
                <img src="{{ asset('storage/' . $event->event_picture) }}" alt="Event"
                    class="absolute h-full w-full object-contain" />
            </div>
            <div class="y-date-boxInfo bg-orange-500">
                <div class="y-date-month text-white">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}
                </div>
                <div class="y-date-day text-orange-500">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d') }}
                </div>
            </div>
        </div>
        <div class="y-card-title">
            <p class="boxTitle">{{ $event->event_name }}</p>
            <p class="boxAddress">{{ $event->event_location }}</p>
            <hr class="y-separator" />
            <p class="boxInfo">Start From <span
                    class="boxPrice">Rp&nbsp;{{ number_format($event->price, 0, ',', '.') }}</span></p>
        </div>
    </div>
</a>
@endforeach