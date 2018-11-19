<li class="{{ Request::is('jenisParameters*') ? 'active' : '' }}">
    <a href="{!! route('jenisParameters.index') !!}"><i class="fa fa-edit"></i><span>Jenis Parameters</span></a>
</li>

<li class="{{ Request::is('tanamen*') ? 'active' : '' }}">
    <a href="{!! route('tanamen.index') !!}"><i class="fa fa-edit"></i><span>Tanamen</span></a>
</li>

<li class="{{ Request::is('tindakans*') ? 'active' : '' }}">
    <a href="{!! route('tindakans.index') !!}"><i class="fa fa-edit"></i><span>Tindakans</span></a>
</li>

<li class="{{ Request::is('units*') ? 'active' : '' }}">
    <a href="{!! route('units.index') !!}"><i class="fa fa-edit"></i><span>Units</span></a>
</li>

