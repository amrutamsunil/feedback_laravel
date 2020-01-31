@extends('layouts.admin_nav')
@section('content')

    <div class="jumbotron">
        <form method="POST" action="{{action('HodController@scheduler')}}">
            @csrf
            {{method_field('POST')}}
            <div class="row row d-flex p-3 bg-secondary">
                <div style="text-align: center;padding-top: 4px;padding-left:22px;font-size:16px" class="col-md-2">
                    <label for="selcls" style="font-family: 'Arial';font-size: 18px" >SELECT CLASS</label></div>
                <div class="col-md-6">
                    <select class="form-control mdb-select md-form chosen" id="selcls" name="class_id" required>
                        @foreach($classes as $class)
                            @if(Session('prev_class_id')==$class->id)
                                <option  value="{{$class->id}}" selected>
                                    {{$class->name}}
                                </option>
                            @else
                            <option  value="{{$class->id}}">
                                {{$class->name}}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-md" id="Refresh">SHOW</button>

                </div>
            </div>

        </form></div>
<div class="float-right">
    <button type="button" class="btn btn-success btn-md"
                data-toggle="modal" data-target="#AddModal">ADD NEW</button>

</div>
    <div id ="studenttable" class="col-lg-12 col-md-6 ">
        <table class='table table-responsive table-bordered table-striped table-hover' style='margin:15px;'>
            <tr class='primary' >
                <th class='text-capitalize text-dark info'>S.NO </th>
                <th class='text-capitalize text-dark info'>CLASS NAME</th>
                <th class='text-capitalize text-dark info'>SUBJECT NAME</th>
                <th class='text-capitalize text-dark info' >FACULTY NAME</th>
                <th class='text-capitalize text-dark info' >EDIT</th>
                <th class='text-capitalize text-dark info' >DELETE</th>

            </tr>
            @if((@$time_table)!=NULL)
                @foreach($time_table->subjects as $index=>$t)
                    <tr>
                        <td>{{($index+1)}}</td>
                        <td>{{$time_table->name}}</td>
                        <td>{{$t->name}}</td>
                        <td>{{$t->faculty->name}}</td>
                        <td><button type="button" class="btn btn-primary btn-md"
                                    data-toggle="modal" data-target="#EditModal{{$index}}">Edit</button></td>

                        <td><button type="button" class="btn btn-danger btn-md"
                                    data-toggle="modal" data-target="#DeleteModal{{$index}}">Delete</button></td>

                        <div class="modal fade" id="EditModal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="POST" action="{{action('HodController@edit_subject_alloc')}}" >
                                        @csrf
                                        {{method_field('POST')}}
                                        <input type="hidden" value="{{$t->pivot->id}}" name="subj_alloc_id">
                                        <div class="modal-body">
                                            <label>Faculty Name</label>
                                            <select class="chosen form-control" style="width: 100%" name="faculty_name" required>
                                                <option value="{{$t->faculty->id}}" selected>{{$t->faculty->name}}</option>
                                                @foreach($faculties as $faculty)

                                                    <option  value="{{$faculty->id}}">
                                                        {{$faculty->name}}
                                                    </option>

                                                @endforeach
                                            </select>
                                            <br/><br/>
                                            <label>Subject Name</label>
                                            <br/><br/>
                                            <select class="chosen form-control" style="width: 100%" name="subject_name" required>
                                                <option value="{{$t->id}}" selected>{{$t->name}}</option>
                                                @foreach($subjects as $subject)

                                                    <option  value="{{$subject->id}}">
                                                        {{$subject->name}}
                                                    </option>

                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id="submit_edit" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>



                        <div class="modal fade red" id="DeleteModal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form method="POST" action="{{action('HodController@delete_subject_alloc')}}" >
                                        @csrf
                                        {{method_field('POST')}}
                                        <input type="hidden" value="{{$t->pivot->id}}" name="subj_alloc_id">
                                        <div class="modal-body">
                                            <p>Are You Sure , You Want to Delete <br/> Subject : {{$t->name}}</p>
                                            <br/>
                                            <p>Faculty: {{$t->faculty->name}}</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id="submit_del" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                @endif


        </table>
    </div>
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="POST" action="{{action('HodController@add_subject_alloc')}}" >
                    @csrf
                    {{method_field('POST')}}
                    <div class="modal-body">
                        <input type="hidden" value="{{Session::get('prev_class_id')}}" name="selected_class_id">
                        <div class="form-group">
                        <label for="subject_id">SUBJECT NAME : </label>
                        <select class="chosen form-control" style="width: 100%" name="subject_id" required>
                            <option value="" selected></option>
                            @foreach($subjects as $subject)

                                    <option  value="{{$subject->id}}">
                                        {{$subject->name}}
                                    </option>

                            @endforeach
                        </select>
                        </div>
                            <br/>
                        <div class="form-group">
                            <label for="faculty_id">FACULTY NAME : </label>
                        <select class="chosen form-control" style="width: 100%" name="faculty_id" required>
                            <option value="" selected></option>
                            @foreach($faculties as $faculty)

                                <option  value="{{$faculty->id}}">
                                    {{$faculty->name}}
                                </option>

                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="submit_del" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".chosen").select2();

        </script>

@endsection
