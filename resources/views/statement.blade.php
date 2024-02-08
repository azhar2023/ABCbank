<x-app-layout>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Statement for Account</h3>
               
                <hr>
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>DATE TIME</th>
                            <th>AMOUNT</th>
                            <th>TYPE</th>
                            <th>DETAILS</th>
                            <th>BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ( $statements as $key => $statement )

                        <tr>
                            <td> {{ $key+1}}</td>
                            <td>{{$statement->created_at}}</td>
                            <td>{{$statement->amount}}</td>
                            <td>{{$statement->type}}</td>
                            <td>{{$statement->details}}</td>
                            <td>{{$statement->userbalance ? $statement->userbalance->balance :''}}</td>
                        </tr>
                            
                        @endforeach
                      
                        
                    </tbody>
                </table>

            </div>
                
            </div>
        </div>
    </div>
    <script>

let table = new DataTable('#myTable', {
    responsive: true
});
    </script>
</x-app-layout>
