@extends('layouts.main')

@section('content')
@php($cnt = 1)
<div class="container">
     <div class="page-header">
        <h1>
        {{ $lName }} - list of species 
        <span style="font-size: 0.6em; color: #8c8c8c;">
        (total {{ count($spLocs) }})
        </span></h1>        
      </div>

      <a href="/statistics/species-by-locality" class="btn btn-custom pull-right">Back to localities</a>

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
                          @if(isset($l['males'])) {{ $l['males'] }}  &#9794;, @endif
                          @if(isset($l['females'])) {{ $l['females'] }}  &#9792;, @endif
                          @if(isset($l['juvenile_males'])) {{ $l['juvenile_males'] }} juv. &#9794;, @endif
                          @if(isset($l['juvenile_females'])) {{ $l['juvenile_females'] }} juv. &#9792;, @endif
                          @if(isset($l['date'])) {{ $l['date'] }}, @endif
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
      @if(Auth::check())
      <form action="/statistics/species-locality-export" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="locality" value="{{ $lId }}">
        <input type="submit" value="Export" class="btn btn-primary pull-right">
      </form>
      @endif 
</div>
@endsection
