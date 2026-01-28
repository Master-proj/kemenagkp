const params = new URLSearchParams(window.location.search);
const id = params.get("id") || "berita";

const dataBidang = {
  berita: {
    nama: "Berita Kemenag Kota Semarang",
    deskripsi:
      "Informasi terbaru seputar kegiatan, pengumuman, dan agenda Kementerian Agama Kota Semarang.",
    tipe: "berita",
  },
  "bimas-islam": {
    nama: "Bimas Islam",
    deskripsi:
      "Bidang Bimas Islam melaksanakan pelayanan dan pembinaan urusan Islam.",
  },
  penma: {
    nama: "PENMA",
    deskripsi: "Bidang Pendidikan Madrasah.",
  },
  "pd-pontren": {
    nama: "PD Pontren",
    deskripsi: "Bidang Pendidikan Diniyah dan Pondok Pesantren.",
  },
  "zakat-wakaf": {
    nama: "Zakat & Wakaf",
    deskripsi: "Layanan zakat, infak, sedekah, dan wakaf.",
  },
  pais: {
    nama: "PAIS",
    deskripsi: "Pendidikan Agama Islam.",
  },
  kristen: {
    nama: "Penyelenggara Kristen",
    deskripsi: "Pembinaan umat Kristen.",
  },
  katolik: {
    nama: "Penyelenggara Katolik",
    deskripsi: "Pembinaan umat Katolik.",
  },
  hindu: {
    nama: "Penyelenggara Hindu",
    deskripsi: "Pembinaan umat Hindu.",
  },
  buddha: {
    nama: "Penyelenggara Buddha",
    deskripsi: "Pembinaan umat Buddha.",
  },
  tu: {
    nama: "Sub Bagian Tata Usaha",
    deskripsi: "Layanan administrasi dan perizinan.",
    punyaDetail: true,
    detail: {
      judul: "Layanan TU",
      isi: `
        <ul style="text-align:left;max-width:600px;margin:20px auto;">
          <li>Izin Penelitian</li>
          <li>Izin PPL / Magang / PKL</li>
          <li>Legalitas & Rekomendasi</li>
        </ul>
      `,
    },
  },
  pengaduan: {
    nama: "Pengaduan Masyarakat",
    deskripsi:
      "Saluran resmi bagi masyarakat untuk menyampaikan pengaduan.",
    punyaDetail: true,
    detail: {
      judul: "WA SALAMAN",
      isi: `
        <p style="font-size:20px;">Hubungi kami melalui WhatsApp:</p>
        <p style="font-size:26px;color:#0b5d2a;font-weight:bold;">
          +62 851-6999-4994
        </p>
      `,
    },
  },
};

const judulEl = document.getElementById("judulBidang");
const deskEl = document.getElementById("deskripsiBidang");
const areaDetail = document.getElementById("areaDetail");
const btnDetail = document.getElementById("btnDetail");
const kontenKhusus = document.getElementById("kontenKhusus");

const bidang = dataBidang[id];

if (!bidang) {
  judulEl.textContent = "Bidang Tidak Ditemukan";
  deskEl.textContent = "Data tidak tersedia.";
} else {
  judulEl.textContent = bidang.nama;
  deskEl.textContent = bidang.deskripsi;

  if (bidang.tipe === "berita") {
    tampilkanBerita();
  }

  if (bidang.punyaDetail) {
    areaDetail.style.display = "block";
    btnDetail.onclick = function (e) {
      e.preventDefault();
      kontenKhusus.innerHTML = `
        <div style="max-width:800px;margin:0 auto;text-align:center;">
          <h3 class="section-title">${bidang.detail.judul}</h3>
          ${bidang.detail.isi}
        </div>
      `;
    };
  }
}

function tampilkanBerita() {
  const berita = [
    {
      judul: "Kemenag Gelar Manasik Haji",
      tanggal: "10 Januari 2024",
      ringkas: "Ratusan calon jamaah mengikuti manasik.",
    },
    {
      judul: "Hari Amal Bakti Kemenag",
      tanggal: "3 Januari 2024",
      ringkas: "Upacara HAB berlangsung khidmat.",
    },
  ];

  let html = '<div style="max-width:900px;margin:0 auto;">';
  berita.forEach((b) => {
    html += `
      <div style="background:#fff;padding:16px;border-radius:12px;margin-bottom:16px;box-shadow:0 6px 14px rgba(0,0,0,0.1);">
        <h4>${b.judul}</h4>
        <small style="color:#888;">${b.tanggal}</small>
        <p>${b.ringkas}</p>
      </div>
    `;
  });
  html += "</div>";

  kontenKhusus.innerHTML = html;
}
