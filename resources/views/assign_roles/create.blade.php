@extends('base')

@section('title', 'Add Employee & Assign Role')

@section('content')
<div class="max-w-md mx-auto mt-12 border border-gray-400 p-6 rounded-2xl bg-white shadow">
  <h2 class="text-xl font-bold mb-6 text-center">New Employee</h2>
  <form action="{{ route('assign_roles.store') }}" method="POST" class="flex flex-col gap-6">
    @csrf

    @php
      $fieldLabels = [
        'firstname' => 'First name',
        'middlename' => 'Middle name',
        'lastname' => 'Last name',
        'contactNum' => 'Phone number',
        'bdate' => 'Birth date',
      ];
    @endphp

    @foreach($fieldLabels as $field => $label)
      <div>
        <label for="{{ $field }}" class="block mb-1 text-sm font-medium">{{ $label }}</label>
        <input
          id="{{ $field }}"
          name="{{ $field }}"
          value="{{ old($field) }}"
          type="{{ $field === 'contactNum' ? 'tel' : ($field === 'bdate' ? 'date' : 'text') }}"
          class="w-full px-3 py-2 rounded-md border {{ $errors->has($field) ? 'border-red-500' : 'border-gray-400' }} focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error($field)
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
    @endforeach

    {{-- Gender --}}
    <div>
      <label for="gender_id" class="block mb-1 text-sm font-medium">Gender</label>
      <select name="gender_id" id="gender_id"
              class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('gender_id') ? 'border-red-500' : 'border-gray-400' }}">
        <option value="" disabled {{ old('gender_id') ? '' : 'selected' }}>Select gender</option>
        @foreach($genders as $gender)
          <option value="{{ $gender->id }}" {{ old('gender_id') == $gender->id ? 'selected' : '' }}>
            {{ $gender->gender }}
          </option>
        @endforeach
      </select>
      @error('gender_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Role --}}
    <div>
      <label for="role" class="block mb-1 text-sm font-medium">Role</label>
      <select name="role" id="role"
              class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('role') ? 'border-red-500' : 'border-gray-400' }}">
        <option value="" disabled selected>Select a role</option>
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
            {{ ucfirst($role->name) }}
          </option>
        @endforeach
      </select>
      @error('role')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md transition font-semibold">
      Create & Assign
    </button>
  </form>
</div>
@endsection
