    <div class="common_content">
        @foreach ($data as $item)
            <p>{{ $item->name }} - {{ $item->email }}</p>
        @endforeach
    </div>
