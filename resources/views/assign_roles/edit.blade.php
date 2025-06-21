@extends('base')

@section('title', 'Edit Employee & Role')

@section('content')
<div class="max-w-md mx-auto mt-12 border border-gray-400 p-6 rounded-2xl bg-white shadow">
  <h2 class="text-xl font-bold mb-6 text-center">
    Edit {{ $employee->firstname }} {{ $employee->lastname }}
  </h2>
  <form action="{{ route('assign_roles.update', $employee->id) }}" method="POST" class="flex flex-col gap-6">
    @csrf
    @method('PUT')

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
          value="{{ old($field, $employee->$field) }}"
          type="{{ $field === 'contactNum' ? 'tel' : ($field === 'bdate' ? 'date' : 'text') }}"
          class="w-full px-3 py-2 rounded-md border {{ $errors->has($field) ? 'border-red-500' : 'border-gray-400' }} focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error($field)
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
    @endforeach

    <div>
      <label for="gender_id" class="block mb-1 text-sm font-medium">Gender</label>
      <select id="gender_id" name="gender_id"
              class="w-full px-3 py-2 rounded-md border {{ $errors->has('gender_id') ? 'border-red-500' : 'border-gray-400' }} focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="" disabled>Select gender</option>
        @foreach($genders as $gender)
          <option value="{{ $gender->id }}" {{ old('gender_id', $employee->gender_id) == $gender->id ? 'selected' : '' }}>
            {{ $gender->name }}
          </option>
        @endforeach
      </select>
      @error('gender_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="role" class="block mb-1 text-sm font-medium">Role</label>
      <select name="role" id="role"
              class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('role') ? 'border-red-500' : 'border-gray-400' }}">
        @foreach($roles as $role)
          <option value="{{ $role->id }}" {{ $employee->roles->contains($role->id) ? 'selected' : '' }}>
            {{ ucfirst($role->name) }}
          </option>
        @endforeach
      </select>
      @error('role')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white py-2 rounded-md transition font-semibold">
      Update
    </button>
  </form>
</div>
@endsection
