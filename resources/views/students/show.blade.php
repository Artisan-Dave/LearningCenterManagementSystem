<x-app-layout>
    @section('title', " | $student->full_name")

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900">
                    <div class="overflow-x-auto sm:-mx-6 lg:px-8">
                        <div class="mb-3">
                            <h1 class="text-xl text-semibold">{{ $student->full_name }}</h1>
                        </div>
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 table-auto dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-500">
                                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">AMOUNT
                                    </th>
                                    <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">DATE
                                    </th>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gary-300 dark:divide-gray-700">
                                    @foreach ($student->payments as $payment)
                                        <tr class="hover:bg-gray-100 dark:hover-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $payment->amount}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $payment->created_at->format('M d, Y')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
