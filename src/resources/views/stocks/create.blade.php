@extends('main')
@section('section')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('stocks.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Produk</label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Masukkan Nama Produk">
                            
                                <!-- error message untuk nama_produk  -->
                                @error('nama_produk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kategori</label>
                                <select class="form-control @error('kategori') is-invalid @enderror" name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach(App\Models\Stock::kategori as $key => $value)
                                        <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Size </label>
                                        <input type="text" class="form-control @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}" placeholder="Masukkan Size">
                                    
                                        <!-- error message untuk size -->
                                        @error('size')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Jumlah Stock </label>
                                        <input type="text" class="form-control @error('jumlah_stock') is-invalid @enderror" name="jumlah_stock" value="{{ old('jumlah_stock') }}" placeholder="Jumlah Stock">
                                    
                                        <!-- error message untuk jumlah stock -->
                                        @error('jumlah_stock')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection