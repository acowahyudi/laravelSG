@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Jenis Parameter
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($jenisParameter, ['route' => ['jenisParameters.update', $jenisParameter->id], 'method' => 'patch']) !!}

                        @include('jenis_parameters.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection