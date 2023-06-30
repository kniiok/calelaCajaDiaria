@extends('layouts.app')
@section('content')
<head>
    <link href="css/animate.min.css" rel="stylesheet">
</head>
@livewire('audit-show', ['user' => $user])
@endsection