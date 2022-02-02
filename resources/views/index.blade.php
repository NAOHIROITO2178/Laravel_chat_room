<x-layout>
    <x-slot name="title">
        お悩み相談ルーム
    </x-slot>
    <a class = "back_img">
    <p class = "introduction">ここは、皆さんがTodoリストで追加したやることの中で困った事を何でも相談できる匿名掲示板です。困ったことがあったらいつでも投稿してください。そして、自分に対処できそうだなと思った悩みの投稿を見つけたら、アドバイスをして相談に乗ってあげましょう。</p>
    <div class = "sodan_room">
    <h1>
      <span>なんでも相談ルーム</span>
      <a href="{{ route('posts.create') }}">[投稿]</a>
    </h1>
    <ul>
        @forelse ($posts as $post)
        <ol>
            <a href="{{ route('posts.show', $post) }}">
                {{ $post->title }}:
                {{-- //{{ $post->category }} --}}
            </a>
        </ol>
        @empty
          <ol>まだ投稿はありません</ol>
        @endforelse
    </ul>
    </div>
    <br>
    <br>
    <br>
    <div class = "back_todo">
    <a href = "http://localhost:8562/main.php?">
        ＜＜＜Todoリストに戻る
    </a>
    </div>
    <footer>
        <br>
        <br>
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
