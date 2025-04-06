{{--    
    <a href="#" data-val='{{$id}}' class='btn-show-mdl-claiamableItem-modal'>
        {!! Form::button('<i class="fa fa-eye"></i>', ['type'=>'button']) !!}
    </a>
    
    <a href="#" data-val='{{$id}}' class='btn-edit-mdl-claiamableItem-modal'>
        {!! Form::button('<i class="fa fa-edit"></i>', ['type'=>'button']) !!}
    </a>
    
    <a href="#" data-val='{{$id}}' class='btn-delete-mdl-claiamableItem-modal'>
        {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'button']) !!}
    </a>
--}}
<div class='btn-group' role="group">
    <a data-toggle="tooltip" 
        title="View" 
        data-val='{{$id}}' 
        class="" href="{{route('icdl_modules.show', $id)}}">
        <i class="fa fa-eye text-primary" style="opacity:80%"></i>
    </a>

    <a data-toggle="tooltip" 
        title="Edit" 
        data-val='{{$id}}' 
        class="btn-edit-mdl-icdlModule-modal" href="#">
        <i class="bx bx-edit text-primary" style="opacity:80%"></i>
    </a>
    <a data-toggle="tooltip" 
        title="Delete" 
        data-val='{{$id}}' 
        class="btn-delete-mdl-icdlModule-modal" href="#">
        <i class="bx bx-trash text-danger" style="opacity:80%"></i>
    </a>
</div>