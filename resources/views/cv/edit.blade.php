@extends('layouts.app')

@section('content')
<div>
@if(count($errors))
<div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all()  as $message)
        <li>{{ $message }}</li>
        @endforeach
        </ul>
@endif
</div>

    <div class="container">
    <a href="{{ url('cvs') }}" class="btn btn-primary" role="button">Retour</a>
        <hr>
            <form action="{{ url('cvs/'.$cv->id) }}" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Titre</label>
                    <input value="{{ $cv->titre }}" type="text" name="titre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Presentation</label>
                <textarea name="presentation"class="form-control" >{{ $cv->presentation }}</textarea>
                </div>
                <div class="form-group">
                <label for="">Image</label>
                <input class="form-control" type="file" name="photo" >
                </div>
                <div class="form-group">
                    <input value="Modifier" type="submit"  class="form-control btn btn-danger">
                </div>
            </form>
    </div>
@endsection