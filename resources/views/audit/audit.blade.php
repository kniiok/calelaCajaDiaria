@extends('layouts.app')
@section('content')

@livewire('audit-show', ['user' => $user])
@endsection