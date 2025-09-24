<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Investment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('investment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- User ID (hidden, assign auth user) -->
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount"
                                   value="{{ old('amount') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                          dark:bg-gray-700 dark:text-gray-200
                                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   required>
                            @error('amount')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                         <!-- Transaction Id -->
                        <div>
                            <label for="transaction_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction Id</label>
                            <input type="text" step="0.01" name="transaction_id" id="transaction_id"
                                   value="{{ old('transaction_id') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                          dark:bg-gray-700 dark:text-gray-200
                                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   required>
                            @error('transaction_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                       <!-- Type of Payment -->
                        <div>
                            <label for="type_of_payment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type of Payment</label>
                            <select name="type_of_payment" id="type_of_payment"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                        dark:bg-gray-700 dark:text-gray-200
                                        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                <option value="">-- Select Payment Type --</option>
                                <option value="Bank Transfer" {{ old('type_of_payment') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="UPI" {{ old('type_of_payment') == 'UPI' ? 'selected' : '' }}>UPI</option>
                                <option value="Credit Card" {{ old('type_of_payment') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="Debit Card" {{ old('type_of_payment') == 'Debit Card' ? 'selected' : '' }}>Debit Card</option>
                                <option value="Cash" {{ old('type_of_payment') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            </select>
                            @error('type_of_payment')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Investment Date -->
                        <div>
                            <label for="investment_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Investment Date</label>
                            <input type="date" name="investment_date" id="investment_date"
                                   value="{{ old('investment_date') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                          dark:bg-gray-700 dark:text-gray-200
                                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   required>
                            @error('investment_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Proof -->
                        <div>
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment Proof</label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                   class="mt-1 block w-full text-gray-900 dark:text-gray-200
                                          dark:bg-gray-700 rounded-md border-gray-300 shadow-sm
                                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                   accept="image/*,.pdf">
                            @error('payment_proof')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Save Investment') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
