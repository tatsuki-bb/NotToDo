



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
@extends('layouts.app')

                                <a id="navbarDropdown"  href="{{  route('posts,index')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}のリスト
                                </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
