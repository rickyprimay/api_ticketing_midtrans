@extends('admin.layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700 mb-6">Create New Event</h2>

            <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    <div>
                        <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="event_name" id="event_name" value="{{ old('event_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_name') border-red-500 @enderror" required>
                        @error('event_name')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_description" class="block text-sm font-medium text-gray-700">Event Description</label>
                        <textarea name="event_description" id="event_description" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_description') border-red-500 @enderror" required>{{ old('event_description') }}</textarea>
                        @error('event_description')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('price') border-red-500 @enderror" required>
                        @error('price')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="event_location" id="event_location" value="{{ old('event_location') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_location') border-red-500 @enderror" required>
                        @error('event_location')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_date') border-red-500 @enderror" required>
                        @error('event_date')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_start" class="block text-sm font-medium text-gray-700">Event Start</label>
                        <input type="date" name="event_start" id="event_start" value="{{ old('event_start') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_start') border-red-500 @enderror" required>
                        @error('event_start')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_ended" class="block text-sm font-medium text-gray-700">Event End</label>
                        <input type="date" name="event_ended" id="event_ended" value="{{ old('event_ended') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_ended') border-red-500 @enderror" required>
                        @error('event_ended')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
                        <select name="event_type" id="event_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_type') border-red-500 @enderror" required>
                            <option value="" selected disabled>Select event type</option>
                            <option value="event">Event</option>
                            <option value="health">Health</option>
                        </select>
                        @error('event_type')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    

                    <div>
                        <label for="event_picture" class="block text-sm font-medium text-gray-700">Event Picture</label>
                        <input type="file" name="event_picture" id="event_picture" onchange="previewFile(this);" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('event_picture') border-red-500 @enderror" required>
                        @error('event_picture')
                            <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                        <img id="previewImage" class="mt-2 hidden" src="#" alt="Preview Image" style="max-width: 100%; height: auto;">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewFile(input) {
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            var img = document.getElementById('previewImage');
            img.src = reader.result;
            img.classList.remove('hidden');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            img.src = '';
            img.classList.add('hidden');
        }
    }
</script>
@endsection
