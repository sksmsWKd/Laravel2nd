<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WordMaster</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/word.js') }}"></script>
</body>





<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글쓰기') }}
            </h2>
            <button onclick="location.href='{{ route('posts.index') }}'" type="button"
                class="btn btn-info font-bold text-white justify-between hover:bg-red-700">
                작성취소
            </button>
        </div>


        <div class="m-2 p-2">



            <form class="row g-3" method="post" enctype="multipart/form-data"
                action="{{ route('posts.index') }}">
                @csrf


                <div class=" col-md-6 m-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value="{{ old('title') }}" class="form-control" name="title" id="title"
                        placeholder="제목">
                    @error('title')
                        <div class="text-red-800">
                            <span> {{ $message }}</span>
                        </div>
                    @enderror
                </div>



                <div class="col-12 m-4">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" style="height: 200px" name="content"
                        id="content">  {{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-red-800">
                            <span> {{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="col-12 m-4">
                    <label for="title" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>


                <div class="col-12 m-4">
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>

</html>
