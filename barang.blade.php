@extends('index')
@section('mumu')
    <!-- Main Section --><div class="col-lg-10 mb-4">
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Table Kontak</h1>
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
                </div>
            @endif
            <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary"> Tambah Data</a>
            <hr>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>kode</th>
                    <th>barang</th>
                    <th>stok</th>
                    <th>harga</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data as $datas)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $datas->kode }}</td>
                        <td>{{ $datas->barang }}</td>
                        <td>{{ $datas->stok }}</td>
                        <td>{{ $datas->harga }}</td>
                        <td>
                        <?php if (Session::get('hak_akses')=="admin"){?>
                            <form action="{{ route('barang.destroy', $datas->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ route('barang.edit',$datas->id) }}" class=" btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                            </form>
                        <?php } ?>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div></div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->
@endsection