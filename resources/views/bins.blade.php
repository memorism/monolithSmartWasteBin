<!DOCTYPE html>
<html>
<head>
    <title>Smart Waste Bin Search</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #f4f4f4; }
        h1 { text-align: center; }
        form { text-align: center; margin-bottom: 20px; }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
            background-color: #2d89e5;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .danger { color: red; font-weight: bold; }
        .normal { color: green; }
        .battery-low { color: orange; }
    </style>
</head>
<body>
    <h1>🔍 Cari Tempat Sampah Pintar</h1>

    <form method="GET" action="/bins">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berdasarkan lokasi TPS...">
        <button type="submit">Cari</button>
    </form>

    <p style="text-align:center;">
        Menampilkan {{ $bins->count() }} hasil {{ isset($search) && $search ? "untuk pencarian \"$search\"" : '' }}
    </p>

    <div class="grid">
        @forelse($bins as $bin)
            <div class="card">
                <h3>{{ $bin['location'] }}</h3>
                <p><strong>Jenis:</strong> {{ $bin['type'] }}</p>
                <p><strong>Kepenuhan:</strong> 
                    <span class="{{ $bin['fullness'] >= 80 ? 'danger' : 'normal' }}">
                        {{ $bin['fullness'] }}%
                    </span>
                </p>
                <p><strong>Baterai:</strong> 
                    <span class="{{ $bin['battery'] < 40 ? 'battery-low' : 'normal' }}">
                        {{ $bin['battery'] }}%
                    </span>
                </p>
            </div>
        @empty
            <p style="grid-column: 1 / -1; text-align:center;">Data tidak ditemukan.</p>
        @endforelse
    </div>
</body>
</html>
