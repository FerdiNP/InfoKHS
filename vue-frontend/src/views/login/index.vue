<template>
  <div class="page">
    <section class="login-box">
      <h1 class="brand">UMM</h1>
      <p class="brand-sub">u m m . a c . i d</p>

      <p class="title">Informasi Mahasiswa</p>
      <p class="subtitle">Universitas Muhammadiyah Malang</p>

      <form class="form" @submit.prevent="handleSubmit">
        <input
          v-model="form.nim"
          type="text"
          placeholder="NIM"
          class="input"
        />

        <input
          v-model="form.pic"
          type="password"
          placeholder="PIC"
          class="input"
        />

        <button type="submit" class="btn-login">Login</button>
      </form>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const form = ref({
  nim: "",
  pic: "",
});

const handleSubmit = () => {
  localStorage.setItem(
    "user",
    JSON.stringify({
      nim: form.value.nim || "dummy",
      nama_lengkap: "Mahasiswa Dummy",
      status: "login",
    })
  );

  router.push("/profile");
};
</script>

<style scoped>
.page {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  padding: 40px 16px;
  background: #ffffff;
}

.login-box {
  width: 100%;
  max-width: 350px;
  text-align: center;
  padding-top: 40px;
}

.brand {
  margin: 0;
  font-size: 46px;
  font-weight: 900;
  letter-spacing: 0.12em;
  color: #c62828;
}

.brand-sub {
  margin: 4px 0 14px;
  font-size: 13px;
  letter-spacing: 0.45em;
  font-weight: 700;
}

.title {
  font-size: 14px;
  color: #3f51b5;
}

.subtitle {
  font-size: 12px;
  margin-bottom: 22px;
  color: #3f51b5;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.input {
  padding: 10px 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
}

.btn-login {
  margin-top: 10px;
  padding: 10px;
  border: none;
  border-radius: 6px;
  color: white;
  background: #5a68b8;
  cursor: pointer;
}
</style>
