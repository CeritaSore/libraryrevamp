<script setup>
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Card, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Users } from 'lucide-vue-next';
</script>

<template>
  <DashboardLayout>
    <Head title="Manage User" />

    <div class="space-y-6 max-w-7xl mx-auto">
      <!-- Page Header -->
      <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
          Manage User
        </h1>
        <p class="text-sm text-muted-foreground">
          Pengelolaan data anggota, hak akses staf perpustakaan, dan status keanggotaan aktif.
        </p>
      </div>

      <!-- Clean Canvas Card -->
      <Card class="border-dashed shadow-none">
        <CardHeader class="p-8 sm:p-12 text-center space-y-3">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-muted text-muted-foreground">
            <Users class="h-6 w-6" />
          </div>
          <CardTitle class="text-xl font-semibold">
            Manage User
          </CardTitle>
          <CardDescription class="max-w-md mx-auto text-sm">
            Area kerja pengguna siap dikonfigurasi untuk tabel data anggota, verifikasi registrasi baru, dan pengaturan peran pengguna.
          </CardDescription>
        </CardHeader>
      </Card>
    </div>
  </DashboardLayout>
</template>
