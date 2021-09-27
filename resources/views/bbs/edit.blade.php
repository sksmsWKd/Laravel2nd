<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('수정하기') }}
            </h2>
            <button onclick="location.href='{{ route('posts.show', ['post' => $post->id]) }}'" type="button"
                class="btn btn-info font-bold text-white justify-between hover:bg-red-700">
                수정 취소
            </button>
        </div>


        <div class="m-2 p-2">



            <form id="edit" class="row g-3" method="post" enctype="multipart/form-data"
                action="{{ route('posts.update', ['post' => $post->id]) }}">
                @method('patch')
                @csrf


                <div class=" col-md-6 m-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" value="{{ $post->title }}" class="form-control" name="title" id="title"
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
                        id="content">  {{ $post->content }}</textarea>
                    @error('content')
                        <div class="text-red-800">
                            <span> {{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="card-body">
                    @if ($post->image)
                        <img class="card-img-top" src="/storage/images/{{ $post->image }}" alt="Card image cap">
                        <button class="btn btn-danger mt-2" name="action" value="delete">이미지 삭제</button>

                    @else
                        <span> 첨부 이미지 없음</span>
                    @endif
                </div>
                <div class="col-12 m-4">
                    <label for="title" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image" value="{{ $post->image }}">
                </div>


                <div class="col-12 m-4">
                    <button type="submit" class="btn btn-primary" name="action" value="save">save</button>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>

<script>
    deleteImage() {

    }
</script>
