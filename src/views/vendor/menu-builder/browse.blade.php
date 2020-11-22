@extends('root-view::admin-lte.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold">Menu List</h3>

                        <a href="{{route('admin.loc-divisions.create')}}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle"></i> Add new
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-striped table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Menu Name</th>
                                <th>Menu Code</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($menus as $i => $menu)
                                <tr>
                                    <td>{{$i + 1}}</td>
                                    <td>{{$menu->name}}</td>
                                    <td>{{$menu->code}}</td>
                                    <td>
                                        <a href="#">Builder</a>
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="1000">
                                        Empty table
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('root-view::utils.delete-confirm-modal')
@endsection
@push('js')
    <script>
        $(function () {
            $(document, 'td').on('click', '.delete', function (e) {
                $('#delete_form')[0].action = $(this).data('action');
                $('#delete_modal').modal('show');
            });
        });
    </script>
@endpush
