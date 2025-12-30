@php $start = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp
@foreach($users as $index => $user)
    <tr class="border-b border-secondary">
        <td class="px-4 py-3 text-sm">{{ $start + $index }}</td>
        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
        <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
        <td class="px-4 py-3 text-sm capitalize">{{ $user->role }}</td>
        <td class="px-4 py-3 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
        <td class="px-4 py-3 text-sm text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="text-primary hover:underline text-sm">Edit</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach

@if($users->isEmpty())
    <tr>
        <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">No users found.</td>
    </tr>
@endif
