@extends('template.main')

@section('container')
@parent
  <center><h3>Bienvenido {{ Auth::user()->nombre_completo(); }}</h3><br></center>
@stop