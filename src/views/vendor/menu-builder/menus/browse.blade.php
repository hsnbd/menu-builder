@extends(config('menu-builder.template.master_page'))

@section(config('menu-builder.template.content_placeholder', 'content'))
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title font-weight-bold">Menu List</h3>

                    <a href="{{route('menu-builder.menus.create')}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Add new
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Menu</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($menus as $i => $menu)
                            <tr>
                                <td>{{$i + 1}}</td>
                                <td>{{$menu->name}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{route('menu-builder.menus.builder', $menu->id)}}"
                                           class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-building"></i> Builder
                                        </a>
                                        <a href="{{route('menu-builder.menus.edit', $menu->id)}}"
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="#" data-action="{{route('menu-builder.menus.destroy', $menu->id)}}"
                                           class="btn btn-sm delete btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
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

<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('Are you sure?') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label=""><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>This action is permanent.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right"
                        data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action=""
                      id="delete_form"
                      method="POST">
                    {{ method_field("DELETE") }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                           value="{{ __('Delete') }}">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@push(config('menu-builder.template.js_placeholder', 'js'))
<script>
    $(function () {
        $(document, 'td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = $(this).data('action');
            $('#delete_modal').modal('show');
        });
    });
</script>
@endpush
