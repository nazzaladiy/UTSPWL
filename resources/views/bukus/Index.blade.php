@extends('bukus.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('bukus.create') }}"> Input Buku</a>
            </div>
        </div>
    </div>

    <!-- Form Search -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <form class="card-body" action="{{ route('bukus.index') }}" method="GET" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..."  name="search">
                <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">GO</button>
            </span>
            </div>
        </form>
    </div>
    <!-- End From Search -->
 
    <table class="table table-bordered">
        <tr>
            <th>id_buku</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Pengarang</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($bukus as $Buku)
        <tr>

            <td>{{ $Buku->id_buku }}</td>
            <td>{{ $Buku->Judul }}</td>
            <td>{{ $Buku->Kategori }}</td>
            <td>{{ $Buku->Pengarang }}</td>
            <td>{{ $Buku->Jumlah }}</td>
            <td>{{ $Buku->Status }}</td>
            <td>
                <form action="{{ route('bukus.destroy',$Buku->id_buku) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('bukus.show',$Buku->id_buku) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('bukus.edit',$Buku->id_buku) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
    {{ $bukus->links() }}
    </div>
@endsection
