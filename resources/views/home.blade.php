@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Here City Managers View ====> index</h1>
                    <h2>Now the working links are : Training packages and Gyms on Left Side </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
