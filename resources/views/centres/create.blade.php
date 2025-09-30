<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline mr-5">
            {{ __('Add Centre') }}
        </h2>

        <!-- View All Centres Button -->
        <a href="{{ route('centres.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md shadow hover:bg-gray-300">
            View All Centres
        </a>
    </x-slot>

    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold mb-6">Add New Centre</h1>

        <div class="bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('centres.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if(session('message'))
                    <p class="w-full text-green-700 text-[14px] mt-[2px]">{{ session('message') }}</p>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Centre Category</label>
                        <select name="category" id="category" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Category --</option>
                            <option value="1" @selected(old('category') == '1')>Accredited Training Partners</option>
                            <option value="2" @selected(old('category') == '2')>Assessment Centres</option>
                            <option value="3" @selected(old('category') == '3')>Corporate Partners</option>
                            <option value="4" @selected(old('category') == '4')>LAPT APL Partners</option>
                            <option value="5" @selected(old('category') == '5')>LAPT Beauty Centres</option>
                            <option value="6" @selected(old('category') == '6')>LAPT Aviation Centres</option>
                            <option value="7" @selected(old('category') == '7')>LAPT Culinary Centres</option>
                            <option value="8" @selected(old('category') == '8')>LAPT HM Centres</option>
                            <option value="9" @selected(old('category') == '9')>LAPT IT Centres</option>
                            <option value="10" @selected(old('category') == '10')>LAPT Misc Centres</option>
                            <option value="11" @selected(old('category') == '11')>LAPT Inactive Centres</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Centre Type</label>
                        <select name="type" id="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">-- Select Type --</option>
                            <option value="1" @selected(old('type') == '1')>Testing Centre</option>
                            <option value="2" @selected(old('type') == '2')>Partner Centre</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Centre Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Centre Code</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="address" value="{{ old('address') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Country</label>
                        <select name="country" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                             <option value="">-- Select Country --</option>
                            <option value="1" @selected(old('country') == '1')>India</option>
                            <option value="2" @selected(old('country') == '2')>USA</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">State</label>
                        <select name="state" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select State --</option>
                            <option value="1" @selected(old('state') == '1')>Uttar Pradesh</option>
                            <option value="2" @selected(old('state') == '2')>Uttrakhand</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Contact Person</label>
                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Mobile</label>
                        <input type="text" name="mobile" value="{{ old('mobile') }}" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Fax</label>
                        <input type="text" name="fax" value="{{ old('fax') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Website</label>
                        <input type="text" name="website" value="{{ old('website') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-sm mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook') }}"
                           
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1">
                        <label class="block font-semibold text-sm mt-3">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram') }}"
                           
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Twitter</label>
                        <input type="text" name="twitter" value="{{ old('twitter') }}"
                       
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1">
                        <label class="block font-semibold text-sm mt-3">LinkedIn</label>
                        <input type="text" name="linkedin" value="{{ old('linkedin') }}"
                         
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Password</label>
                        <input type="password" name="password" required 
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Upload Chairman Signature</label>
                        <input type="file" name="chairman_signature"
                            class="p-3 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-sm mb-1">Upload Examiner Signature</label>
                        <input type="file" name="examiner_signature"
                            class="p-3 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block font-semibold text-sm mb-1">Upload Centre Logo</label>
                        <input type="file" name="centre_logo"
                            class="p-3 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('centres.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Save Centre
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>