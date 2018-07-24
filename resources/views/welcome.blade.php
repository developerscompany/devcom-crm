@extends('layouts.app')

@section('content')
            <form id="line-form" method="post" action="/user/add-line" enctype="multipart/form-data" style="width: 100%;">
            {{ csrf_field() }}
            <div class="row">
            <div class="form-group col-md-1">
                <label for="title">Source</label>
                <select name="source" id="source" class="form-control" required>
                    @foreach($sourses as $source)
                        <option value="{{ $source->name }}"> {{ $source->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Link</label>
                <input type="text" id="link" name="link" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Niche</label>
                <input type="text" id="niche" name="niche" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Site</label>
                <input type="text" id="site" name="site" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Description</label>
                <input type="text" id="desc" name="desc" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Timing</label>
                <select name="timing" id="timing" class="form-control" required>
                    @foreach($timings as $timing)
                        <option value="{{ $timing->title }}"> {{ $timing->title }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Budget</label>
                <input type="text" id="budget" name="budget" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Responce</label>
                <input type="text" id="resp" name="resp" class="form-control" required>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Status</label>
                <select name="status" id="status" class="form-control" required>
                    @foreach($statuses as $status)
                        <option value="{{ $status->title }}"> {{ $status->title }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-1">
                <label for="img">Comments</label>
                <input type="text" id="comment" name="comment" class="form-control" required>
            </div>

            <div class="form-group col-md-1 align-self-end">
                <button id="btn-save" type="submit" class="btn btn-primary">Зберегти</button>
            </div>
            </div>
        </form>

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

@section('script')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection