{{--    
    <a href="#" data-val='{{$id}}' class='btn-show-mdl-customer-modal'>
        {!! Form::button('<i class="fa fa-eye"></i>', ['type'=>'button']) !!}
    </a>
    
    <a href="#" data-val='{{$id}}' class='btn-edit-mdl-customer-modal'>
        {!! Form::button('<i class="fa fa-edit"></i>', ['type'=>'button']) !!}
    </a>
    
    <a href="#" data-val='{{$id}}' class='btn-delete-mdl-customer-modal'>
        {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'button']) !!}
    </a>
--}}
<div class='btn-group' role="group">
    {{-- <a data-toggle="tooltip" 
        title="View" 
       
        class="btn  btn-sm btn-primary text-white" href="{{route('users.show',$id)}}">
        <i class="fa fa-eye" style="opacity:80%"></i> View
    </a> --}}

    <a data-toggle="tooltip" 
        title="Edit" 
        data-val='{{$id}}' 
        class="btn-edit-mdl-user-modal btn btn-sm btn-warning" href="#">
        <i class="bx bx-edit " style="opacity:80%"></i>
        Edit
    </a>

    <a data-toggle="tooltip" 
        title="Delete" 
        data-val='{{$id}}' 
        class="btn-delete-mdl-user-modal btn btn-sm btn-danger text-white" href="#">
        <i class="bx bx-trash" style="opacity:80%"></i> Delete
    </a>
</div>