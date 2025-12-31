<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $query = User::query();

    if ($request->filled('search')) {
      $search = $request->get('search');
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    if ($request->filled('role')) {
      $query->where('role', $request->get('role'));
    }

    $users = $query->latest()->paginate(10);

    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.users.partials.table-rows', compact('users'))->render(),
        'pagination' => $users->links()->toHtml(),
      ]);
    }

    return view('admin.users.index', compact('users'));
  }

  public function edit(User $user)
  {
    return view('admin.users.edit', compact('user'));
  }

  public function update(UpdateUserRequest $request, User $user)
  {
    $data = $request->validated();

    $user->update([
      'role' => $data['role'],
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
  }

  public function destroy(User $user)
  {
    if ($user->id === Auth::id()) {
      return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
  }
}
