@extends('admin.layout.main')

@section('title', 'Data Distribusi')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Distribusi</h2>
                {{-- <p class="card-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool,
                    built upon the foundations of progressive enhancement, that adds all of these advanced features to any
                    HTML table. </p> --}}
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span>
                                        </button>


                                        <?php
                                        
                                        $nomer = 1;
                                        
                                        ?>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $nomer++ }}. {{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- table -->
                                <table class="table datatables responsive nowrap" style="width:100%" id="dataTable-1">
                                    <div class="align-right text-right mb-3">
                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#addModal">Add</button>
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>No</th>

                                            <th>Nama Customer</th>
                                            <th>Tanggal</th>
                                            <th>Contact</th>
                                            <th>Harga Satuan</th>
                                            <th>Total Ayam</th>
                                            <th>Payment</th>
                                            {{-- <th>Address</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($distribusi as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>

                                                <td>{{ $data->customer }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>{{ $data->contact }}</td>
                                                <td>Rp. {{ number_format($data->harga_satuan) }}</td>
                                                <td>{{ $data->total_ayam }} Ekor</td>
                                                <td>Rp. {{ number_format($data->payment) }}</td>
                                                {{-- <td>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#detailModal{{ $data->id }}">Detail</button>
                                                </td> --}}
                                                <td>

                                                    {{-- <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModal{{ $data->id }}">Edit</button> --}}

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#deleteModal{{ $data->id }}">Delete</button>

                                                </td>
                                            </tr>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Delete Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Menghapus Data?
                                                        </div>
                                                        <form action="/datadistribusi2/{{ $data->id }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-success"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn mb-2 btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/datadistribusi2/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Customer</label>
                                                                    <input type="text" value="{{ $data->customer }}"
                                                                        name="customer" class="form-control"
                                                                        id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Tanggal Distribusi
                                                                    </label>
                                                                    <input disabled type="date"
                                                                        value="{{ $data->tanggal }}" name="tanggal"
                                                                        class="form-control" id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Contact</label>
                                                                    <input type="text" value=" {{ $data->contact }}"
                                                                        name="contact" class="form-control"
                                                                        id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Harga
                                                                        Satuan</label>
                                                                    <input type="text" value="{{ $data->harga_satuan }}"
                                                                        name="harga_satuan" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Total
                                                                        Ayam</label>
                                                                    <input type="text" value="{{ $data->total_ayam }}"
                                                                        name="total_ayam" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                {{-- <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Payment</label>
                                                                    <input type="text" value="{{ $data->payment }}"
                                                                        name="payment" class="form-control"
                                                                        id="recipient-name">
                                                                </div> --}}
                                                                {{-- <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Address</label>
                                                                    <textarea name="address" rows="5" class="form-control" id="message-text">{{ $data->address }}</textarea>
                                                                </div> --}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn mb-2 btn-danger"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn mb-2 btn-success">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Add Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                    aria-labelledby="defaultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="defaultModalLabel">Add Modal</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/datadistribusi2" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Customer</label>
                                                        <input type="text" value="" name="customer"
                                                            class="form-control" id="recipient-name">
                                                    </div>
                                                    {{-- <div hidden class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Tanggal
                                                            Distribusi
                                                        </label>
                                                        <input type="date" value="" name="tanggal"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Contact</label>
                                                        <input type="text" value="" name="contact"
                                                            class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Harga
                                                            Satuan</label>
                                                        <input type="text" value="" name="harga_satuan"
                                                            class="form-control" id="recipient-name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Total
                                                            Ayam</label>
                                                        <input type="text" value="" name="total_ayam"
                                                            class="form-control" id="recipient-name">
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Payment</label>
                                                        <input type="text" value="" name="payment"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Address</label>
                                                        <textarea name="address" rows="5" class="form-control" id="message-text"></textarea>
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection

@section('script')
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            // "lengthMenu": [
            //     [16, 32, 64, -1],
            //     [16, 32, 64, "All"]
            // ]
            dom: 'Bfrtip',


            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],

            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-primary btn-sm',
                    text: 'Column Visibility',
                    // columns: ':gt(0)'


                },

                {

                    extend: 'pageLength',
                    className: 'btn btn-primary btn-sm',
                    text: 'Page Length',
                    // columns: ':gt(0)'
                },


                // 'colvis', 'pageLength',

                {
                    extend: 'excel',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                // {
                //     extend: 'csv',
                //     className: 'btn btn-primary btn-sm',
                //     exportOptions: {
                //         columns: [0, ':visible']
                //     }
                // },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-primary btn-sm',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },

                // 'pageLength', 'colvis',
                // 'copy', 'csv', 'excel', 'print'

            ],
        });
    </script>
@endsection

@section('sweetalert')
    @if (Session::get('update'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Di Update',
                'success'
            )
        </script>
    @endif
    @if (Session::get('delete'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Di Hapus',
                'success'
            )
        </script>
    @endif
    @if (Session::get('create'))
        <script>
            Swal.fire(
                'Success',
                'Data Berhasil Ditambahkan',
                'success'
            )
        </script>
    @endif
    @if (Session::get('gagal'))
        <script>
            Swal.fire(
                'Success',
                'Data Gagal Ditambahkan',
                'error'
            )
        </script>
    @endif
    @if (Session::get('tidakcukup'))
        <script>
            Swal.fire(
                'Error',
                'Jumlah Ayam Tidak Cukup',
                'error'
            )
        </script>
    @endif
    @if (Session::get('tidakbisaedit'))
        <script>
            Swal.fire(
                'Error',
                'Data bulan sebelumnya tidak bisa di edit',
                'error'
            )
        </script>
    @endif
    @if (Session::get('tidakbisahapus'))
        <script>
            Swal.fire(
                'Error',
                'Data bulan sebelumnya tidak bisa di hapus',
                'error'
            )
        </script>
    @endif
    @if (Session::get('tidakbisamenambah'))
        <script>
            Swal.fire(
                'Error',
                'Data bulan sebelumnya tidak bisa di tambah / data ayam tidak ada',
                'error'
            )
        </script>
    @endif
    @if (Session::get('dataayamtidakada'))
        <script>
            Swal.fire(
                'Error',
                'data ayam tidak ada',
                'error'
            )
        </script>
    @endif
    @if (Session::get('punyarelasi'))
        <script>
            Swal.fire(
                'Error',
                'Data distribusi ayam terhubung dengan data pendapatan',
                'error'
            )
        </script>
    @endif

@endsection
