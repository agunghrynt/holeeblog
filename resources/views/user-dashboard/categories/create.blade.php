@extends('user-dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-2 border-bottom">
        <h1 class="h3">Create Category</h1>
    </div>

    <div class="col-lg-8">

        <form action="/user-dashboard/categories" method="POST">
            @csrf

            <livewire:slug-generator :makeData="$makeData"/>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
              <button type="submit" class="btn btn-primary">Create Category</button>
            </div>

        </form>

    </div>

    {{-- Auto generate slug --}}
    <script src="/js/mycategoryutils.js">
    </script>

@endsection
