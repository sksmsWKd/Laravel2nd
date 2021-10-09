<div class="m-20 flex justify-center">
    <div class="card" style="width: 30rem;">


        <div class="card-body">
            @if ($post->image)
                <img class="card-img-top" src="/storage/images/{{ $post->image }}" alt="Card image cap">
            @else
                <span> 첨부 이미지 없음</span>
            @endif
        </div>


        <ul class="list-group list-group-flush">
            <li class="list-group-item"> 제목 : {{ $post->title }}</li>
            <li class="list-group-item"> 내용 : {{ $post->content }}</li>

            {{-- 좋아요 버튼 --}}
            <li class="list-group-item">
                <like-button :post="{{ $post }}" :loginuser="{{ Auth::user()->id }}"></like-button>
            </li>
            <li class="list-group-item"> 등록일 : {{ $post->created_at->diffForHumans() }}</li>
            <li class="list-group-item"> 수정일 : {{ $post->updated_at->diffForHumans() }}</li>
            <li class="list-group-item"> 작성자 : {{ $post->writer->name }}</li>
        </ul>

        <div class="card-body flex justify-center ">
            <a class="mr-20" href="{{ route('posts.edit', ['post' => $post->id]) }}">수정하기</a>
            <form onsubmit="return confirmDelete()" id="form" method="POST"
                action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @method('delete')
                @csrf
                {{-- 서버에서 처리. html 을 웹브라우저에 보냄. --}}

                <button type="submit">
                    삭제하기

                </button>

            </form>
        </div>
    </div>
</div>
