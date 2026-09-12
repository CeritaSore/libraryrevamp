<script setup>
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Card, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { ArrowLeftRight } from 'lucide-vue-next';
</script>

<template>
  <DashboardLayout>
    <Head title="Borrowed" />

    <div class="space-y-6 max-w-7xl mx-auto">
      <!-- Page Header -->
      <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
          Borrowed
        </h1>
        <p class="text-sm text-muted-foreground">
          Pemantauan transaksi sirkulasi peminjaman, tanggal jatuh tempo, dan pengembalian buku.
        </p>
      </div>

      <!-- Clean Canvas Card -->
      <Card class="border-dashed shadow-none">
        <CardHeader class="p-8 sm:p-12 text-center space-y-3">
          <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-muted text-muted-foreground">
            <ArrowLeftRight class="h-6 w-6" />
          </div>
          <CardTitle class="text-xl font-semibold">
            Borrowed
          </CardTitle>
          <CardDescription class="max-w-md mx-auto text-sm">
            Area kerja sirkulasi siap dikonfigurasi untuk pencatatan peminjaman aktif, riwayat pengembalian, dan penghitungan denda keterlambatan.
          </CardDescription>
        </CardHeader>
      </Card>
    </div>
  </DashboardLayout>
</template>
