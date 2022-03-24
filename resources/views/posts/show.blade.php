<x-layout>
    <x-slot name="title">
        {{ $post->title }} - お悩み相談ルーム
    </x-slot>
    <a class = "back_img">
    <div class="back-link">
        &laquo; <a href="{{ route('posts.index') }}">戻る</a>
    </div>
    <p>ジャンル::</p>
    <h1>
       <span>{{ $post->title }}</span>
       <a href="{{ route('posts.edit', $post) }}">[編集する]</a>
       <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
           @method('DELETE')
           @csrf

           <button class="btn">[削除]</button>
       </form>
    </h1>
    <p class="Contents">{!! nl2br(e($post->body)) !!}</p>
    <h2>アドバイス</h2>
    <ul>
        <ol clas="right_chat">
            <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
                @csrf
                <input type="text" name="body">
                <button>投稿</button>
            </form>
        </ol>
        @foreach ($post->comments()->latest()->get() as $comment)
            <ol class="left_chat">
              {{ $comment->body }}
              <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                  @method('DELETE')
                  @csrf
                  {{-- 画像添付機能も追加予定 --}}
                  <label>
                    <input id=”image” type=”file” name=”image“>{{ old('image') }}
                    </label>
                    @error('image')
                     <div class="error">{{ $message }}</div>
                    @enderror
                  <button class="btn">[削除]</button>
              </form>
            </ol>
        @endforeach
    </ul>
    <script>
        'use strict';

        {
            document.getElementById('delete_post').addEventListener('submit', e => {
              e.preventDefault();

              if (!confirm('本当に削除しますか？')) {
                return;
              }

              e.target.submit();
            });

            document.querySelectorAll('.delete-comment').forEach(form => {
              form.addEventListener('submit', e => {
                e.preventDefault();

                if (!confirm('本当に削除しますか？')) {
                   return;
                }

                form.submit();
              });
            });
        }
    </script>
    <footer>
        <br>
        <br>
        <br>
        <br>
        <br>
        <span id="ShowNowTime"></span>

        <script type="text/javascript">
          timerID = setInterval('time()', 500);

          function minute2keta(num) {
            let addketa;
            if (num < 10) {
              addketa = "0" + num;
            } else {
              addketa = num;
            }
            return addketa;
          }

          function time() {
            document.getElementById("ShowNowTime").innerHTML = now();
          }

          function now() {
            let nowTime = new Date();
            let year = nowTime.getFullYear();
            let mon = nowTime.getMonth() + 1;
            let day = nowTime.getDate();
            let you = nowTime.getDay();
            let week = new Array("日", "月", "火", "水", "木", "金", "土");
            let hour = nowTime.getHours();
            let min = minute2keta(nowTime.getMinutes());

            let view = year + " " + mon + "/" + day + "(" + week[you] + ") " + hour + ":" + min;
            return view;
          }
        </script>
      </footer>
    </a>
</x-layout>
