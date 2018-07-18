<?php
/**
 * Created by PhpStorm.
 * User: Esther
 * Date: 1/23/2018
 * Time: 7:33 AM
 */
?>


<ol class="breadcrumb hidden-xs">
    @if(count(Request::segments()) == 1)
        <li class="active"><i class="fa fa-dashboard"></i> Admin</li>
    @else
        <li class="active">
            <a href="{{ route('admin.index')}}"><i class="fa fa-dashboard"></i> Admin</a>
        </li>
    @endif
    <?php $breadcrumb_url = url(''); ?>
    @for($i = 1; $i <= count(Request::segments()); $i++)
        <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
        @if(Request::segment($i) != ltrim(route('admin.index', [], false), '/') && !is_numeric(Request::segment($i)))

            @if($i < count(Request::segments()) & $i > 0)
                <li class="active"><a href="{{ $breadcrumb_url }}">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a>
                </li>
            @else
                <li>{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</li>
            @endif

        @endif
    @endfor
</ol>

