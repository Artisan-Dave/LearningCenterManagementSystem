<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('success'))
                    <div class="font-medium text-sm text-green-600 p-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-5 text-gray-900">
                    <div class="flex justify-end my-2 sm:-flex flex-wrap">
                        <form method="GET" action="{{ route('student.search') }}" class="input-group">
                            <input type="text" name="search" placeholder="Search..." value="{{ request()->query('search') }}" class="form-control rounded-md shadow-sm">
                            <button type="submit" class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md">Search</button>
                        </form>
                        @if (isset($message))
                            <div class="font-medium text-sm text-red-600 p-auto">
                                {{ $message }}
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-between bg-gray-200 p-5 rounded-md sm:-flex flex-wrap">
                        <div>
                            <h1 class="text-xl text-semibold">Students Enrolled ({{ $total }})</h1>
                        </div>
                        <div>
                            <a href="{{ route('student.add') }}"
                                class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md">
                                Add Student
                            </a>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 table-auto dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-500">
                                        <tr>
                                            {{-- <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ID
                                            </th> --}}
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">FULL 
                                                NAME</th>
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">TOTAL BALANCE</th>
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-700">
                                        @forelse ($students as $student)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-100">
                                                {{-- <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $student->student_id }}
                                                </td> --}}
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $student->full_name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ number_format($student->total_balance) }}
                                                </td>
                                                <td class="lg:-p-2 sm:-flex flex-wrap">
                                                    <div x-data="{ open: false, studentId: null, studentFullname: '' }">
                                                        {{-- To do: encrypt id --}}
                                                        <a href="{{ route('student.edit', ['student_id' => urlencode(Crypt::encrypt($student->student_id))]) }}"
                                                            class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md">Edit</a>

                                                        {{-- Trigger delete modal --}}
                                                        <button
                                                            @click="open = true; studentId={{ $student->student_id }}; studentFullname='{{ $student->full_name }}'"
                                                            class="px-2 py-2 bg-red-500 rounded-md text-white text-sm shadow-md">
                                                            Delete
                                                        </button>

                                                        <a href="{{ route('student.create-balance', ['student_id' => urlencode(Crypt::encrypt($student->student_id))]) }}"
                                                            class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md">Total Balance</a>

                                                        <a href="{{ route('payment.create', ['student_id' => urlencode(Crypt::encrypt($student->student_id))]) }}"
                                                            class="px-2 py-2 bg-green-500 rounded-md text-white text-sm shadow-md">Payment</a>
                                                        
                                                        {{-- Confirmation Modal --}}
                                                        <div  x-cloak x-show="open"
                                                            class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
                                                            <div class="bg-white p-6 rounded-lg md-w-3/4">
                                                                <h3 class="text-lg font-semibold mb-4">Are you sure you
                                                                    want to delete <span class="text-red-500"
                                                                        x-text="studentFullname"></span> ?</h3>
                                                                <div class="flex justify-between">
                                                                    <!-- Cancel Button -->
                                                                    <button @click="open = false"
                                                                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</button>
                                                                    <!-- Delete Button -->
                                                                    <form
                                                                        action="{{ route('student.delete', ['student_id' => $student->student_id]) }}/"
                                                                        method="POST" class="inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        {{-- <input type="hidden" name="student_id"
                                                                            :value="studentId"> --}}
                                                                        <button type="submit"
                                                                            class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div> <!-- Modal Body -->
                                                        </div> <!-- Modal -->
                                                    </div> <!-- x-data -->
                                                </td> <!-- Buttons for Action -->
                                            </tr> <!-- Header -->
                                        @empty
                                            <div>
                                                    <h2 class="flex justify-center bg-gray-200">No record found</h2>
                                            </div>
                                        @endforelse <!-- For Else -->
                                        {{$students->appends(['search' => request()->search])->links()}}
                                    </tbody> <!--Table Class -->
                            </div> <!-- Overflow Hidden -->
                        </div> <!-- py-12 -->
                    </div> <!-- Overflow-x -->
                </div> <!-- p5 -->
            </div> <!-- bg-white bg-hidden -->
        </div> <!--max-w7-xl -->
    </div> <!-- py-12 -->
</x-app-layout>
