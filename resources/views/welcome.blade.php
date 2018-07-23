@extends('layouts.app')

@section('content')

    <div class="content">

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <td>
                            Date
                        </td>
                        <td>
                            Agent
                        </td>
                        <td>
                            Source
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $index => $row)
                        @if($index != 0)
                            <tr>
                                <td>
                                    @if(isset($row[0]))
                                        {{ $row[0] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[1]))
                                        {{ $row[1] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[2]))
                                        {{ $row[2] }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection