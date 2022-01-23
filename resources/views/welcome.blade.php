
@extends('layouts.app')

@section('content')
    <div class="w-full h-full flex flex-col justify-center items-center">
        <div class="text-center text-blue-600 font-bold" style="font-size: 80px">
            Jarasia
            <!-- <img width="80" src="/images/logo.png"> -->
        </div>


        <div class="flex justify-center items-center mt-4 sm:items-center sm:justify-between">
            <a href="https://averotech.com/" class="flex items-center justify-center pb-10 text-gray-400 hover:text-blue-600">
                
                <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="20" height="20" class="fill-current cursor-pointer tracking-wide hover:opacity-100" style="isolation: isolate; transition: opacity 0.4s linear 0s;"><path d=" M 15 0 L 15 0 C 23.279 0 30 6.721 30 15 L 30 27.75 C 30 28.992 28.992 30 27.75 30 L 15 30 C 6.721 30 0 23.279 0 15 L 0 15 C 0 6.721 6.721 0 15 0 Z  M 25 25 L 15 25 C 12.35 25 9.8 23.95 7.93 22.07 C 6.05 20.2 5 17.65 5 15 C 5 12.35 6.05 9.8 7.93 7.93 C 9.8 6.05 12.35 5 15 5 C 17.65 5 20.2 6.05 22.07 7.93 C 23.95 9.8 25 12.35 25 15 L 25 25 Z " fill-rule="evenodd"></path></svg>

                <div class="ml-2 text-xs font-sans mt-px">By Averotech</div> 
            </a>
        </div>
    </div>
@endsection
