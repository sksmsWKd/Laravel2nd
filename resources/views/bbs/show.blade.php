<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>


            <button onclick="location.href='{{ route('posts.index') }}'" type="button"
                class="btn btn-info font-bold text-white justify-between hover:bg-red-700">
                목록보기
            </button>

        </div>
    </x-slot>


    <x-post-show :post="$post" :comments="$comments" />
</x-app-layout>
