@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            
                <h1>La liste de mes cv</h1>
                <div class="float-right">
                    <a href="{{ url('cvs/create') }}" class="btn btn-info">Nouveau cv</a>
                </div>
                <br>
                <br>
                <div class="row">
                @foreach($cvs as $cv)
                    <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('storage/'.$cv->photo) }}" alt="" class="img-thumbnail w-100 p-3">
                        <div class="caption">
                        <h3>{{ $cv->titre }}</h3>
                        <p>
                            
                            <form action="{{ url('cvs/'.$cv->id) }}" method="post">
                            <a href="{{ url('cvs/'.$cv->id) }}" class="btn btn-primary" role="button">Afficher</a>
                            <a href="{{ url('cvs/'.$cv->id.'/edit') }}" class="btn btn-success" role="button">Modifier</a>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger" >Supprimer</button>
                            </form>                          
                         </p>
                        </div>
                    </div>
                    </div>
                    @endforeach
                    </div>
               </div>
        </div>
    </div>
@endsection