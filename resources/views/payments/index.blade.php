<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
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
                    <div class="flex justify-end my-2">
                        <form method="GET" action="{{ route('payment.search') }}" class="input-group">
                            <input type="text" name="search" placeholder="Search..."
                                value="{{ request()->query('search') }}" class="form-control rounded-md shadow-sm">
                            <button type="submit"
                                class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md">Search</button>
                        </form>
                        @if (isset($message))
                            <div style="font-medium text-sm text-red-600">
                                {{ $message }}
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-between bg-gray-200 p-5 rounded-md">
                        <div>
                            <h1 class="text-xl text-semibold">Total of Transactions ({{ $payments->count() }})</h1>
                        </div>
                    </div>

                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 table-auto dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-500">
                                        <tr>
                                            {{-- <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">PAYMENT ID
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left">STUDENT ID
                                            </th> --}}
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">FULL
                                                NAME</th>
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">AMOUNT

                                            </th>
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">TOTAL BALANCE

                                            </th>
                                            
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">DATE

                                            </th>
                                            <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-gray-200 dark:bg-gray-300 dark:divide-gray-700">
                                        @forelse ($payments as $payment)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-100">
                                                {{-- <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $payment->payment_id }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $payment->student_id }}
                                                </td> --}}
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $payment->full_name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ number_format($payment->amount) }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ number_format($payment->total_balance) }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $payment->created_at->format('M d, Y') }}
                                                </td>
                                                <td>
                                                    {{-- <div x-data="{ open: false, studentId: null, studentFullname: '' }">
                                                        {{-- To do: View PDF button --}}
                                                    <a href="{{ route('invoice.view' ,$payment->id)}}"
                                                        class="px-2 py-2 bg-blue-500 rounded-md text-white text-sm shadow-md"
                                                        target="_blank" rel="noopener noreferrer">View</a>

                                                    {{-- To do: Print PDF button --}}
                                                    <a href="{{ route('invoice.download',$payment->id) }}"
                                                        class="px-2 py-2 bg-green-500 rounded-md text-white text-sm shadow-md">Download</a>

                            </div> <!-- x-data -->
                            </td>
                            </tr> <!-- Header -->
                        @empty
                            <div>
                                <h2 class="flex justify-center bg-gray-200">No record found</h2>
                            </div>
                            @endforelse <!-- For Else -->
                            {{ $payments->appends(['search' => request()->search])->links() }}
                            </tbody> <!--Table Class -->
                        </div> <!-- Overflow Hidden -->
                    </div> <!-- py-12 -->
                </div> <!-- Overflow-x -->
            </div> <!-- p5 -->
        </div> <!-- bg-white bg-hidden -->
    </div> <!--max-w7-xl -->
    </div> <!-- py-12 -->
</x-app-layout>
