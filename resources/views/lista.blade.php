@foreach($data as $country)
    Sigla: {{ $country['sigla'] }} <br>
    Pais: {{ $country['pais'] }}<br>
    Full: {{ $country['full'] }}<br><br>
@endforeach