@extends('admin.layout.main')

@section('title', 'Data Penghasilan')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Penghasilan</h2>
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
                                            <th>Tanggal</th>
                                            <th>Pendapatan</th>
                                            <th>Pengeluaran Ayam</th>
                                            <th>Pengeluaran Pakan</th>
                                            <th>Pengeluaran Vaksin</th>
                                            {{-- <th>Pengeluaran Gaji</th> --}}
                                            <th>Penghasilan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($datapenghasilan as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->tanggal }}</td>
                                                <td>Rp. {{ number_format($data->pendapatan) }}</td>
                                                <td>Rp. {{ number_format($data->pengeluaran_ayam) }}</td>
                                                <td>Rp. {{ number_format($data->pengeluaran_pakan) }}</td>
                                                <td>Rp. {{ number_format($data->pengeluaran_vaksin) }}</td>
                                                {{-- <td>Rp. {{ number_format($data->pengeluaran_gaji) }}</td> --}}
                                                <td>Rp. {{ number_format($data->penghasilan) }}</td>

                                                <td>
                                                    {{-- <a class="btn btn-primary btn-sm"
                                                        href="/datapengeluaran/{{ $data->id }}">Detail</a> --}}

                                                    {{-- <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#detailModal{{ $data->id }}">Detail</button> --}}

                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editModal{{ $data->id }}">Edit</button>

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
                                                        <form action="/datapenghasilan/{{ $data->id }}" method="post">
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
                                                            <h5 class="modal-title" id="defaultModalLabel">Edit Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="/datapenghasilan/{{ $data->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">


                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Tanggal
                                                                    </label>
                                                                    <input type="date" value="{{ $data->tanggal }}"
                                                                        name="tanggal" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                {{-- <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Pendapatan</label>
                                                                    <input type="text" value="{{ $data->pendapatan }}"
                                                                        name="pendapatan" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Pengeluaran Ayam</label>
                                                                    <input type="text"
                                                                        value="{{ $data->pengeluaran_ayam }}"
                                                                        name="pengeluaran_ayam" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Pengeluaran Pakan</label>
                                                                    <input type="text"
                                                                        value="{{ $data->pengeluaran_pakan }}"
                                                                        name="pengeluaran_pakan" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Pengeluaran Vaksin</label>
                                                                    <input type="text"
                                                                        value="{{ $data->pengeluaran_vaksin }}"
                                                                        name="pengeluaran_vaksin" class="form-control"
                                                                        id="recipient-name">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Pengeluaran Gaji</label>
                                                                    <input type="text"
                                                                        value="{{ $data->pengeluaran_gaji }}"
                                                                        name="pengeluaran_gaji" class="form-control"
                                                                        id="recipient-name">
                                                                </div> --}}

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pendapatan</label>
                                                                    <select name="pendapatan" class="form-control">
                                                                        {{-- <option selected value="{{ $data->pendapatan }}">
                                                                            {{ $data->tanggal }}
                                                                            - Rp. {{ number_format($data->pendapatan) }}
                                                                        </option> --}}
                                                                        @foreach ($datapendapatan as $data)
                                                                            <option value="{{ $data->total }}">
                                                                                {{ $data->tanggal }}
                                                                                - Rp. {{ number_format($data->total) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pengeluaran
                                                                        Ayam</label>
                                                                    <select name="pengeluaran_ayam" class="form-control">
                                                                        {{-- <option selected
                                                                            value="{{ $data->pengeluaran_ayam }}">
                                                                            {{ $data->tanggal }}
                                                                            - Rp.
                                                                            {{ number_format($data->pengeluaran_ayam) }}
                                                                        </option> --}}
                                                                        @foreach ($datapengeluaranayam as $data)
                                                                            <option value="{{ $data->total }}">
                                                                                {{ $data->tanggal }}
                                                                                - Rp. {{ number_format($data->total) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pengeluaran
                                                                        Pakan</label>
                                                                    <select name="pengeluaran_pakan" class="form-control">
                                                                        {{-- <option selected
                                                                            value="{{ $data->pengeluaran_pakan }}">
                                                                            {{ $data->tanggal }}
                                                                            - Rp.
                                                                            {{ number_format($data->pengeluaran_pakan) }}
                                                                        </option> --}}
                                                                        @foreach ($datapengeluaranpakan as $data)
                                                                            <option value="{{ $data->total }}">
                                                                                {{ $data->tanggal }}
                                                                                - Rp. {{ number_format($data->total) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pengeluaran
                                                                        Vaksin</label>
                                                                    <select name="pengeluaran_vaksin" class="form-control">
                                                                        {{-- <option selected
                                                                            value="{{ $data->pengeluaran_vaksin }}">
                                                                            {{ $data->tanggal }}
                                                                            - Rp.
                                                                            {{ number_format($data->pengeluaran_vaksin) }}
                                                                        </option> --}}
                                                                        @foreach ($datapengeluaranvaksin as $data)
                                                                            <option value="{{ $data->total }}">
                                                                                {{ $data->tanggal }}
                                                                                - Rp. {{ number_format($data->total) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                {{--
                                                                <div class="form-group">
                                                                    <label for="simple-select2">Data Pengeluaran
                                                                        Gaji</label>
                                                                    <select name="pengeluaran_gaji" class="form-control">
                                                                        <option selected
                                                                            value="{{ $data->pengeluaran_gaji }}">
                                                                            {{ $data->tanggal }}
                                                                            - Rp.
                                                                            {{ number_format($data->pengeluaran_gaji) }}
                                                                        </option>
                                                                        @foreach ($datapengeluarangaji as $data)
                                                                            <option value="{{ $data->total }}">
                                                                                {{ $data->tanggal }}
                                                                                - Rp. {{ number_format($data->total) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
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
                                            <form action="/datapenghasilan" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Tanggal
                                                        </label>
                                                        <input type="date" value="" name="tanggal"
                                                            class="form-control" id="recipient-name">
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name"
                                                            class="col-form-label">Pendapatan</label>
                                                        <input type="text" value="" name="pendapatan"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}

                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Pengeluaran
                                                            Ayam</label>
                                                        <input type="text" value="" name="pengeluaran_ayam"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}

                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Pengeluaran
                                                            Pakan</label>
                                                        <input type="text" value="" name="pengeluaran_pakan"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}

                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Pengeluaran
                                                            Vaksin</label>
                                                        <input type="text" value="" name="pengeluaran_vaksin"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}


                                                    {{-- <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Pengeluaran
                                                            Gaji</label>
                                                        <input type="text" value="" name="pengeluaran_gaji"
                                                            class="form-control" id="recipient-name">
                                                    </div> --}}

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Pendapatan</label>
                                                        <select name="pendapatan" class="form-control">
                                                            <option selected disabled>Pilih Data Pendapatan</option>
                                                            @foreach ($datapendapatan as $data)
                                                                <option value="{{ $data->total }}">
                                                                    {{ $data->tanggal }}
                                                                    - Rp. {{ number_format($data->total) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Pengeluaran Ayam</label>
                                                        <select name="pengeluaran_ayam" class="form-control">
                                                            <option selected disabled>Pilih Data Pengeluaran Ayam</option>
                                                            @foreach ($datapengeluaranayam as $data)
                                                                <option value="{{ $data->total }}">
                                                                    {{ $data->tanggal }}
                                                                    - Rp. {{ number_format($data->total) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Pengeluaran Pakan</label>
                                                        <select name="pengeluaran_pakan" class="form-control">
                                                            <option selected disabled>Pilih Data Pengeluaran Pakan</option>
                                                            @foreach ($datapengeluaranpakan as $data)
                                                                <option value="{{ $data->total }}">
                                                                    {{ $data->tanggal }}
                                                                    - Rp. {{ number_format($data->total) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="simple-select2">Data Pengeluaran Vaksin</label>
                                                        <select name="pengeluaran_vaksin" class="form-control">
                                                            <option selected disabled>Pilih Data Pengeluaran Vaksin</option>
                                                            @foreach ($datapengeluaranvaksin as $data)
                                                                <option value="{{ $data->total }}">
                                                                    {{ $data->tanggal }}
                                                                    - Rp. {{ number_format($data->total) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- <div class="form-group">
                                                        <label for="simple-select2">Data Pengeluaran Gaji</label>
                                                        <select name="pengeluaran_gaji" class="form-control">
                                                            <option selected disabled>Pilih Data Pengeluaran Gaji</option>
                                                            @foreach ($datapengeluarangaji as $data)
                                                                <option value="{{ $data->total }}">
                                                                    {{ $data->tanggal }}
                                                                    - Rp. {{ number_format($data->total) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn mb-2 btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn mb-2 btn-success">Save
                                                    </button>
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

@endsection
