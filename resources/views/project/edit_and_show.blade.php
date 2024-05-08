@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ ($view == 'edit') ? '編輯' : '檢視' }}專案
                    </div>

                    <div class="card-body">
                        <div class="mb-1">
                            <a href="{{ route('project.index') }}" class="btn btn-dark">
                                回專案列表
                            </a>
                        </div>

                        <form method="POST" action="{{ ($view == 'edit') ? route('project.update', $id)  : '' }}">
                            @if ($view == 'edit')
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                            @endif

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">
                                    {{ trans('project.name') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control
                                        @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $data->name) }}" autocomplete="off" autofocus
                                        {{ ($view == 'show') ? 'disabled' : '' }} >

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if ($view == 'edit')
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            送出
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
