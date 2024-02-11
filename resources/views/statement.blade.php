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
                            <th>IMG</th>
                            <th>DETAILS</th>
                            <th>BALANCE</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($transactions as $key => $transaction )

                        <tr>
                            <td> {{ $key+1}}</td>
                            <td>{{ $transaction['email'] }}</td>
                            <td>{{ $transaction['amount'] }}</td>
                            <td> <img src="{{asset('storage/'.$transaction['file'])}}" class="img-responsive" alt="" /></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                            
                        @endforeach
                      
                        
                    </tbody>
                </table>

            </div>
                
            </div>
        </div>
    </div>

        <!-- Button trigger modal -->
    
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                      <form>
                          <legend>Disabled fieldset example</legend>

                          <div class="mb-3">
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                          </div>
                          
                          
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </fieldset>
                      </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>



    <script>

        function edit(info){

           
             document.getElementById('exampleInputEmail1').value = info.created_at;

                var created_at =   $('#exampleInputEmail1').val();


             $.ajax({
                url: "{{route('statement-update')}}",
                method: "POST",
                data: { 
                    'created_at': created_at,
                    '_token' : '{{csrf_token()}}'
                 },
                dataType: "json"
                });

        }

    let table = new DataTable('#myTable', {
        responsive: true
    });
    </script>
</x-app-layout>
