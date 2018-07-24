@extends('layouts.app')

@section('content')

    {{--<div class="row">--}}
        {{--<form method="post" action="/add-post" enctype="multipart/form-data">--}}
            {{--{{ csrf_field() }}--}}

            {{--<div class="form-group">--}}
                {{--<label for="title">Назва</label>--}}
                {{--<input class="form-control" type="text" name="title" id="title" value="" required>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<label for="img">Лого</label>--}}
                {{--<input type="file" id="img" name="img" class="form-control" required>--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--<button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>--}}
            {{--</div>--}}
        {{--</form>--}}
    {{--</div>--}}

    <div class="content">

        <div class="table-responsive">
            <table class="table">
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
                        <td>
                            Link to lead
                        </td>
                        <td>
                            Niche
                        </td>
                        <td>
                            Current site
                        </td>
                        <td>
                            Description
                        </td>
                        <td>
                            Timing
                        </td>
                        <td>
                            Budget $
                        </td>
                        <td>
                            Responce
                        </td>
                        <td>
                            Status
                        </td>
                        <td>
                            Comments
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($array as $index => $row)
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
                                <td>
                                    @if(isset($row[3]))
                                        {{ $row[3] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[4]))
                                        {{ $row[4] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[5]))
                                        {{ $row[5] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[6]))
                                        {{ $row[6] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[7]))
                                        {{ $row[7] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[8]))
                                        {{ $row[8] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[9]))
                                        {{ $row[9] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[10]))
                                        {{ $row[10] }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($row[11]))
                                        {{ $row[11] }}
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