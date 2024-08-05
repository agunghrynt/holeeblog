@extends('user-dashboard.layouts.main')

@section('container')
    
  <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center py-2 my-3">
    <h1 class="h3">Account Settings</h1>
  </div>

  @livewire('account-settings')

@endsection