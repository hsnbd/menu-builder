@extends('root-view::admin-lte.main')


@push('css')
<style>
    #nestable-list {
        padding: 10px;
        border: 1px solid #d0d0d0;
    }
    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        max-width: 600px;
        list-style: none;
        font-size: 13px;
        line-height: 20px; }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none; }
    .dd-list .dd-list {
        padding-left: 30px; }

    .dd-item,
    .dd-empty,
    .dd-placeholder {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px; }

    .dd-handle {
        display: block;
        height: 30px;
        margin: 5px 0;
        padding: 5px 10px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        border-radius: 3px;
        box-sizing: border-box; }
    .dd-handle:hover {
        color: #2ea8e5;
        background: #fff; }

    .dd-item > button {
        position: relative;
        cursor: pointer;
        float: left;
        width: 25px;
        height: 20px;
        margin: 5px 0;
        padding: 0;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 0;
        background: transparent;
        font-size: 12px;
        line-height: 1;
        text-align: center;
        font-weight: bold; }
    .dd-item > button:before {
        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        text-indent: 0; }
    .dd-item > button.dd-expand:before {
        content: '+'; }
    .dd-item > button.dd-collapse:before {
        content: '-'; }

    .dd-expand {
        display: none; }

    .dd-collapsed .dd-list,
    .dd-collapsed .dd-collapse {
        display: none; }

    .dd-collapsed .dd-expand {
        display: block; }

    .dd-empty,
    .dd-placeholder {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box; }

    .dd-empty {
        border: 1px dashed #bbb;
        min-height: 100px;
        background-color: #e5e5e5;
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px; }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle {
        margin-top: 0; }
    .dd-dragel .dd-handle {
        box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1); }

    .dd-nochildren .dd-placeholder {
        display: none; }



    .dd {
        position: relative;
        display: block;
        margin: 0;
        padding: 0;
        list-style: none;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-list {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .dd-list .dd-list {
        padding-left: 30px;
    }

    .dd-collapsed .dd-list {
        display: none;
    }

    .dd-item,
    .dd-empty,
    .dd-placeholder {
        display: block;
        position: relative;
        margin: 0;
        padding: 0;
        min-height: 20px;
        font-size: 13px;
        line-height: 20px;
    }

    .dd-handle {
        display: block;
        height: 50px;
        margin: 5px 0;
        padding: 14px 25px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd-handle:hover {
        color: #2ea8e5;
        background: #fff;
    }

    .dd-item > button {
        display: block;
        position: relative;
        cursor: pointer;
        float: left;
        width: 40px;
        height: 37px;
        margin: 5px 0;
        padding: 0;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 0;
        background: transparent;
        font-size: 12px;
        line-height: 1;
        text-align: center;
        font-weight: bold;
    }

    .dd-item > button:before {
        content: '+';
        display: block;
        position: absolute;
        width: 100%;
        text-align: center;
        text-indent: 0;
    }

    .dd-item > button[data-action="collapse"]:before {
        content: '-';
    }

    .dd-placeholder,
    .dd-empty {
        margin: 5px 0;
        padding: 0;
        min-height: 30px;
        background: #f2fbff;
        border: 1px dashed #b6bcbf;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .dd-empty {
        border: 1px dashed #bbb;
        min-height: 100px;
        background-color: #e5e5e5;
        background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
        linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .dd-dragel {
        position: absolute;
        pointer-events: none;
        z-index: 9999;
    }

    .dd-dragel > .dd-item .dd-handle {
        margin-top: 0;
    }

    .dd-dragel .dd-handle {
        -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
    }
    .nestable-lists {
        display: block;
        clear: both;
        padding: 30px 0;
        width: 100%;
        border: 0;
        border-top: 2px solid #ddd;
        border-bottom: 2px solid #ddd;
    }
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold">Menu Builder</h3>

                        <a href="{{route('admin.loc-divisions.create')}}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus-circle"></i> Add new
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="nestable-list" class="dd">
                            <ul class="dd-list">
                                <li class="dd-item" data-id="1">
                                    <div class="dd-handle">Item 1 <button type="button" class="btn btn-sm pull-right btn-success">Delete</button> <button type="button" class="btn btn-sm btn-success">Delete</button> </div>
                                </li>
                                <li class="dd-item" data-id="2">
                                    <div class="dd-handle">Item 2</div>
                                </li>
                                <li class="dd-item" data-id="3">
                                    <div class="dd-handle">Item 3</div>
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="4">
                                            <div class="dd-handle">Item 4</div>
                                        </li>
                                        <li class="dd-item" data-id="5">
                                            <div class="dd-handle">Item 5</div>
                                        </li>
                                    </ol>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('root-view::utils.delete-confirm-modal')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <p class="panel-title" style="color:#777">{{ __('voyager::menu_builder.drag_drop_info') }}</p>
                    </div>

                    <div class="panel-body" style="padding:30px;">
                        <div class="dd">
                            <ol class="dd-list">
                                @foreach ($items as $item)
                                    <li class="dd-item" data-id="{{ $item->id }}">
                                        <div class="pull-right item_actions">
                                            <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}">
                                                <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
                                            </div>
                                            <div class="btn btn-sm btn-primary pull-right edit"
                                                 data-id="{{ $item->id }}"
                                                 data-title="{{ $item->title }}"
                                                 data-url="{{ $item->url }}"
                                                 data-target="{{ $item->target }}"
                                                 data-icon_class="{{ $item->icon_class }}"
                                                 data-color="{{ $item->color }}"
                                                 data-route="{{ $item->route }}"
                                                 data-title_lang_key="{{ $item->title_lang_key }}"
                                                 data-permission_key="{{ $item->permission_key }}"
                                                 data-parameters="{{ json_encode($item->parameters) }}"
                                            >
                                                <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
                                            </div>
                                        </div>
                                        <div class="dd-handle">
                                            @if($options->isModelTranslatable)
                                                @include('voyager::multilingual.input-hidden', [
                                                    'isModelTranslatable' => true,
                                                    '_field_name'         => 'title'.$item->id,
                                                    '_field_trans'        => json_encode($item->getTranslationsOf('title'))
                                                ])
                                            @endif
                                            <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small>
                                        </div>
                                        @if(!$item->children->isEmpty())
                                            @include('voyager::menu.admin', ['items' => $item->children])
                                        @endif
                                    </li>

                                @endforeach
                            </ol>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::menu_builder.delete_item_question') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <form action="{{ route('voyager.menus.item.destroy', ['menu' => $menu->id, 'id' => '__id']) }}"
                          id="delete_form"
                          method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::menu_builder.delete_item_confirm') }}">
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal modal-primary fade" id="menu_item_modal" tabindex="-1" role="dialog" aria-labelledby="menu_item_modal_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="m_hd_add" class="modal-title hidden"><i class="voyager-plus"></i> {{ __('voyager::menu_builder.create_new_item') }}</h4>
                    <h4 id="m_hd_edit" class="modal-title hidden"><i class="voyager-edit"></i> {{ __('voyager::menu_builder.edit_item') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <form action="" id="m_form" method="POST"
                      data-action-add="{{ route('voyager.menus.item.add', ['menu' => $menu->id]) }}"
                      data-action-update="{{ route('voyager.menus.item.update', ['menu' => $menu->id]) }}">

                    <input id="m_form_method" type="hidden" name="_method" value="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="m_title">{{ __('voyager::menu_builder.item_title') }}</label>
                        <input type="text" class="form-control" id="m_title" name="title"
                               placeholder="{{ __('voyager::generic.title') }}"><br>
                        <label for="m_title">{{ __('voyager::generic.title_lang_key') }}</label>
                        <input type="text" class="form-control" id="m_title_lang_key" name="title_lang_key"
                               placeholder="{{ __('voyager::generic.title_lang_key') }}"><br>
                        <label for="m_link_type">{{ __('voyager::menu_builder.link_type') }}</label>
                        <select id="m_link_type" class="form-control" name="type">
                            <option value="url"
                                    selected="selected">{{ __('voyager::menu_builder.static_url') }}</option>
                            <option value="route">{{ __('voyager::menu_builder.dynamic_route') }}</option>
                        </select><br>
                        <div id="m_url_type">
                            <label for="m_url">{{ __('voyager::menu_builder.url') }}</label>
                            <input type="text" class="form-control" id="m_url" name="url"
                                   placeholder="{{ __('voyager::generic.url') }}"><br>
                        </div>
                        <div id="m_route_type">
                            <label for="m_route">{{ __('voyager::menu_builder.item_route') }}</label>
                            <input type="text" class="form-control" id="m_route" name="route"
                                   placeholder="{{ __('voyager::generic.route') }}"><br>
                            <label for="m_parameters">{{ __('voyager::menu_builder.route_parameter') }}</label>
                            <textarea rows="3" class="form-control" id="m_parameters" name="parameters"
                                      placeholder="{{ json_encode(['key' => 'value'], JSON_PRETTY_PRINT) }}"></textarea><br>
                        </div>
                        <label for="m_icon_class">{{ __('voyager::menu_builder.icon_class') }} <a
                                href="{{ route('voyager.compass.index', [], false) }}#fonts"
                                target="_blank">{!! __('voyager::menu_builder.icon_class2') !!}</label>
                        <input type="text" class="form-control" id="m_icon_class" name="icon_class"
                               placeholder="{{ __('voyager::menu_builder.icon_class_ph') }}"><br>
                        <!-- Added by Mahmud -->
                        <label for="m_permission_key">{{ __('voyager::menu_builder.permission_key') }}</label>
                        <input type="text" class="form-control" id="m_permission_key" name="permission_key"
                               placeholder="{{ __('voyager::menu_builder.permission_key') }}"><br>
                        <!-- end of Added by Mahmud -->
                        <label for="m_color">{{ __('voyager::menu_builder.color') }}</label>
                        <input type="color" class="form-control" id="m_color" name="color"
                               placeholder="{{ __('voyager::menu_builder.color_ph') }}"><br>
                        <label for="m_target">{{ __('voyager::menu_builder.open_in') }}</label>
                        <select id="m_target" class="form-control" name="target">
                            <option value="_self"
                                    selected="selected">{{ __('voyager::menu_builder.open_same') }}</option>
                            <option value="_blank">{{ __('voyager::menu_builder.open_new') }}</option>
                        </select>
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <input type="hidden" name="id" id="m_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right"
                                data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                        <input type="submit" class="btn btn-success pull-right delete-confirm__"
                               value="{{ __('voyager::generic.update') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('js')
    <script type="text/javascript" src="{{asset('/js/jquery-nestable.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.dd').nestable({
                expandBtnHTML: '',
                collapseBtnHTML: ''
            });
        });
        $(function () {
            $(document, 'td').on('click', '.delete', function (e) {
                $('#delete_form')[0].action = $(this).data('action');
                $('#delete_modal').modal('show');
            });
        });

        $(document).ready(function () {
            $('.dd').nestable({
                expandBtnHTML: '',
                collapseBtnHTML: ''
            });


            /**
             * Set Variables
             */
            var $m_modal = $('#menu_item_modal'),
                $m_hd_add = $('#m_hd_add').hide().removeClass('hidden'),
                $m_hd_edit = $('#m_hd_edit').hide().removeClass('hidden'),
                $m_form = $('#m_form'),
                $m_form_method = $('#m_form_method'),
                $m_title = $('#m_title'),
                $m_title_i18n = $('#title_i18n'),
                $m_title_lang_key = $('#m_title_lang_key'),
                $m_url_type = $('#m_url_type'),
                $m_url = $('#m_url'),
                $m_link_type = $('#m_link_type'),
                $m_route_type = $('#m_route_type'),
                $m_route = $('#m_route'),
                $m_parameters = $('#m_parameters'),
                $m_permission_key = $('#m_permission_key'),
                $m_icon_class = $('#m_icon_class'),
                $m_color = $('#m_color'),
                $m_target = $('#m_target'),
                $m_id = $('#m_id');

            /**
             * Add Menu
             */
            $('.add_item').click(function () {
                $m_form.trigger('reset');
                $m_form.find("input[type=submit]").val('{{ __('voyager::generic.add') }}');
                $m_modal.modal('show', {data: null});
            });

            /**
             * Edit Menu
             */
            $('.item_actions').on('click', '.edit', function (e) {
                $m_form.find("input[type=submit]").val('{{ __('voyager::generic.update') }}');
                $m_modal.modal('show', {data: $(e.currentTarget)});
            });

            /**
             * Menu Modal is Open
             */
            $m_modal.on('show.bs.modal', function (e, data) {
                var _adding = e.relatedTarget.data ? false : true;

                if (_adding) {
                    $m_form.attr('action', $m_form.data('action-add'));
                    $m_form_method.val('POST');
                    $m_hd_add.show();
                    $m_hd_edit.hide();
                    $m_target.val('_self').change();
                    $m_link_type.val('url').change();
                    $m_url.val('');
                    $m_icon_class.val('');

                } else {
                    $m_form.attr('action', $m_form.data('action-update'));
                    $m_form_method.val('PUT');
                    $m_hd_add.hide();
                    $m_hd_edit.show();

                    var _src = e.relatedTarget.data, // the source
                        id = _src.data('id');

                    $m_title.val(_src.data('title'));
                    $m_url.val(_src.data('url'));
                    $m_route.val(_src.data('route'));
                    $m_parameters.val(JSON.stringify(_src.data('parameters')));
                    $m_permission_key.val(_src.data('permission_key'));
                    $m_title_lang_key.val(_src.data('title_lang_key'));
                    $m_icon_class.val(_src.data('icon_class'));
                    $m_color.val(_src.data('color'));
                    $m_id.val(id);

                    if (_src.data('target') == '_self') {
                        $m_target.val('_self').change();
                    } else if (_src.data('target') == '_blank') {
                        $m_target.find("option[value='_self']").removeAttr('selected');
                        $m_target.find("option[value='_blank']").attr('selected', 'selected');
                        $m_target.val('_blank');
                    }
                    if (_src.data('route') != "") {
                        $m_link_type.val('route').change();
                        $m_url_type.hide();
                    } else {
                        $m_link_type.val('url').change();
                        $m_route_type.hide();
                    }
                    if ($m_link_type.val() == 'route') {
                        $m_url_type.hide();
                        $m_route_type.show();
                    } else {
                        $m_route_type.hide();
                        $m_url_type.show();
                    }
                }
            });


            /**
             * Toggle Form Menu Type
             */
            $m_link_type.on('change', function (e) {
                if ($m_link_type.val() == 'route') {
                    $m_url_type.hide();
                    $m_route_type.show();
                } else {
                    $m_url_type.show();
                    $m_route_type.hide();
                }
            });


            /**
             * Delete menu item
             */
            $('.item_actions').on('click', '.delete', function (e) {
                id = $(e.currentTarget).data('id');
                $('#delete_form')[0].action = '{{ route('voyager.menus.item.destroy', ['menu' => $menu->id, 'id' => '']) }}/' + id;
                $('#delete_modal').modal('show');
            });


            /**
             * Reorder items
             */
            $('.dd').on('change', function (e) {
                $.post('{{ route('voyager.menus.order',['menu' => $menu->id]) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    toastr.success("{{ __('voyager::menu_builder.updated_order') }}");
                });
            });
        });
    </script>
@endpush
