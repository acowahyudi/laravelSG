@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tanaman
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tanaman, ['route' => ['tanamen.update', $tanaman->id], 'method' => 'patch']) !!}

                        @include('tanamen.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection