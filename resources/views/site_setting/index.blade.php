@extends('layouts.app')

@section('content')
    <div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Site Setting</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <form class="row g-2">
                                <div class="col-auto">
                                    <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false" data-bs-auto-close="outside">
                                        <i class="iconoir-filter-alt me-1"></i> Filter
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-start">
                                        <div class="p-2">
                                            <!-- Keep or adjust filters if needed -->
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" checked id="filter-all">
                                                <label class="form-check-label" for="filter-all">
                                                    All
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->

                                <div class="col-auto">
                                    <a class="btn btn-primary" href="{{ route('site_setting.create') }}">
                                        <i class="fa-solid fa-plus me-1"></i>Add Site Setting
                                    </a>
                                </div><!--end col-->
                            </form>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-header-->

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all" id="datatable_1">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th class="ps-0">Title</th>
                                    <th>Description</th>
                                    <th>Content</th>
                                    <th>Facebook</th>
                                    <th>Telegram</th>
                                    <th>Youtube</th>
                                    <th>Logo</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($rows)
                                    @php($i=1)
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>{{ $row->content }}</td>
                                            <td>{{ $row->facebook }}</td>
                                            <td>{{ $row->telegram }}</td>
                                            <td>{{ $row->youtube }}</td>
                                            <td>
                                                @if($row->logo)
                                                    <img src="{{ asset('uploads/logos/thumb_' . $row->logo) }}" alt="Logo" style="height:40px;">
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('site_setting.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <form action="{{ route('site_setting.delete', $row->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div><!--end card-body-->
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div><!-- container -->
@endsection