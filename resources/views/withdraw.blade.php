<x-app-layout>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Withdraw Money</h3>
               
                <hr>
                <br>

                <form method="POST" action="{{ route('withdraw-store') }}">
                    @csrf
                
                    <div>
                        <x-input-label for="amount" :value="__('AMOUNT')" />
                        <x-text-input placeholder="Enter Amount" id="amount" class="block mt-1 w-full" type="number" name="amount"  required  />
                    </div>
            
                    <div class="flex items-center justify-end mt-8">
                                  
                        <x-primary-button class="ml-3">
                            {{ __('Withdraw') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
