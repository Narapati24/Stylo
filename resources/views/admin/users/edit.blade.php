@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<x-admin.layout-crud title="Edit User" :back-url="route('admin.users.index')">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-xs uppercase text-gray-500">Name</p>
                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-xs uppercase text-gray-500">Email</p>
                <p class="text-sm font-medium text-gray-900">{{ $user->email }}</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="mt-1 w-full rounded-lg border-secondary bg-bone px-4 py-2 focus:border-primary focus:ring-0">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2 rounded-lg bg-primary text-white">Update</button>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 rounded-lg border border-secondary text-gray-700">Cancel</a>
        </div>
    </form>
</x-admin.layout-crud>
@endsection
