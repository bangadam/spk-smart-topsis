{!! Form::open(['route' => ['populations.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{-- <a href="{{ route('populations.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a> --}}
    <a href="{{ route('populations.duplicate', $id) }}" class='btn btn-primary btn-xs'>
        <i class="fa fa-copy"></i>
    </a>
    <a href="{{ route('populations.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <a href="{{ route('populationAssesments.index', [" population_id"=> $id]) }}" class='btn btn-default btn-xs'>
        riwayat
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-danger btn-xs',
    'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
