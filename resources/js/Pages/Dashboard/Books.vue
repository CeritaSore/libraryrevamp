<script setup>
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Card, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { BookOpen } from 'lucide-vue-next';
</script>

<template>
  <DashboardLayout>
    <Head title="Books" />

    <div class="space-y-6 max-w-7xl mx-auto">
      <!-- Page Header -->
      <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
          Books
        </h1>
        <p class="text-sm text-muted-foreground">
          Pengelolaan katalog, klasifikasi subjek, dan ketersediaan koleksi buku perpustakaan.
        </p>
      </div>

      <!-- Clean Canvas Card -->
      <Card class="border-dashed shadow-none">
        <CardHeader class="p-8 sm:p-12 text-center space-y-3">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-muted text-muted-foreground">
            <BookOpen class="h-6 w-6" />
          </div>
          <CardTitle class="text-xl font-semibold">
            Books
          </CardTitle>
          <CardDescription class="max-w-md mx-auto text-sm">
            Area kerja pengelolaan buku siap dikonfigurasi untuk tabel data koleksi, penambahan judul baru, dan klasifikasi nomor panggil.
          </CardDescription>
        </CardHeader>
      </Card>
    </div>
  </DashboardLayout>
</template>
