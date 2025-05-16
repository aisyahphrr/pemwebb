<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Edit Postingan</h1>
        <form method="POST" action="{{ route('posts.update', $id) }}" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block font-medium">Judul</label>
                <input type="text" name="title" value="{{ $post['title'] }}" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            
            <div class="mb-4">
                <label class="block font-medium">Konten</label>
                <textarea name="content" class="w-full border border-gray-300 rounded p-2 h-32" required>{{ $post['content'] }}</textarea>
            </div>
            
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Perbarui</button>
            <a href="{{ route('posts.index') }}" class="ml-4 text-blue-600 hover:underline">Kembali</a>
        </form>
    </div>
</body>
</html>
