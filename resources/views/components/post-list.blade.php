<div class="ml-20 mr-20 pl-20 pr-20">
    <h1>나의 이름은 {{ $name }}입니다. </h1>
    <table class="table table-hover">
        <thead>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">작성일</th>
            <th scope="col">좋아요</th>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
                    <td>{{ $post->writer->name }}</td>
                    <td>{{ $post->created_at->diffForHumans() }}</td>
                    <td>{{ $post->likes->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
