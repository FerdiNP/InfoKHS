import { createRouter, createWebHistory } from "vue-router"

import Login from "../views/login/index.vue"
import Profile from "../views/profile/index.vue";
import EditProfile from "../views/editprofile/index.vue";
import Jadwal from "../views/jadwalKuliah/index.vue"
import KRS from "../views/krs/index.vue"
import Keuangan from "../views/keuangan/index.vue";
import Surat from "../views/surat/index.vue";

const routes = [
  {
    path: "/",
    redirect: "/login"
  },
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: { hideLayout: true }
  },
  {
    path: "/profile",
    name: "profile",
    component: Profile
  },
  {
    path: "/edit-profile",
    name: "editprofile",
    component: EditProfile
  },
  {
    path: "/jadwal-kuliah",
    name: "jadwal",
    component: Jadwal
  },
  {
    path: "/krs",
    name: "krs",
    component: KRS
  },
  {
    path: "/keuangan",
    name: "keuangan",
    component: Keuangan,
  },
  {
    path: "/surat",
    name: "surat",
    component: Surat
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
