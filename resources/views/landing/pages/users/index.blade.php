@extends('landing.layouts.app')

@section('content')
<section class="container mx-auto px-4 py-24">
    <h1 class="text-4xl font-bold mb-6 md:text-left text-center">Edit Profile</h1>
    <div class="grid grid-cols-1 gap-6">
        <!-- Form Section -->
        <div class="bg-white p-8 rounded-lg shadow-lg border-2 border-black">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" disabled />
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required />
                </div>

                <div class="mt-2">
                    <label for="datepicker-format" class="block text-gray-700">Birth Date</label>
                        <div
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                            <input name="birth_date" id="datepicker-format" datepicker datepicker-format="mm-dd-yyyy" type="text"
                                class="border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" value="{{ old('birth_date', $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('m-d-Y') : '') }}"
                                placeholder="mm-dd-yyyy" />
                        </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Gender</label>
                    <div class="mt-1 flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="Male" {{ old('gender', $user->gender) == 'Male' ? 'checked' : '' }} class="form-radio" />
                            <span class="ml-2">Male</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="Female" {{ old('gender', $user->gender) == 'Female' ? 'checked' : '' }} class="form-radio" />
                            <span class="ml-2">Female</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
                </div>

                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
