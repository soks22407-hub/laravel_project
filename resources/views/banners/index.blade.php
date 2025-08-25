@extends('layouts.app')
@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Banners</h4>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('banner.create') }}">
                                <i class="fa-solid fa-plus me-1"></i>Add Banner
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_1">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td class="text-end">
                                                <a href="{{ route('banner.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <!-- The delete button form has been updated to remove the 'confirm' dialog. -->
                                                <form action="{{ route('banner.delete', $row->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection