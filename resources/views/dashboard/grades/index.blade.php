@extends('layouts.master')
@section('css')
@toastr_css


@section('title')
    {{__('dashboard/navbar.grades')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{__('dashboard/navbar.grades')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
 <!-- main body --> 
 <div class="row">   
 @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif
      <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
          <div class="card-body">
          <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ __('dashboard/grade.add_grade') }}
            </button>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>{{__('dashboard/grade.name_grade')}}</th>
                      <th>{{__('dashboard/grade.notes_grade')}}</th>
                      <th>{{__('dashboard/grade.operations_grade')}}</th>
                     
                  </tr>
              </thead>
              <tbody>
              @foreach($grades as $index=>$grade)
                  <tr>
                      <td>{{$index +=1 }}</td>
                      <td> {{$grade->name}}</td>
                      <td>{!!$grade->notes == null ?'<span class="text-danger">لا توجد ملاحظات</span>' : $grade->notes !!}</td>
                      <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                    data-target="#edit{{ $grade->id }}"
                    title="{{ trans('dashboard/grade.edit_grade') }}"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#delete{{ $grade->id }}"
                    title="{{ trans('dashboard/grade.delete_grade') }}"><i
                    class="fa fa-trash"></i></button>
                      </td>
                </tr>
                <!-- edit_modal_Grade -->
                <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('dashboard/grade.edit_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{route('grades.update',$grade->id)}}" method="post">
                                                    {{method_field('patch')}}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name"
                                                                   class="mr-sm-2">{{ trans('dashboard/grade.grade_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                   class="form-control"
                                                                   value="{{$grade->getTranslation('name', 'ar')}}"
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $grade->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('dashboard/grade.grade_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$grade->getTranslation('name', 'en')}}"
                                                                   name="name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('dashboard/grade.grade_notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3">{{ $grade->notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('dashboard/grade.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('dashboard/grade.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                
                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('dashboard/grade.delete_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('grades.destroy',$grade->id)}}" method="post">
                                                    {{method_field('Delete')}}
                                                    @csrf
                                                    {{ trans('dashboard/grade.warning_grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $grade->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('dashboard/grade.close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('dashboard/grade.submit') }}</button>
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
      
<!-- add_modal_Grade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/grade.add_grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('dashboard/grade.grade_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="name_ar" class="form-control">
                            @error('name_ar')
                                <li class="btn btn-danger">{{$message}}</li>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('dashboard/grade.grade_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="name_en">
                            @error('name_en')
                                <li class="btn btn-danger">{{$message}}</li>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('dashboard/grade.grade_notes') }}
                            :</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('dashboard/grade.close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('dashboard/grade.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>

  </div> 
<!-- row closed -->
@endsection
@section('js')

@toastr_js
@toastr_render
@endsection