<?php
/**
 * Created by PhpStorm.
 * User: esther
 * Date: 12/10/2017
 * Time: 12:34
 */
?>
@extends('admin.templates.default')
@section('page_title', 'Dashboard')
@section('body-class', 'hold-transition skin-blue sidebar-mini')


@section('content')

    <div class="wrapper">

        @include('admin.partials.nav')
        @include('admin.partials.sidebar')
                <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                </h1>
                @include('admin.partials.breadcrum')
            </section>
            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    @if(config('savysoft.show_dev_tips'))
                        <div class="alert alert-info">
                            <strong>How To Use:</strong>
                            <p>You can get the value of each setting anywhere on your site by calling <code>setting('key')</code></p>
                        </div>
                    @endif
                </div>

                <div class="page-content container-fluid">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        {{ method_field("PUT") }}
                        {{ csrf_field() }}
                        <div class="panel">
                            @foreach($settings as $setting)
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $setting->display_name }}<code>setting('{{ $setting->key }}')</code>
                                    </h3>
                                    <div class="panel-actions">
                                        <a href="{{--{{ route('voyager.settings.move_up', $setting->id) }}--}}">
                                            <i class="sort-icons voyager-sort-asc"></i>
                                        </a>
                                        <a href="{{--{{ route('voyager.settings.move_down', $setting->id) }}--}}">
                                            <i class="sort-icons voyager-sort-desc"></i>
                                        </a>
                                        <i class="voyager-trash"
                                           data-id="{{ $setting->id }}"
                                           data-display-key="{{ $setting->key }}"
                                           data-display-name="{{ $setting->display_name }}"></i>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @if ($setting->type == "text")
                                        <input type="text" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
                                    @elseif($setting->type == "text_area")
                                        <textarea class="form-control" name="{{ $setting->key }}">@if(isset($setting->value)){{ $setting->value }}@endif</textarea>
                                    @elseif($setting->type == "rich_text_box")
                                        <textarea class="form-control richTextBox" name="{{ $setting->key }}">@if(isset($setting->value)){{ $setting->value }}@endif</textarea>
                                    @elseif($setting->type == "code_editor")
                                        {{ $options = $setting ? json_decode($setting->details) : NULL}}
                                        <div id="{{ $setting->key }}" data-theme="{{ @$options->theme }}" data-language="{{ @$options->language }}" class="ace_editor min_height_400" name="{{ $setting->key }}">@if(isset($setting->value)){{ $setting->value }}@endif</div>
                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}_textarea" class="hidden">@if(isset($setting->value)){{ $setting->value }}@endif</textarea>
                                    @elseif($setting->type == "image" || $setting->type == "file")
                                        @if(isset( $setting->value ) && !empty( $setting->value ) && Storage::disk(config('savysoft.storage.disk'))->exists($setting->value))
                                            <div class="img_settings_container">
                                                <a href="{{  route('admin.settings.delete_value', $setting->id) }}" class="voyager-x"><i class="fa fa-times"></i> </a>
                                                <img src="{{ Storage::disk(config('savysoft.storage.disk'))->url($setting->value) }}" style="width:200px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                            </div>
                                            <div class="clearfix"></div>
                                        @elseif($setting->type == "file" && isset( $setting->value ))
                                            <div class="fileType">{{ $setting->value }}</div>
                                        @endif
                                        <input type="file" name="{{ $setting->key }}">
                                    @elseif($setting->type == "select_dropdown")
                                        <?php $options = json_decode($setting->details); ?>
                                        <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                                        <select class="form-control" name="{{ $setting->key }}">
                                            <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                            @if(isset($options->options))
                                                @foreach($options->options as $index => $option)
                                                    <option value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'selected="selected"' }}@endif @if($selected_value == $index){{ 'selected="selected"' }}@endif>{{ $option }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                    @elseif($setting->type == "radio_btn")
                                        <?php $options = json_decode($setting->details); ?>
                                        <?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
                                        <?php $default = (isset($options->default)) ? $options->default : NULL; ?>
                                        <ul class="radio">
                                            @if(isset($options->options))
                                                @foreach($options->options as $index => $option)
                                                    <li>
                                                        <input type="radio" id="option-{{ $index }}" name="{{ $setting->key }}"
                                                               value="{{ $index }}" @if($default == $index && $selected_value === NULL){{ 'checked' }}@endif @if($selected_value == $index){{ 'checked' }}@endif>
                                                        <label for="option-{{ $index }}">{{ $option }}</label>
                                                        <div class="check"></div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @elseif($setting->type == "checkbox")
                                        <?php $options = json_decode($setting->details); ?>
                                        <?php $checked = (isset($setting->value) && $setting->value == 1) ? true : false; ?>
                                        @if (isset($options->on) && isset($options->off))
                                            <input type="checkbox" name="{{ $setting->key }}" class="toggleswitch" @if($checked) checked @endif data-on="{{ $options->on }}" data-off="{{ $options->off }}">
                                        @else
                                            <input type="checkbox" name="{{ $setting->key }}" @if($checked) checked @endif class="toggleswitch">
                                        @endif
                                    @endif

                                </div>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Save Settings</button>
                    </form>

                    <div style="clear:both"></div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        @include('admin.partials.control-sidebar')
    </div>
    <!-- ./wrapper -->
@endsection

@push('scripts')
    <iframe id="form_target" name="form_target" style="display:none"></iframe>
    <form id="my_form" action="{{ route('admin.settings.upload') }}" target="form_target" method="POST" enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
        {{ csrf_field() }}
        <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
        <input type="hidden" name="type_slug" id="type_slug" value="settings">
    </form>

    <script src="{{ '/admin/js/tinymce/tinymce.min.js' }}"></script>
    <script src="{{ '/admin/js/voyager_tinymce.js' }}"></script>
    <script src="{{ '/admin/js/ace/ace.js' }}"></script>
    <script src="{{ '/admin/js/voyager_ace_editor.js' }}"></script>
    <script type="text/javascript">
        var options_editor = ace.edit('options_editor');
        options_editor.getSession().setMode("ace/mode/json");

        var options_textarea = document.getElementById('options_textarea');
        options_editor.getSession().on('change', function() {
            options_textarea.value = options_editor.getValue();
        });
    </script>
@endpush
@push('scripts')
<script type="text/javascript">
    $(function () {


    });
</script>
@endpush
