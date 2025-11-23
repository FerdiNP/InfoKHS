<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">HOME</router-link>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li
              v-for="route in navRoutes"
              :key="route.name"
              class="nav-item"
            >
              <router-link
                class="nav-link"
                active-class="active"
                :to="{ name: route.name }"
              >
                {{ route.meta.label }}
              </router-link>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
import router from "./route";

export default {
  computed: {
    navRoutes() {
      return router.options.routes.filter(r => r.meta?.nav);
    }
  }
};
</script>

<style>
#app {
  font-family: "Inter", sans-serif;
  color: #444;
  background: #ffff;
}
</style>
