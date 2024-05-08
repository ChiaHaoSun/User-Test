@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        新增專案
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">
                                    {{ trans('project.name') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control
                                        @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="off" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        送出
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
