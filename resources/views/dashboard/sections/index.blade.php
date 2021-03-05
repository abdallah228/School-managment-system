@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{ trans('dashboard/sections.title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('dashboard/sections.title') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                {{ trans('dashboard/sections.section.add') }}</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">

                        @foreach ($grades as $grades)

                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{ $grades->name }}</a>
                                <div class="acd-des">

                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                            <tr class="text-dark">
                                                                <th>#</th>
                                                                <th>{{ trans('dashboard/sections.section.name') }}
                                                                </th>
                                                                <th>{{ trans('dashboard/sections.class.name') }}</th>
                                                                <th>{{ trans('dashboard/sections.section.status') }}</th>
                                                                <th>{{ trans('dashboard/sections.section.process') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($grades->sections as $index=>$list_Sections)
                                                                <tr>
                                                                    <td>{{ $index+=1 }}</td>
                                                                    <td>{{ $list_Sections->name }}</td>
                                                                    <td>{{ $list_Sections->classes_rooms->name }}
                                                                    </td>
                                                                    <td>
                                                                   {!!$list_Sections->get_status() !!}

                                                                    </td>
                                                                    <td>

                                                                        <a href="#"
                                                                            class="btn btn-outline-info btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#edit{{ $list_Sections->id }}">{{ trans('dashboard/sections.edit') }}</a>
                                                                        <a href="#"
                                                                            class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#delete{{ $list_Sections->id }}">{{ trans('dashboard/sections.delete') }}</a>
                                                                    </td>
                                                                </tr>


                                <!--تعديل قسم جديد -->
                                <div class="modal fade"
                                        id="edit{{ $list_Sections->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    style="font-family: 'Cairo', sans-serif;"
                                                    id="exampleModalLabel">
                                                    {{ trans('dashboard/sections.sections_edit') }}
                                                </h5>
                                                <button type="button" class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                <span
                                                    aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form
                                                    action="{{ route('sections.update', $list_Sections->id) }}"
                                                    method="POST">
                                                    {{ method_field('patch') }}
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text"
                                                                    name="name_ar"
                                                                    class="form-control"
                                                                    value="{{ $list_Sections->getTranslation('name', 'ar') }}">
                                                                </div>

                                                        <div class="col">
                                                            <input type="text"
                                                                    name="name_en"
                                                                    class="form-control"
                                                                    value="{{ $list_Sections->getTranslation('name', 'en') }}">
                                                            <input id="id"
                                                                    type="hidden"
                                                                    name="id"
                                                                    class="form-control"
                                                                    value="{{ $list_Sections->id }}">
                                                        </div>

                                                    </div>
                                                    <br>


                                                    <div class="col">
                                                        <label for="inputName"
                                                                class="control-label">{{ trans('dashboard/sections.grade_name') }}</label>
                                                        <select name="grade_id"
                                                                class="custom-select"
                                                                onclick="console.log($(this).val())">
                                                            <!--placeholder-->
                                                            <option
                                                                value="{{ $grades->id }}">
                                                                {{ $grades->name }}
                                                            </option>
                                                            @foreach ($list_grades as $grade)
                                                                <!-- <option
                                                                    value="{{ $grade->id }}">
                                                                    {{ $grade->name }}
                                                                </option> -->
                                                                    @if($grade->name !== $grades->name)
                                                                    <option value="{{ $grade->id }}">
                                                                        {{ $grade->name }}
                                                                    </option>
                                                                    @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <br>

                                                    <div class="col">
                                                        <label for="inputName"
                                                                class="control-label">{{ trans('dashboard/sections.section_name') }}</label>
                                                        <select name="class_id"
                                                                class="custom-select">
                                                            <option
                                                                value="{{ $list_Sections->classes_rooms->id }}">
                                                                {{ $list_Sections->classes_rooms->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <br>

                                                    <div class="col">
                                                        <div class="form-check">
                                                                <input
                                                                    type="checkbox" 
                                                                    class="form-check-input"
                                                                    name="status"
                                                                    id="exampleCheck1" @if($list_Sections->status == true)
                                                                    checked @endif>
                                                           
                                                            <label
                                                                class="form-check-label"
                                                                for="exampleCheck1">{{ trans('dashboard/sections.status') }}</label>
                                                        </div>
                                                    </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">@lang('dashboard/sections.section_close')</button>
                                                <button type="submit"
                                                        class="btn btn-danger">@lang('dashboard/sections.section_submit')</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                                                <!-- delete_modal_Grade -->
                                                                <div class="modal fade"
                                                                        id="delete{{ $list_Sections->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                    class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ trans('dashboard/sections.delete_form') }}
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Closeing">
                                                                                <span
                                                                                    aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('sections.destroy', $list_Sections->id) }}"
                                                                                    method="post">
                                                                                    {{ method_field('Delete') }}
                                                                                    @csrf
                                                                                    {{ trans('dashboard/sections.warning_delete') }}
                                                                                    <input id="id" type="hidden"
                                                                                            name="id"
                                                                                            class="form-control"
                                                                                            value="{{ $list_Sections->id }}">
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">@lang('dashboard/sections.section_close')</button>
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard/sections.section_submit')</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    </div>
                </div>

                <!--اضافة قسم جديد -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                    id="exampleModalLabel">
                                    {{ __('dashboard/sections.section.add') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ route('sections.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="name_ar" class="form-control"
                                                    placeholder="{{ __('dashboard/sections.name_ar') }}">
                                        </div>

                                        <div class="col">
                                            <input type="text" name="name_en" class="form-control"
                                                    placeholder="{{ __('dashboard/sections.name_en') }}">
                                        </div>

                                    </div>
                                    <br>


                                    <div class="col">
                                        <label for="inputName"
                                                class="control-label">{{ __('dashboard/sections.grade_name') }}</label>
                                        <select name="grade_id" class="custom-select"
                                                onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="" selected
                                                    disabled>{{ __('dashboard/sections.grade_name') }}
                                            </option>
                                            
                                            @foreach ($list_grades as $list_grades)
                                                <option value="{{ $list_grades->id }}"> {{ $list_grades->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="col">
                                        <label for="inputName"
                                                class="control-label">{{ __('dashboard/sections.section_name') }}</label>
                                        <select name="class_id" class="custom-select">
                                                    
                                        </select>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('dashboard/sections.section_close') }}</button>
                                <button type="submit"
                                        class="btn btn-danger">{{ __('dashboard/sections.section_submit') }}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->
    @endsection
    @section('js')
        @toastr_js
        @toastr_render
        <script>
            $(document).ready(function () {
                $('select[name="grade_id"]').on('change', function () {
                    var grade_id = $(this).val();
                    if (grade_id) {
                        $.ajax({
                            url: "{{ URL::to('dashboard/classes') }}/" + grade_id,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('select[name="class_id"]').empty();
                                $.each(data, function (key, value) {
                                    $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            },
                        });
                    } else {
                        console.log('AJAX load did not work');
                    }
                });
            });
        </script>

@endsection