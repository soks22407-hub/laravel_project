@extends('layouts.app')

@section('content')
    <div class="container-xxl">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Posts</h4>
                            </div><!-- end col -->
                            <div class="col-auto">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <!-- Note: The filter dropdown is non-functional as it is not tied to any backend logic. -->
                                        <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                            aria-expanded="false" data-bs-auto-close="outside">
                                            <i class="iconoir-filter-alt me-1"></i> Filter
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <div class="p-2">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-all">
                                                    <label class="form-check-label" for="filter-all">All</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-one">
                                                    <label class="form-check-label" for="filter-one">New</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-two">
                                                    <label class="form-check-label" for="filter-two">VIP</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-three">
                                                    <label class="form-check-label" for="filter-three">Repeat</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-four">
                                                    <label class="form-check-label" for="filter-four">Referral</label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-five">
                                                    <label class="form-check-label" for="filter-five">Inactive</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-six">
                                                    <label class="form-check-label" for="filter-six">Loyal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col -->

                                    <div class="col-auto">
                                        <a class="btn btn-primary" href="{{ route('post.create') }}">
                                            <i class="fa-solid fa-plus me-1"></i>Add Post
                                        </a>
                                    </div><!-- end col -->
                                </form>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card-header -->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th class="ps-0">Title</th>
                                        <th>Sub_Title</th>
                                        <th>Description</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Active</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rows as $index => $row)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>{{ $row->sub_title }}</td>
                                            <td>{{ $row->description }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($row->content, 50, '...') }}</td>
                                            <td>
                                                @if ($row->image)
                                                    <img src="{{ asset('uploads/images/' . $row->image) }}" alt="Post Image" style="max-width: 50px; height: auto;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $row->active ? 'bg-success' : 'bg-danger' }}" title="{{ $row->active ? 'Active' : 'Inactive' }}">
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('post.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <!-- The delete button form has been updated to remove the 'confirm' dialog. -->
                                                <form action="{{ route('post.delete', $row->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                                                        <i class="las la-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
@endsection
