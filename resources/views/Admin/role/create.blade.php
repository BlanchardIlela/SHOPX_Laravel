@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Roles</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Create Role</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.role.store') }}" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required" for="">Role Name</label>
                                <input type="text" class="form-control" name="role" id=""
                                    value="">
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($permissions as $groupName => $permission)
                            <div class="col-md-4 mb-3">
                                <h3>{{ $groupName }}</h3>
                                @foreach ($permission as $item)
                                    <label for="" class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="" value="{{ $item->name }}">
                                        <span class="form-check-label">{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary mt-3" onclick="$('form').submit()">Create</button>
            </div>
        </div>
    </div>
@endsection
