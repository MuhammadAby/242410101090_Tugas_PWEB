// Data awal & localStorage
const STORAGE_KEY = "pedulikita_program";

const dataAwal = [
  {
    id: 1,
    nama: "Bantuan Erupsi Gunung Semeru",
    kategori: "Bencana Alam",
    target: 50000000,
    terkumpul: 11000000,
    tanggal: "2026-01-10",
    gambar: "Donasi Semeru.jpg",
  },
  {
    id: 2,
    nama: "Beasiswa Anak Yatim 2026",
    kategori: "Anak Yatim",
    target: 50000000,
    terkumpul: 30000000,
    tanggal: "2026-01-15",
    gambar: "Donasi Anak Yatim.jpg",
  },
  {
    id: 3,
    nama: "Buku untuk Pelosok Negeri",
    kategori: "Pendidikan",
    target: 30000000,
    terkumpul: 22500000,
    tanggal: "2026-02-01",
    gambar: "",
  },
  {
    id: 4,
    nama: "Renovasi Masjid Al-Ikhlas",
    kategori: "Masjid",
    target: 100000000,
    terkumpul: 17500000,
    tanggal: "2026-02-10",
    gambar: "Donasi Masjid.jpg",
  },
];

// Emoji fallback jika tidak ada gambar
const emojiKategori = (kategori) => {
  const map = {
    "Bencana Alam": "🌊",
    "Anak Yatim": "🤝",
    Pendidikan: "📚",
    Masjid: "🕌",
    Kesehatan: "🏥",
  };
  return map[kategori] || "❤️";
};

let daftarProgram = JSON.parse(localStorage.getItem(STORAGE_KEY)) || dataAwal;
let idEdit = null;

// Simpan ke localStorage
const simpanKeStorage = () => {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(daftarProgram));
};

// Format Rupiah
const formatRupiah = (angka) => {
  return "Rp " + Number(angka).toLocaleString("id-ID");
};

// Update Statistik
const updateStatistik = () => {
  const total = daftarProgram.length;
  const totalDana = daftarProgram.reduce((acc, p) => acc + Number(p.target), 0);
  const mendesak = daftarProgram.filter(
    (p) => (p.terkumpul / p.target) * 100 < 10,
  ).length;

  document.getElementById("sidebar-total").textContent = total;
  document.getElementById("sidebar-dana").textContent = formatRupiah(totalDana);
  document.getElementById("sidebar-aktif").textContent = total;
  document.getElementById("sidebar-mendesak").textContent = mendesak;
};

// Render Card Grid
const renderCard = (data) => {
  const grid = document.getElementById("card-grid");
  grid.innerHTML = "";

  if (data.length === 0) {
    grid.innerHTML =
      '<p style="color:#999; padding:12px;">Tidak ada program ditemukan.</p>';
    return;
  }

  data.forEach((program) => {
    const gambarHTML = program.gambar
      ? `<img src="${program.gambar}" alt="${program.nama}" />`
      : emojiKategori(program.kategori);

    const artikel = document.createElement("article");
    artikel.className = "card";
    artikel.innerHTML = `
      <figure class="card-gambar">${gambarHTML}</figure>
      <section class="card-isi">
        <p class="card-kategori">${program.kategori}</p>
        <h4>${program.nama}</h4>
        <p>Terkumpul: <b>${formatRupiah(program.terkumpul)}</b></p>
        <button class="btn-donasi">Donasi</button>
      </section>
    `;
    grid.appendChild(artikel);
  });
};

// Render Tabel
const renderTabel = (data) => {
  const tbody = document.getElementById("tbody-program");
  tbody.innerHTML = "";

  if (data.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:16px; color:#999;">Tidak ada program ditemukan.</td></tr>`;
    return;
  }

  data.forEach((program, index) => {
    const persen = Math.round((program.terkumpul / program.target) * 100);
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${index + 1}</td>
      <td>${program.nama}</td>
      <td>${program.kategori}</td>
      <td>${formatRupiah(program.target)}</td>
      <td>${formatRupiah(program.terkumpul)} (${persen}%)</td>
      <td>${program.tanggal}</td>
      <td>
        <button class="btn-edit" data-id="${program.id}">Edit</button>
        <button class="btn-hapus" data-id="${program.id}">Hapus</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
};

// Render semua
const renderSemua = (data = daftarProgram) => {
  renderCard(data);
  renderTabel(data);
  updateStatistik();
};

// Validasi Form
const validasiForm = () => {
  let valid = true;

  const nama = document.getElementById("nama-program").value.trim();
  const kategori = document.getElementById("kategori-program").value;
  const target = document.getElementById("target-dana").value;
  const tanggal = document.getElementById("tanggal-mulai").value;

  document
    .querySelectorAll(".pesan-error")
    .forEach((el) => (el.textContent = ""));

  if (nama === "") {
    document.getElementById("error-nama").textContent =
      "Nama program wajib diisi.";
    valid = false;
  }
  if (kategori === "") {
    document.getElementById("error-kategori").textContent =
      "Kategori wajib dipilih.";
    valid = false;
  }
  if (target === "" || Number(target) <= 0) {
    document.getElementById("error-target").textContent =
      "Target dana wajib diisi dan lebih dari 0.";
    valid = false;
  }
  if (tanggal === "") {
    document.getElementById("error-tanggal").textContent =
      "Tanggal mulai wajib diisi.";
    valid = false;
  }

  return valid;
};

// Reset Form
const resetForm = () => {
  document.getElementById("form-program").reset();
  document
    .querySelectorAll(".pesan-error")
    .forEach((el) => (el.textContent = ""));
  document.getElementById("form-judul").textContent = "Tambah Program Donasi";
  document.getElementById("btn-simpan").textContent = "Simpan Program";
  idEdit = null;
};

// Submit Form (Tambah / Update)
document.getElementById("form-program").addEventListener("submit", (e) => {
  e.preventDefault();

  if (!validasiForm()) return;

  const nama = document.getElementById("nama-program").value.trim();
  const kategori = document.getElementById("kategori-program").value;
  const target = Number(document.getElementById("target-dana").value);
  const tanggal = document.getElementById("tanggal-mulai").value;

  if (idEdit !== null) {
    // Update / Edit
    daftarProgram = daftarProgram.map((p) =>
      p.id === idEdit ? { ...p, nama, kategori, target, tanggal } : p,
    );
    idEdit = null;
  } else {
    // Tambah baru — terkumpul mulai 0, gambar kosong (pakai emoji)
    const idBaru =
      daftarProgram.length > 0
        ? Math.max(...daftarProgram.map((p) => p.id)) + 1
        : 1;
    daftarProgram.push({
      id: idBaru,
      nama,
      kategori,
      target,
      terkumpul: 0,
      tanggal,
      gambar: "",
    });
  }

  simpanKeStorage();
  resetForm();
  renderSemua();
});

// Tombol Batal
document.getElementById("btn-batal").addEventListener("click", resetForm);

// Hapus & Edit
document.getElementById("tbody-program").addEventListener("click", (e) => {
  const id = Number(e.target.dataset.id);

  // Hapus
  if (e.target.classList.contains("btn-hapus")) {
    const konfirmasi = confirm("Yakin ingin menghapus program ini?");
    if (konfirmasi) {
      daftarProgram = daftarProgram.filter((p) => p.id !== id);
      simpanKeStorage();
      renderSemua();
    }
  }

  // Edit
  if (e.target.classList.contains("btn-edit")) {
    const program = daftarProgram.find((p) => p.id === id);
    if (!program) return;

    document.getElementById("nama-program").value = program.nama;
    document.getElementById("kategori-program").value = program.kategori;
    document.getElementById("target-dana").value = program.target;
    document.getElementById("tanggal-mulai").value = program.tanggal;

    document.getElementById("form-judul").textContent = "Edit Program Donasi";
    document.getElementById("btn-simpan").textContent = "Update Program";

    idEdit = id;
    document
      .getElementById("form-program")
      .scrollIntoView({ behavior: "smooth" });
  }
});

// Pencarian real-time
const cariProgram = () => {
  const keyword = document
    .getElementById("input-cari")
    .value.trim()
    .toLowerCase();
  const kategori = document.getElementById("filter-kategori").value;

  // Filter nama + kategori
  const hasil = daftarProgram.filter((p) => {
    const cocokCari = p.nama.toLowerCase().includes(keyword);
    const cocokKategori = kategori === "" || p.kategori === kategori;
    return cocokCari && cocokKategori;
  });

  renderCard(hasil);
  renderTabel(hasil);
};

document.getElementById("input-cari").addEventListener("input", cariProgram);
document
  .getElementById("filter-kategori")
  .addEventListener("change", cariProgram);
document.getElementById("btn-cari").addEventListener("click", cariProgram);

// Reset pencarian
document.getElementById("btn-reset-cari").addEventListener("click", () => {
  document.getElementById("input-cari").value = "";
  document.getElementById("filter-kategori").value = "";
  renderSemua();
});

// Jalankan saat halaman dibuka
renderSemua();
