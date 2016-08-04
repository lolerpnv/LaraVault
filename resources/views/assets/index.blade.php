@extends('layouts.app')

@section('content')
    <!-- Create Asset Form... -->

    <!-- Current Assets -->
    @if (count($assets) > 0)
        <div class="panel panel-default" style="padding-left: 20%;padding-right: 20%">
            <div class="panel-heading">
                Current Assets
            </div>

            <div class="table-responsive" >
                <table class="table">

                    <!-- Table Headings -->
                    <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Size</th>
                        <th>Private</th>
                        <th>Downloads</th>
                        <th>Link</th>
                        <th>-</th>
                    </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($assets as $asset)
                        <tr>
                            <!-- Asset Name -->
                            <td class="table-text">
                                <div>{{ $asset->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $asset->size }} bytes</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $asset->private }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{$asset->downloads}}</div>
                            </td>
                            <td class="table-text">
                                <div><a href="{{ 'file/'.$asset->reference }}">Click</a> </div>
                            </td>
                            <td>
                                <form action="{{ url('file/'.$asset->reference) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection