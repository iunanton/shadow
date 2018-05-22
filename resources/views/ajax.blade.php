@extends('layouts.app')

@section('content')
<div class="container">
    <h1>AJAX</h1>
    <button class="btn btn-warning" v-on:click="myFunc">Vanilla JS method</button>
    <button class="btn btn-success" v-on:click="getUser">Vue method</button>
</div>
@endsection
