<table class="table table-responsive" id="tanamen-table">
    <thead>
        <tr>
            <th>Nama</th>
        <th>Gambar</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tanamen as $tanaman)
        <tr>
            <td>{!! $tanaman->nama !!}</td>
            <td>{!! $tanaman->gambar !!}</td>
            <td>
                {!! Form::open(['route' => ['tanamen.destroy', $tanaman->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tanamen.show', [$tanaman->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tanamen.edit', [$tanaman->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>