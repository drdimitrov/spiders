@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>{{ $lName }} - list of species</h1>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Species</th>
            <th>Records and material</th>
          </tr>
        </thead>
        <tbody>
            @foreach($spLocs as $spK => $v)
              @foreach($v as $spec => $loc)
                  <tr>
                      <td>{{ $cnt }}</td>
                      <td><a href="/species/{{ $spK }}">{{ $spec }}</a></td>
                      <td>
                        @foreach($loc as $l)
                          @if(isset($l['date'])) {{ $l['date'] }}, @endif
                          @if(isset($l['males'])) {{ $l['males'] }}  &#9794;, @endif
                          @if(isset($l['females'])) {{ $l['females'] }}  &#9792;, @endif
                          @if(isset($l['juvenile_males'])) {{ $l['juvenile_males'] }} juv. &#9794;, @endif
                          @if(isset($l['juvenile_females'])) {{ $l['juvenile_females'] }} juv. &#9792;, @endif
                          @if(isset($l['collected_by'])) {{ $l['collected_by'] }} leg., @endif
                          (<a href="/literature/{{$l['paper_slug']}}">{{ $l['paper'] }}</a>)<br>
                        @endforeach
                      </td>
                  </tr>
                  @php($cnt++)
              @endforeach          
            @endforeach          
        </tbody>
      </table>
</div>
@endsection
