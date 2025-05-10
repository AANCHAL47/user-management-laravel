@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-2">
            <h5 class="mb-0">Users</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.create') }}?role=admin" class="btn btn-secondary btn-sm">
                    + Add Admin
                </a>
                <a href="{{ route('admin.create') }}?role=user" class="btn btn-light btn-sm">
                    + Add User
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                        
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort_by' => 'name', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}"
                                    class="text-decoration-none text-dark">
                                    Name <i class="fa-solid fa-sort"></i>
                                </a>
                            </th>
                        
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort_by' => 'email', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}"
                                    class="text-decoration-none text-dark">
                                    Email <i class="fa-solid fa-sort"></i>
                                </a>
                            </th>
                        
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort_by' => 'role', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}"
                                    class="text-decoration-none text-dark">
                                    Role <i class="fa-solid fa-sort"></i>
                                </a>
                            </th>
                        
                            <th>
                                <a href="{{ route('admin.dashboard', ['sort_by' => 'created_at', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc']) }}"
                                    class="text-decoration-none text-dark">
                                    Created <i class="fa-solid fa-sort"></i>
                                </a>
                            </th>
                        
                            <th>Actions</th>
                        </tr>                                                 
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge @if($user->role == 'user') bg-primary @else bg-secondary @endif">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-sm btn-outline-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this ' + '{{ ucfirst($user->role) }}' + '?')" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- pagination -->
            <div class="d-flex justify-content-start ps-3 mt-3">
                {{ $users->appends(request()->query())->links() }}
            </div>
                       
        </div>
    </div>
</div>

@endsection