@extends('../layout/' . $layout)

@section('subcontent')

<div >
 

    <div data-tree="{{$user}}" id="tree" class="partner_tree"></div>
  
</div>

<script src="{{asset('js/balkan/orgChart.js')}}" ></script>

@endsection
