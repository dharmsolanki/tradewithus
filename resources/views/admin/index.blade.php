<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of Investment') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 w-full">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg w-full overflow-x-auto">
            <div class="min-w-full text-gray-900 dark:text-gray-100 p-4">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User Id</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type of Payment</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Investment Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Remarks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Payment Proof</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($details as $detail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->user ? $detail->user->id : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->user ? $detail->user->name : 'N/A' }}</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('investment.updateStatus', ['id' => $detail->id]) }}" method="POST" class="flex space-x-2 items-center">
                                            @csrf
                                            @method('PATCH')

                                            <!-- Dropdown for status -->
                                            <select name="status" 
                                                class="border rounded px-2 py-1 text-sm 
                                                    bg-white dark:bg-gray-700 
                                                    text-gray-800 dark:text-gray-200 
                                                    border-gray-300 dark:border-gray-600">
                                                <option value="0" {{ $detail->status == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $detail->status == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ $detail->status == 2 ? 'selected' : '' }}>Rejected</option>
                                            </select>

                                            <!-- Remarks input -->
                                            <input 
                                                type="text" 
                                                name="remarks" 
                                                placeholder="Enter remarks"
                                                class="px-2 py-1 border rounded text-sm w-40
                                                    bg-white dark:bg-gray-700 
                                                    text-gray-800 dark:text-gray-200 
                                                    border-gray-300 dark:border-gray-600"
                                            >

                                            <!-- Submit button -->
                                            <button type="submit" 
                                                class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $detail->remarks }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($detail->payment_proof)
                                            <a href="{{ asset('storage/payment_proofs/' . $detail->payment_proof) }}" 
                                               target="_blank" 
                                               class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                                View Proof
                                            </a>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
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