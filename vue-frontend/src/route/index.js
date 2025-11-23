import { createRouter, createWebHistory } from "vue-router"

import Home from "../views/home.vue"
import Jadwal from "../views/jadwalKuliah/index.vue"

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/jadwal-kuliah",
    name: "jadwal",
    component: Jadwal
    },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
