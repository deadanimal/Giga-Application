@extends('base')



@section('content')
    <div class="row">

        <div class="col-4">

            <form action="/projek/{{$projek->id}}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" value="{{$projek->nama}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prefix</label>
                    <input type="text" class="form-control" name="prefix" value="{{$projek->prefix}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nota</label>
                    <textarea class="form-control" name="nota" rows="3">{{$projek->nota}}</textarea>
                </div>
                <button type="submit" class="btn btn-dark">Kemaskini</button>

            </form>

            <form action="/projek/{{$projek->id}}/user" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Login</label>
                    <input type="text" class="form-control" name="namalogin">
                </div>                
                <div class="mb-3">
                    <label class="form-label">Katalaluan</label>
                    <input type="text" class="form-control" name="katalaluan">
                </div>
                <button type="submit" class="btn btn-dark">Cipta</button>

            </form>            


        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Namalogin</th>
                        <th scope="col">Katalaluan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->namalogin }}</td>
                            <td>{{ $user->katalaluan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
@endsection
