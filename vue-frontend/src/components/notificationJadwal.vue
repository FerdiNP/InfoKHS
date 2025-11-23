<template>
  <div class="page">
    <!-- langsung overlay saja -->
    <div class="overlay"></div>
    <div class="modal-card" role="dialog" aria-modal="true">
      <div class="icon-wrap">
        <div class="icon-wrapper">
          <div class="icon-wrapper-2">
            <div class="icon"></div>
          </div>
        </div>
      </div>
      <h2 class="title">Perubahan Kelas!</h2>
      <p class="subtitle">
        Terdapat kelas yang dipindah karena kuota kelas sebelumnya telah penuh!
      </p>
      <div class="actions">
        <button class="btn primary" @click="lihat">Lihat Jadwal</button>
        <button class="btn ghost" @click="tutup">Tutup</button>
      </div>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits(["close"]);

function lihat() {
  emit("close");
}

function tutup() {
  emit("close");
}
</script>

<style scoped>
.page {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 3000;
  pointer-events: auto;
}

.overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.35);
  backdrop-filter: blur(6px);
  z-index: 1;
}

.modal-card {
  position: relative;
  z-index: 2;
  width: min(380px, 92%);
  background: #ffffff;
  border-radius: 18px;
  padding: 24px;
  box-shadow: 0 18px 38px rgba(15, 23, 42, 0.45);
  text-align: center;
}

.modal-card {
  transform: scale(0.95);
  opacity: 0;
  animation: fadeIn 0.25s ease-out forwards;
}

@keyframes fadeIn {
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.icon-wrapper {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fef3f2;
}

.icon-wrapper-2 {
  width: 70%;
  height: 70%;
  border-radius: 50%;
  display: flex;
 	align-items: center;
  justify-content: center;
  background: #fee4e2;
}

.icon-wrap {
  display: flex;
  justify-content: center;
  margin-bottom: 16px;
}

.icon {
  width: 70%;
  height: 70%;
  border-radius: 50%;
  background-image: url("../assets/alert-circle.svg");
  background-size: cover;
}

.title {
  color: black;
  margin: 6px 0 8px 0;
  font-size: 20px;
  font-weight: 700;
}

.subtitle {
  margin: 0 0 20px 0;
  font-size: 14px;
  color: #555;
}

.actions {
  display: flex;
  gap: 12px;
  flex-direction: column;
}

.btn {
  padding: 12px;
  border-radius: 10px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  border: 1px solid transparent;
}

.btn.primary {
  background: #d93b2b;
  color: white;
}
.btn.ghost {
  background: white;
  border: 1px solid #ddd;
  color: black;
}
</style>
