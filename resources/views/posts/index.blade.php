<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-4xl mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold mb-6">Daftar Postingan</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('posts.create') }}"
           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6">
            + Tambah Postingan
        </a>

        @if($posts)
            @foreach($posts as $key => $post)
                <div class="bg-white p-5 shadow rounded mb-4">
                    <h2 class="text-xl font-semibold">{{ $post['title'] }}</h2>
                    <p class="text-gray-600 text-sm mb-2">
                        by {{ $post['author'] }} | {{ $post['created_at'] }}
                    </p>
                    <p class="text-gray-700">{{ $post['content'] }}</p>
                </div>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('posts.edit', $key) }}" class="text-yellow-600 hover:underline text-sm">Edit</a>
    
                    <form method="POST" action="{{ route('posts.destroy', $key) }}" onsubmit="return confirm('Yakin ingin menghapus postingan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="text-gray-600">Belum ada postingan.</p>
        @endif
        
        <a href="{{ route('dashboard') }}" class="inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mt-4">
            ← Kembali ke Dashboard
        </a>
    </div>

</body>
</html>
