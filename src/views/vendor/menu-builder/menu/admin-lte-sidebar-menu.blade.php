@if(!isset($innerLoop))
    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
        @else
            <ul class="nav nav-treeview">
                @endif
                @foreach ($items as $item)
                    @php
                        $originalItem = $item;
                        $listItemClass = 'nav-item';
                        $linkAttributes =  null;
                        $styles = null;
                        $icon = null;
                        $caret = null;

                        // Background Color or Color
                        if (isset($options->color) && $options->color == true) {
                            $styles = 'color:'.$item->color;
                        }
                        if (isset($options->background) && $options->background == true) {
                            $styles = 'background-color:'.$item->color;
                        }

                        // With Children Attributes
                        if(!$originalItem->children->isEmpty()) {
                            $listItemClass .=  ' has-treeview';
                            $caret = '<i class="right fas fa-angle-left"></i>';
                        }

                        if (url($item->link()) == url()->current()) {
                            $linkAttributes = 'active';
                        }

                        // Set Icon
                        if(isset($options->icon) && $options->icon == true){
                            $icon = '<i class="nav-icon fas ' . $item->icon_class . '"></i>';
                        }
                    @endphp

                    <li class="{{ $listItemClass }}">
                        <a href="{{ url($item->link()) }}" target="{{ $item->target }}"
                           class="nav-link {{$linkAttributes}}">
                            {!! $icon !!}
                            <p>
                                {{ $item->title }}
                                {!! $caret !!}
                            </p>
                        </a>
                        @if(!$originalItem->children->isEmpty())
                            @include('menu-builder::menu.admin-lte-sidebar-menu', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                        @endif
                    </li>
                @endforeach
            </ul>
