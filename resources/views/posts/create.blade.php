<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Postingan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="max-w-xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Buat Postingan Baru</h1>

        <form method="POST" action="{{ route('posts.store') }}" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Judul</label>
                <input
                    type="text"
                    name="title"
                    class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Konten</label>
                <textarea
                    name="content"
                    class="w-full border border-gray-300 rounded p-2 h-32 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                ></textarea>
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Simpan
                </button>
                <a href="{{ route('posts.index') }}" class="ml-4 text-blue-600 hover:underline">
                    Kembali
                </a>
            </div>
        </form>
    </div>

</body>
</html>
