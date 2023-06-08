@extends('layouts.app')
@section('content')
  <navbar-component></navbar-component>
  <sidebar-component></sidebar-component>

  <div class="content-wrapper">

    <div class="content">
        <router-view></router-view>
    </div>

</div>
  <aside class="control-sidebar control-sidebar-dark"></aside>

@endsection
