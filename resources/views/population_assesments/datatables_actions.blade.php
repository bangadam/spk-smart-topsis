{{-- {!! Form::open(['route' => ['criterias.destroy', $id], 'method' => 'delete']) !!} --}}
<div class='btn-group'>
    <a href="{{ route('populationAssesments.show', $id) }}" class='btn btn-primary btn-xs'>
        detail
    </a>
    {{-- {!! Form::button('<i class="fa fa-trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-danger btn-xs',
    'onclick' => "return confirm('Are you sure?')"
    ]) !!} --}}
</div>
{{-- {!! Form::close() !!} --}}
