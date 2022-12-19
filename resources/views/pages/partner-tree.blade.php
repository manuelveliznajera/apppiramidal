@extends('../layout/' . $layout)

@section('subcontent')

<div >

    <div data-tree="{{$user}}" id="tree"></div>
  
</div>

<script src="{{asset('js/balkan/orgChart.js')}}" ></script>

@endsection
