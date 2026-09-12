<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/components/ui/card';
import {
  Search,
  BookOpen,
  Layers,
  ArrowRight,
  Bookmark,
  CheckCircle2,
  Clock,
  Sparkles,
  Library,
  GraduationCap,
  FileText,
  Users,
} from 'lucide-vue-next';

const props = defineProps({
  stats: {
    type: Array,
    default: () => [],
  },
  categories: {
    type: Array,
    default: () => [],
  },
  featuredBooks: {
    type: Array,
    default: () => [],
  },
  services: {
    type: Array,
    default: () => [],
  },
});

const searchQuery = ref('');
const selectedCategory = ref('all');

const filteredBooks = computed(() => {
  return props.featuredBooks.filter((book) => {
    const matchesSearch =
      searchQuery.value.trim() === '' ||
      book.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      book.author.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      book.category.toLowerCase().includes(searchQuery.value.toLowerCase());

    const matchesCategory =
      selectedCategory.value === 'all' ||
      book.category.toLowerCase().includes(selectedCategory.value.toLowerCase());

    return matchesSearch && matchesCategory;
  });
});

const quickCategories = [
  { id: 'all', label: 'Semua Koleksi' },
  { id: 'teknologi', label: 'Teknologi' },
  { id: 'sains', label: 'Sains' },
  { id: 'sastra', label: 'Sastra' },
  { id: 'bisnis', label: 'Bisnis' },
  { id: 'filsafat', label: 'Filsafat' },
];

const selectFilter = (id) => {
  selectedCategory.value = id;
};
</script>

<template>
  <AppLayout>
    <Head title="Beranda Perpustakaan" />

    <!-- Hero Section -->
    <section class="relative border-b bg-gradient-to-b from-muted/50 via-background to-background pt-12 pb-16 md:pt-20 md:pb-24">
      <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center space-y-8">
        <!-- Top Badge -->
        <div class="inline-flex items-center gap-2 rounded-full border bg-background px-3.5 py-1 text-xs font-medium text-muted-foreground shadow-sm">
          <Sparkles class="h-3.5 w-3.5 text-primary" />
          <span>Sistem Informasi Perpustakaan Terintegrasi</span>
        </div>

        <!-- Main Headline -->
        <div class="max-w-3xl mx-auto space-y-4">
          <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-foreground leading-tight">
            Temukan Referensi, Perluas Cakrawala Pengetahuan
          </h1>
          <p class="text-base sm:text-lg text-muted-foreground leading-relaxed max-w-2xl mx-auto">
            Akses ribuan koleksi buku fisik, jurnal ilmiah terakreditasi, dan materi digital dengan penelusuran cepat dan sistem sirkulasi modern.
          </p>
        </div>

        <!-- Primary Search Bar (Big & Accessible Hit Target) -->
        <div class="max-w-2xl mx-auto">
          <div class="relative flex items-center shadow-lg rounded-xl border bg-background p-1.5 focus-within:ring-2 focus-within:ring-primary focus-within:border-primary transition-all">
            <div class="pl-3 pr-2 text-muted-foreground">
              <Search class="h-5 w-5" />
            </div>
            <Input
              v-model="searchQuery"
              type="text"
              placeholder="Cari judul buku, nama penulis, atau topik bahasan..."
              class="border-0 shadow-none focus-visible:ring-0 focus-visible:ring-offset-0 text-base h-12 px-2"
            />
            <Button size="lg" class="h-11 px-6 text-sm font-semibold rounded-lg shrink-0">
              Cari
            </Button>
          </div>

          <!-- Quick Filter Tags -->
          <div class="flex flex-wrap items-center justify-center gap-2 mt-4 text-xs">
            <span class="text-muted-foreground font-medium mr-1">Topik Populer:</span>
            <button
              v-for="cat in quickCategories"
              :key="cat.id"
              @click="selectFilter(cat.id)"
              :class="[
                'px-3 py-1.5 rounded-full border text-xs font-medium transition-colors cursor-pointer',
                selectedCategory === cat.id
                  ? 'bg-primary text-primary-foreground border-primary'
                  : 'bg-background hover:bg-muted text-foreground border-border'
              ]"
            >
              {{ cat.label }}
            </button>
          </div>
        </div>

        <!-- Quick Action 4-Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6 max-w-6xl mx-auto text-left">
          <a href="#katalog" class="group block">
            <Card class="h-full transition-all duration-200 hover:border-primary/60 hover:shadow-md cursor-pointer">
              <CardHeader class="p-5 pb-3">
                <div class="flex items-center justify-between">
                  <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                    <BookOpen class="h-5 w-5" />
                  </div>
                  <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" />
                </div>
                <CardTitle class="text-base font-semibold pt-3">
                  Katalog Koleksi Fisik
                </CardTitle>
              </CardHeader>
              <CardContent class="p-5 pt-0 text-xs text-muted-foreground leading-normal">
                Jelajahi ketersediaan buku cetak, buku teks, dan karya monograf di rak perpustakaan.
              </CardContent>
            </Card>
          </a>

          <a href="#kategori" class="group block">
            <Card class="h-full transition-all duration-200 hover:border-primary/60 hover:shadow-md cursor-pointer">
              <CardHeader class="p-5 pb-3">
                <div class="flex items-center justify-between">
                  <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                    <Layers class="h-5 w-5" />
                  </div>
                  <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" />
                </div>
                <CardTitle class="text-base font-semibold pt-3">
                  Kategori Subjek
                </CardTitle>
              </CardHeader>
              <CardContent class="p-5 pt-0 text-xs text-muted-foreground leading-normal">
                Klasifikasi bidang ilmu berdasarkan standar DDC dari teknologi hingga filsafat.
              </CardContent>
            </Card>
          </a>

          <a href="#layanan" class="group block">
            <Card class="h-full transition-all duration-200 hover:border-primary/60 hover:shadow-md cursor-pointer">
              <CardHeader class="p-5 pb-3">
                <div class="flex items-center justify-between">
                  <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                    <Clock class="h-5 w-5" />
                  </div>
                  <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" />
                </div>
                <CardTitle class="text-base font-semibold pt-3">
                  Layanan Sirkulasi
                </CardTitle>
              </CardHeader>
              <CardContent class="p-5 pt-0 text-xs text-muted-foreground leading-normal">
                Informasi peminjaman, perpanjangan mandiri, serta pengembalian koleksi.
              </CardContent>
            </Card>
          </a>

          <a href="#panduan" class="group block">
            <Card class="h-full transition-all duration-200 hover:border-primary/60 hover:shadow-md cursor-pointer">
              <CardHeader class="p-5 pb-3">
                <div class="flex items-center justify-between">
                  <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary group-hover:bg-primary group-hover:text-primary-foreground transition-colors">
                    <GraduationCap class="h-5 w-5" />
                  </div>
                  <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all" />
                </div>
                <CardTitle class="text-base font-semibold pt-3">
                  Keanggotaan & Akun
                </CardTitle>
              </CardHeader>
              <CardContent class="p-5 pt-0 text-xs text-muted-foreground leading-normal">
                Panduan registrasi anggota baru, aktivasi kartu, dan hak akses katalog digital.
              </CardContent>
            </Card>
          </a>
        </div>
      </div>
    </section>

    <!-- Key Stats Section -->
    <section class="border-b bg-muted/30 py-8 sm:py-10">
      <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <div v-for="stat in stats" :key="stat.label" class="space-y-1">
            <p class="text-2xl sm:text-3xl font-extrabold text-foreground tracking-tight">
              {{ stat.value }}
            </p>
            <p class="text-xs sm:text-sm font-medium text-muted-foreground">
              {{ stat.label }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Books Section -->
    <section id="katalog" class="py-16 sm:py-20 border-b">
      <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Section Title & Filter Summary -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <div class="space-y-2 max-w-xl">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
              Koleksi Buku Pilihan
            </h2>
            <p class="text-sm text-muted-foreground">
              Koleksi literatur terpopuler dan referensi utama yang siap dibaca atau dipinjam.
            </p>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-xs text-muted-foreground">
              Menampilkan {{ filteredBooks.length }} dari {{ featuredBooks.length }} buku
            </span>
          </div>
        </div>

        <!-- Book Grid -->
        <div v-if="filteredBooks.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <Card
            v-for="book in filteredBooks"
            :key="book.id"
            class="flex flex-col justify-between transition-all duration-200 hover:border-primary/50 hover:shadow-md"
          >
            <CardHeader class="p-6 pb-4 space-y-3">
              <div class="flex items-center justify-between gap-2">
                <Badge variant="secondary" class="font-normal text-xs">
                  {{ book.category }}
                </Badge>
                <Badge
                  :variant="book.available ? 'default' : 'outline'"
                  :class="book.available ? 'bg-emerald-600 hover:bg-emerald-700 text-white' : 'text-muted-foreground'"
                >
                  <span class="h-1.5 w-1.5 rounded-full mr-1.5" :class="book.available ? 'bg-white' : 'bg-muted-foreground'"></span>
                  {{ book.available ? 'Tersedia' : 'Dipinjam' }}
                </Badge>
              </div>

              <div>
                <CardTitle class="text-lg font-bold text-foreground leading-snug line-clamp-2">
                  {{ book.title }}
                </CardTitle>
                <p class="text-sm text-muted-foreground mt-1">
                  Penulis: <span class="text-foreground font-medium">{{ book.author }}</span>
                </p>
              </div>
            </CardHeader>

            <CardContent class="p-6 pt-0 pb-4 space-y-2 text-xs text-muted-foreground">
              <div class="flex justify-between py-1 border-t">
                <span>Tahun Terbit:</span>
                <span class="font-medium text-foreground">{{ book.year }}</span>
              </div>
              <div class="flex justify-between py-1 border-t">
                <span>Nomor Panggil (Call No):</span>
                <span class="font-mono font-medium text-foreground">{{ book.callNumber }}</span>
              </div>
            </CardContent>

            <CardFooter class="p-6 pt-0 flex gap-2">
              <Button variant="outline" size="sm" class="w-full text-xs h-9">
                Lihat Detail
              </Button>
              <Button
                size="sm"
                class="w-full text-xs h-9"
                :disabled="!book.available"
              >
                {{ book.available ? 'Pinjam Buku' : 'Reservasi' }}
              </Button>
            </CardFooter>
          </Card>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-16 border rounded-xl bg-muted/20 space-y-3">
          <BookOpen class="h-10 w-10 text-muted-foreground mx-auto" />
          <h3 class="text-base font-semibold text-foreground">
            Tidak Ada Koleksi yang Sesuai
          </h3>
          <p class="text-xs text-muted-foreground max-w-sm mx-auto">
            Coba gunakan kata kunci lain atau pilih opsi 'Semua Koleksi' untuk melihat seluruh buku.
          </p>
          <Button variant="outline" size="sm" @click="searchQuery = ''; selectedCategory = 'all'" class="mt-2">
            Reset Filter
          </Button>
        </div>
      </div>
    </section>

    <!-- Categories Grid Section -->
    <section id="kategori" class="py-16 sm:py-20 border-b bg-muted/20">
      <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="text-center space-y-3 max-w-2xl mx-auto">
          <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
            Jelajahi Berdasarkan Kategori
          </h2>
          <p class="text-sm text-muted-foreground">
            Temukan koleksi referensi sesuai klasifikasi keilmuan yang Anda butuhkan.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <button
            v-for="cat in categories"
            :key="cat.id"
            @click="selectFilter(cat.name.split(' ')[0].toLowerCase());"
            class="flex items-center justify-between p-5 rounded-xl border bg-background hover:border-primary hover:shadow-sm transition-all text-left group cursor-pointer"
          >
            <div class="flex items-center gap-3.5">
              <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-muted text-muted-foreground group-hover:bg-primary/10 group-hover:text-primary transition-colors shrink-0">
                <Bookmark class="h-5 w-5" />
              </div>
              <div>
                <h3 class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors">
                  {{ cat.name }}
                </h3>
                <p class="text-xs text-muted-foreground">
                  {{ cat.count }}
                </p>
              </div>
            </div>
            <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-1 transition-all shrink-0" />
          </button>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-16 sm:py-20 border-b">
      <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="text-center space-y-3 max-w-2xl mx-auto">
          <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-foreground">
            Layanan & Fasilitas Perpustakaan
          </h2>
          <p class="text-sm text-muted-foreground">
            Dukungan fasilitas komprehensif untuk kenyamanan belajar, diskusi, dan penelitian.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <Card
            v-for="srv in services"
            :key="srv.title"
            class="p-6 transition-all hover:border-primary/40 hover:shadow-sm"
          >
            <div class="flex items-start gap-4">
              <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary shrink-0 mt-0.5">
                <CheckCircle2 class="h-5 w-5" />
              </div>
              <div class="space-y-1.5">
                <h3 class="text-base font-semibold text-foreground">
                  {{ srv.title }}
                </h3>
                <p class="text-sm text-muted-foreground leading-relaxed">
                  {{ srv.description }}
                </p>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </section>

    <!-- Call to Action Banner -->
    <section id="panduan" class="py-16 sm:py-20 bg-background">
      <div class="container mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl border bg-gradient-to-r from-primary/5 via-muted to-primary/5 p-8 sm:p-12 text-center space-y-6 shadow-sm">
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-primary text-primary-foreground shadow-sm mx-auto">
            <Users class="h-6 w-6" />
          </div>
          <div class="space-y-2 max-w-xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-foreground">
              Belum Menjadi Anggota Perpustakaan?
            </h2>
            <p class="text-sm sm:text-base text-muted-foreground leading-relaxed">
              Daftarkan diri Anda sekarang untuk menikmati akses peminjaman koleksi fisik, reservasi ruang baca, dan katalog literatur ilmiah lengkap.
            </p>
          </div>
          <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <Button size="lg" class="h-11 px-8 text-sm font-semibold w-full sm:w-auto">
              Registrasi Anggota Baru
            </Button>
            <Button variant="outline" size="lg" class="h-11 px-8 text-sm font-semibold w-full sm:w-auto">
              Pelajari Prosedur Peminjaman
            </Button>
          </div>
        </div>
      </div>
    </section>
  </AppLayout>
</template>
