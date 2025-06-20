@extends('base')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div
        class="flex rounded-[9px] shadow-[0px_187px_75px_rgba(0,0,0,0.01),0px_105px_63px_rgba(0,0,0,0.05),0px_47px_47px_rgba(0,0,0,0.09),0px_12px_26px_rgba(0,0,0,0.1),0px_0px_0px_rgba(0,0,0,0.1)]">

        <!-- Login Form -->
        <form action="{{ route('auth.loginAdmin') }}" method="POST"
            class="w-[350px] flex flex-col gap-4 p-5 rounded-l-[9px] bg-white">
            @csrf

            <div class="flex flex-col items-center my-4">
                <h2 class="font-bold text-[15px] leading-[21px] text-center text-[#2B2B2F] mb-2">Admin Login</h2>
                <p class="max-w-[80%] mx-auto font-semibold text-[10px] leading-[14px] text-center text-[#5F5D6B]">
                    Sign in using your username or email
                </p>
            </div>

            @if (session('error'))
                <p class="text-red-500 text-xs text-center">{{ session('error') }}</p>
            @endif

            <!-- Login (Username or Email) -->
            <div class="relative flex flex-col gap-1 w-full">
                <input type="text" name="login" placeholder="Username or Email"
                    class="h-10 pl-3 pr-3 rounded-[7px] border border-[#e5e5e5] shadow-[0_1px_0_#efefef,0_1px_0.5px_rgba(239,239,239,0.5)] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-[#115DFC] transition-all duration-300"
                    value="{{ old('login') }}">
                @error('login')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative flex flex-col gap-1 w-full">
                <input type="password" name="password" placeholder="Password"
                    class="h-10 pl-3 pr-3 rounded-[7px] border border-[#e5e5e5] shadow-[0_1px_0_#efefef,0_1px_0.5px_rgba(239,239,239,0.5)] focus:outline-none focus:border-transparent focus:ring-2 focus:ring-[#115DFC] transition-all duration-300">
                @error('password')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="flex items-center justify-center gap-2 w-full h-9 bg-gradient-to-b from-[#4480FF] via-[#115DFC] to-[#0550ED] shadow-[0px_0.5px_0.5px_#EFEFEF,0px_1px_0.5px_rgba(239,239,239,0.5)] rounded-md border-0 font-semibold text-white text-[12px] leading-[15px] transition-all duration-[600ms] ease-[cubic-bezier(0.15,0.83,0.66,1)] hover:scale-[1.01] hover:-translate-y-[2px] hover:shadow-[0_10px_20px_0_#054eed6b]">
                Login
            </button>
        </form>

        <!-- Right-side panel -->
        <div
            class="w-[250px] hidden md:flex flex-col items-center justify-center gap-5 p-5 bg-[linear-gradient(358.31deg,#fff_-24.13%,hsla(0,0%,100%,0)_338.58%),linear-gradient(89.84deg,rgba(230,36,174,.15)_0.34%,rgba(94,58,255,.15)_16.96%,rgba(10,136,255,.15)_34.66%,rgba(75,191,80,.15)_50.12%,rgba(137,206,0,.15)_66.22%,rgba(239,183,0,.15)_82%,rgba(246,73,0,.15)_99.9%)] rounded-r-[9px]">
            <div class="flex flex-col items-center justify-center gap-1">
                <div class="w-[50px] h-[50px] rounded-full bg-[#00000011]"></div>
                <p class="text-[#4d4c6d] text-[11px] font-semibold text-center">Admin</p>
                <p class="text-[10px] font-semibold text-center text-[rgb(141,140,161)]">System Admin</p>
            </div>
        </div>
    </div>
</div>
@endsection
