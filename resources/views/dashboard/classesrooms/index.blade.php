@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('dashboard/classroom.classes_room_title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('dashboard/classroom.classes_room_title') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
            {{ trans('dashboard/classroom.classes_room_add') }}
            </button>
            <button type="button" class="button x-small" id="btn_delete_all">{{__('dashboard/classroom.class_room_delete_all')}} </button>
            <br><br>
            <!--filter-->
                <form action="{{ route('filter_classes') }}" method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker" data-style="btn-info" name="grade_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('dashboard/classroom.Search_By_Grade') }}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </form>
                <!--end filter--><br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>
                            <input name="select_all" id="example-select-all" type="checkbox" onClick="CheckAll('box1', this)" />
                            </th>
                            <th>#</th>
                            <th>{{__('dashboard/classroom.class_room') }}</th>
                            <th>{{__('dashboard/classroom.grade_name') }}</th>
                            <th>{{__('dashboard/classroom.operations') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!--search by filter-->
                    @if (isset($search))

                    <?php $classes_rooms = $search; ?>
                    @endif
                   {{-- can i use else if $classes_rooms = $classes_rooms --}}
                        
                        @foreach ($classes_rooms as $index=>$classes_rooms)
                            <tr>
                                <td><input type="checkbox" value="{{$classes_rooms->id}}" class="box1" /></td>
                                <td>{{ $index +=1 }}</td>
                                <td>{{ $classes_rooms->name }}</td>
                                <td>{{ $classes_rooms->grades->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $classes_rooms->id }}"
                                        title="{{ trans('dashboard/classroom.edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $classes_rooms->id }}"
                                        title="{{ trans('dashboard/classroom.delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_Grade -->
          <!-- edit_modal_Grade -->
          <div class="modal fade" id="edit{{ $classes_rooms->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('dashboard/classroom.classes_room_update') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- edit_form -->
                                            <form action="{{ route('classes-rooms.update',$classes_rooms->id) }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                               class="mr-sm-2">{{ trans('dashboard/classroom.name_ar') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="name_ar"
                                                               class="form-control"
                                                               value="{{ $classes_rooms->getTranslation('name', 'ar') }}"
                                                               required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                               value="{{ $classes_rooms->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="name_ar"
                                                               class="mr-sm-2">{{ trans('dashboard/classroom.name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                               value="{{ $classes_rooms->getTranslation('name', 'en') }}"
                                                               name="name_en" required>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('dashboard/classroom.edit_grade') }}
                                                        :</label>
                                                    <select class="form-control form-control-lg"
                                                            id="exampleFormControlSelect1" name="grade_id">
                                                        <option value="{{ $classes_rooms->grades->id }}">
                                                            {{ $classes_rooms->grades->name }}
                                                        </option>
                                                        @foreach ($grades as $grade)
                                                        @if($grade->name !== $classes_rooms->grades->name)
                                                            <option value="{{ $grade->id }}">
                                                                {{ $grade->name }}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('dashboard/classroom.close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('dashboard/classroom.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $classes_rooms->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('dashboard/classroom.delete_form') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('classes-rooms.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('dashboard/classroom.confirm_delete') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $classes_rooms->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('dashboard/classroom.close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('dashboard/classroom.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/classroom.classes_room_add') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('classes-rooms.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('dashboard/classroom.name_ar') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_ar"  />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('dashboard/classroom.name_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="name_en"  />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('dashboard/classroom.grade_name') }}
                                                :</label>

                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    @foreach ($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('dashboard/classroom.operations') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('dashboard/classroom.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('dashboard/classroom.add_row') }}"/>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('dashboard/classroom.close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('dashboard/classroom.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>

</div>


<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('dashboard/classroom.delete_all_classes') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!--رســـاله تحـــذير-->

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('dashboard/classroom.warning_grades') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('dashboard/classroom.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('dashboard/classroom.submit') }}</button>
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
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>

<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>

@endsection