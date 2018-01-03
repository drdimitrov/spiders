@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 style="display: inline;">
                Species included in the paper
            </h1>

            <a href="{{ route('literature') }}" class="btn btn-custom pull-right" >All papers</a>
            <a href="{{ route('literature.single', $paper->slug) }}" class="btn btn-custom pull-right" style="margin-right: 10px;">Back to paper</a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <p>
                @if(count($paper->authors) > 1)
                    {{$paper->authors->first()->last_name}} et al.
                @else
                    {{$paper->authors->first()->last_name}}
                @endif
                {{ $paper->published_at->format('Y') }}, {{ $paper->name }}
                </p>

                @php($cnt = 1)

                <table class="table table-bordered">
                    <tr style="font-weight: bold">
                        <td>
                            Nr.
                        </td>
                        <td>
                            Species
                        </td>
                        <td>
                            Details
                        </td>
                    </tr>
                    @foreach($paper->taxa as $species)
                    <tr>
                        <td>{{ $cnt }}</td>
                        <td>{{$species->genus->name}} {{$species->name}}</td>
                        <td><a href="/species/{{$species->id}}">Show</a></td>
                    </tr>
                    @php($cnt += 1)
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection