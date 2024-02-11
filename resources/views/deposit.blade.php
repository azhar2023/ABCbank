<x-app-layout>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Deposit Money</h3>
               
                <hr>
                <br>

                <form method="POST" action="{{ route('deposit-store') }}" id="myform">
                    @csrf
                
                    <div>
                        <x-input-label for="amount" :value="__('AMOUNT')" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount"    />
                    </div>
            
                    <div class="flex items-center justify-end mt-8">
                                  
                        <x-primary-button class="ml-3">
                            {{ __('Deposit') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
                
            </div>
        </div>
    </div>
    <script>

    $("#myform").validate({
    rules: {
        amount: {
        required: true,
        }
    },
    messages: {
        amount: {
        required: "We need your email address to contact you",
        }
    }
    });

    </script>
</x-app-layout>
