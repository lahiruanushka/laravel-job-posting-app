@extends('layouts.app')

@push('styles')
    <style>
        .dashboard-card {
            background: white;
            border-radius: 1rem;
            box-shadow: var(--card-shadow);
            border: none;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 1.5rem;
        }

        .search-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        .search-input {
            background: white;
            border: none;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
        }

        .search-input:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
        }

        .search-btn {
            background: white;
            color: #6366f1;
            border: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .search-btn:hover {
            background: #e2e4ff;
            color: #4f46e5;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            transition: var(--transition);
            margin: 0 0.125rem;
        }

        .btn-create{
            background: #6366f1;
            color: white;
        }

        .btn-view {
            background: #6366f1;
            color: white;
            border: none;
            text-decoration: none
        }
        .btn-edit {
            background: #eab308;
            color: white;
            border: none;
            text-decoration: none
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-view:hover {
            background: #4f46e5;
        }

        .btn-edit:hover {
            background: #ca8a04;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .pagination {
            margin: 0;
            padding: 1rem 1rem;
        }

        .page-link {
            color: #6366f1;
            border: none;
            padding: 0.5rem 1rem;
            margin: 0 0.125rem;
            border-radius: 0.375rem;
        }

        .page-link:hover {
            background: #e2e4ff;
            color: #4f46e5;
        }

        .page-item.active .page-link {
            background: #6366f1;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #94a3b8;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <div class="dashboard-card">
            <div class="dashboard-header">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h3 class="m-0">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Manage Listings
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('listings.manage') }}" method="GET" class="search-container">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-input"
                                    placeholder="Search listings..." value="{{ request('search') }}">
                                <button type="submit" class="btn search-btn">
                                    <i class="fas fa-search me-2"></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('listings.create') }}" class="btn btn-primary btn-create"><i class="fas fa-plus"></i>
                            Create</a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($listings->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-list-slash"></i>
                        <h4>No Listings Found</h4>
                        <p class="text-muted">Try adjusting your search criteria</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    @if (auth()->user() && auth()->user()->isAdmin())
                                        <th>Posted By</th>
                                    @endif
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listings as $listing)
                                    <tr>
                                        <td class="align-middle"> {{ $listing->title }}
                                        </td>
                                        <td class="align-middle">{{ $listing->company }}</td>
                                        <td class="align-middle">{{ $listing->location }}</td>

                                        @if (auth()->user() && auth()->user()->isAdmin())
                                            <td>{{ $listing->user->name }}</td>
                                        @endif

                                        <td class="align-middle">{{ $listing->created_at->format('M d, Y') }}</td>
                                        <td class="align-middle">
                                            <a href="/listings/{{ $listing->id }}" class="action-btn btn-view"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/listings/{{ $listing->id }}/edit" class="action-btn btn-edit"
                                                title="Edit User">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <x-confirm-delete :action="'/listings/' . $listing->id"
                                                message="Are you sure you want to delete this listing?" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center border-top">
                        {{ $listings->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
