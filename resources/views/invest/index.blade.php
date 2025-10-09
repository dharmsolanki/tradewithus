<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Investment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Add Investment Button -->
                    <div class="mb-4">
                        <a href="{{ route('show-form') }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            + Add Investment
                        </a>
                    </div>

                    <div class="mb-4 flex justify-between items-center">
                        <form method="GET" action="{{ route('investment.index') }}" class="flex space-x-2">
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by user, transaction ID or amount" 
                                class="px-3 py-2 border rounded-md w-80 text-gray-700 dark:text-gray-200 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Search</button>
                        </form>

                        @if($search)
                            <a href="{{ route('investment.index') }}" 
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Clear</a>
                        @endif
                    </div>

                    <!-- Example Table -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Transaction ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Type of Payment
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Investment Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Remarks
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($details as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->transaction_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->amount }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->type_of_payment }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->investment_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($detail->status == 0)
                                            <span class="text-yellow-600">Pending</span>
                                        @elseif($detail->status == 1)
                                            <span class="text-green-600">Approved</span>
                                        @else
                                            <span class="text-red-600">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->remarks }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                        No investments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Table -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
