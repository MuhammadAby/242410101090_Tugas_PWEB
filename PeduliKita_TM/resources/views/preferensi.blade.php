@extends('layouts.app')

@section('content')

<h2>Pengaturan Preferensi</h2>

<form id="form-preferensi">

    <label>Tema:</label>
    <select id="theme">
        <option value="light">Light</option>
        <option value="dark">Dark</option>
    </select>

    <br><br>

    <label>Ukuran Font:</label>
    <select id="font">
        <option value="small">Kecil</option>
        <option value="medium">Sedang</option>
        <option value="large">Besar</option>
    </select>

    <br><br>

    <button type="submit">Simpan</button>

</form>

<p id="status"></p>

@endsection

@push('scripts')
<script>

// helper cookie
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

// FETCH KE LARAVEL (INI 3f)
document.getElementById('form-preferensi').addEventListener('submit', async function(e) {

    e.preventDefault();

    let theme = document.getElementById('theme').value;
    let font = document.getElementById('font').value;

    let response = await fetch('/preferensi', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ theme, font })
    });

    let data = await response.json();

    // simpan ke cookie
    setCookie('theme', theme, 7);
    setCookie('font', font, 7);

    document.getElementById('status').innerText = "Preferensi disimpan!";
});

</script>
@endpush
