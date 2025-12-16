import { createRouter, createWebHistory } from "vue-router";

import Login from "../views/login/index.vue";
import Profile from "../views/profile/index.vue";
import EditProfile from "../views/editprofile/index.vue";
import Jadwal from "../views/jadwalKuliah/index.vue";
import KRS from "../views/krs/index.vue";
import Keuangan from "../views/keuangan/index.vue";

// ✅ SURAT (4 halaman)
import SuratHome from "../views/surat/HalamanSurat.vue";
import SuratCuti from "../views/surat/Cuti.vue";
import SuratAktifKembali from "../views/surat/AktifKembali.vue";
import SuratPengajuan from "../views/surat/PengajuanSurat.vue";

const routes = [
  { path: "/", redirect: "/login" },

  {
    path: "/login",
    name: "login",
    component: Login,
    meta: { hideLayout: true },
  },
  { path: "/profile", name: "profile", component: Profile },
  { path: "/edit-profile", name: "editprofile", component: EditProfile },
  { path: "/jadwal-kuliah", name: "jadwal", component: Jadwal },
  { path: "/krs", name: "krs", component: KRS },
  { path: "/keuangan", name: "keuangan", component: Keuangan },

  // ✅ SURAT: parent + children
  {
    path: "/surat",
    component: SuratHome,
    children: [
      // /surat  (menu utama)
      { path: "", name: "surat", component: SuratHome },

      // /surat/cuti
      { path: "cuti", name: "surat.cuti", component: SuratCuti },

      // /surat/aktif-kembali
      { path: "aktif-kembali", name: "surat.aktif", component: SuratAktifKembali },

      // /surat/pengajuan-surat
      { path: "pengajuan-surat", name: "surat.pengajuan", component: SuratPengajuan },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
