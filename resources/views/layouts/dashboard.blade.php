@extends('base')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Page Layout -->
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-gray-900 text-white p-6 flex flex-col justify-between shadow-xl animate-fade-in">
            <div>
                <h2 class="text-2xl font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="filter" class="w-5 h-5"></i> Filter by Role
                </h2>
                <ul class="space-y-2 mb-6">
                    <li>
                        <button data-role="all"
                            class="filter-btn flex items-center gap-2 w-full text-left px-4 py-2 rounded-lg transition duration-300 hover:bg-gray-700 hover:translate-x-1">
                            <i data-lucide="users" class="w-4 h-4"></i> All
                        </button>
                    </li>
                    @foreach ($roles as $role)
                        <li>
                            <button data-role="{{ $role->name }}"
                                class="filter-btn flex items-center gap-2 w-full text-left px-4 py-2 rounded-lg transition duration-300 hover:bg-gray-700 hover:translate-x-1">
                                <i data-lucide="user-check" class="w-4 h-4"></i> {{ ucfirst($role->name) }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-auto">
                <form action="{{ route('auth.logout') }}" method="GET">
                    @csrf

                    <button type="submit"
                        class="group flex items-center justify-start w-11 h-11 bg-red-600 rounded-full cursor-pointer relative overflow-hidden transition-all duration-200 shadow-lg hover:w-32 hover:rounded-lg active:translate-x-1 active:translate-y-1">
                        <div
                            class="flex items-center justify-center w-full transition-all duration-300 group-hover:justify-start group-hover:px-3">
                            <svg class="w-4 h-4" viewBox="0 0 512 512" fill="white">
                                <path
                                    d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute right-5 transform translate-x-full opacity-0 text-white text-lg font-semibold transition-all duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                            Logout
                        </div>
                    </button>

                </form>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="w-3/4 p-8 animate-fade-in">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Employees</h1>

                <a href="{{ route('assign_roles.create') }}" <!-- From Uiverse.io by Itskrish01 -->
                    <button
                        class="relative flex items-center px-6 py-3 overflow-hidden font-medium transition-all bg-indigo-500 rounded-md group">
                        <span
                            class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-700 rounded group-hover:-mr-4 group-hover:-mt-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-700 rounded group-hover:-ml-4 group-hover:-mb-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-indigo-600 rounded-md group-hover:translate-x-0"></span>
                        <span
                            class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">New
                            employee</span>
                    </button>

                </a>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6" id="employee-list">
                @foreach ($employees as $emp)
                    <div class="employee-card bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:scale-[1.02]"
                        data-role="{{ $emp->roles->pluck('name')->implode(',') }}">
                        <h3 class="font-semibold text-xl text-gray-800">{{ $emp->firstname }} {{ $emp->lastname }}</h3>
                        <p class="text-gray-600 text-sm mt-1">Gender: {{ $emp->gender->gender ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">Contact: {{ $emp->contactNum }}</p>
                        <p class="text-gray-600 text-sm">Birthdate: {{ $emp->bdate }}</p>
                        <p class="text-gray-600 text-sm">Roles: <span
                                class="text-gray-800 font-medium">{{ $emp->roles->pluck('name')->join(', ') }}</span></p>

                        <div class="mt-5 flex gap-3">
                            <a href="{{ route('assign_roles.edit', $emp->id) }}" <button <button <button
                                class="relative inline-flex items-center justify-center w-[8em] h-[2.6em] text-[17px] font-medium rounded-md border-2 border-indigo-700 text-indigo-700 overflow-hidden z-[1] transition-colors duration-500 group">
                                <span class="z-[1] transition-colors duration-500 group-hover:text-white">
                                    Edit
                                </span>
                                <span
                                    class="absolute top-full left-full w-[200px] h-[150px] rounded-full bg-indigo-700 z-0 transition-all duration-700 group-hover:top-[-30px] group-hover:left-[-30px] group-active:bg-indigo-800"></span>
                                </button>
                            </a>

                            <form action="{{ route('assign_roles.destroy', $emp->id) }}" method="POST"
                                onsubmit="return confirm('Delete this employee?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="relative inline-flex items-center justify-center w-[8em] h-[2.6em] text-[17px] font-medium rounded-md border-2 border-red-600 text-red-600 overflow-hidden z-[1] transition-colors duration-500 group">
                                    <span class="z-[1] transition-colors duration-500 group-hover:text-white">
                                        Delete
                                    </span>
                                    <span
                                        class="absolute top-full left-full w-[200px] h-[150px] rounded-full bg-red-600 z-0 transition-all duration-700 group-hover:top-[-30px] group-hover:left-[-30px] group-active:bg-red-700"></span>
                                </button>

                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    <!-- JS: Role Filter & Icons -->
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const role = btn.dataset.role;
                document.querySelectorAll('.employee-card').forEach(card => {
                    if (role === 'all' || card.dataset.role.split(',').includes(role)) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });
        lucide.createIcons();
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }
    </style>
@endsection
