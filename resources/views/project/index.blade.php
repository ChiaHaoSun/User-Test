@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        專案列表
                    </div>

                    <div class="card-body">
                        <div class="mb-1">
                            <a href="{{ route('project.create') }}" class="btn btn-primary">
                                新增專案
                            </a>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 200px;">{{ trans('common.function') }}</th>
                                    <th>{{ trans('project.name') }}</th>
                                    <th>{{ trans('common.created_by') }}</th>
                                    <th>{{ trans('common.updated_by') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datalist as $val)
                                    <tr>
                                        <th>
                                            <a href="{{ route('project.edit', $val->id) }}" class="btn btn-warning">
                                                編輯
                                            </a>
                                            <a href="{{ route('project.show', $val->id) }}" class="btn btn-info">
                                                檢視
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="destoryProject(1)">
                                                刪除
                                            </button>
                                        </th>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->creator->name ?? null }}</td>
                                        <td>{{ $val->updater->name ?? null }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="project_form" method="post" action="">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
    </form>

    <script>
        //刪除
        function destoryProject(id) {
            var url = "{{ route('project.destroy', ':id') }}";

            url = url.replace(':id', id); //取代 id

            $("#project_form").attr("action", url);
            $("#project_form").submit();
        }
    </script>
@endsection
