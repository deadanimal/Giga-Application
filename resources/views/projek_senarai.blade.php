@extends('base')



@section('content')
    <div class="row">

        <div class="col-4">

            <form action="/projek" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Prefix</label>
                    <input type="text" class="form-control" name="prefix">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nota</label>
                    <textarea class="form-control" name="nota" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Cipta</button>

            </form>
        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Prefix</th>
                        <th scope="col">Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projeks as $projek)
                        <tr>
                            <td>{{ $projek->nama }}</td>
                            <td>{{ $projek->prefix }}</td>
                            <td><a href="/projek/{{$projek->id}}">Link</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
