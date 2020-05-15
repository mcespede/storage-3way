@push('styles')
    <link href="{{ asset('css/topNavBarView.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/topNavBarView.js') }}"></script>
@endpush

<div class="topnav" id="myTopnav">

  <!-- Como aqui utilizo el AS entonces si puedo llamar el nombre de la ruta-->
  <a href="{{route('home')}}" class=" tab active"><span class="glyphicon glyphicon-home"></a>
  <!-- Aqui utilizo URL porque como no tengo metodo, no le he puesto un ALIAS (as)
       y el route solo funciona con el nombre que le asigno-->
  <a href="{{url('desarrolloWeb')}}" class="tab"> Desarrollo web </a>
  <a href="{{url('sistemas')}}" class="tab"> Sistemas </a>
  <a href="{{url('robotica')}}" class="tab"> Robótica </a>
  <a href="{{url('videos')}}" class="tab"> Videos </a>
  <a href="{{url('documentos')}}" class="tab"> Documentos </a>
  <a href="{{url('sobre-mi')}}" class="tab"> Sobre mí</a>

  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>

</div><hr>
