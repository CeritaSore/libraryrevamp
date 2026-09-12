<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  Library,
  Menu,
  X,
  Clock,
  MapPin,
  Phone,
  Mail,
  Search,
  BookOpen,
  Layers,
  HelpCircle,
} from 'lucide-vue-next';

const isMobileMenuOpen = ref(false);

const navLinks = [
  { name: 'Katalog Buku', href: '#katalog', icon: BookOpen },
  { name: 'Kategori', href: '#kategori', icon: Layers },
  { name: 'Layanan', href: '#layanan', icon: Clock },
  { name: 'Panduan', href: '#panduan', icon: HelpCircle },
];
</script>

<template>
  <div class="min-h-screen flex flex-col bg-background text-foreground selection:bg-primary selection:text-primary-foreground">
    <!-- Sticky Header -->
    <header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/80">
      <div class="container mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <Link href="/" class="flex items-center gap-2.5 group">
          <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-primary-foreground shadow-sm transition-transform group-hover:scale-105">
            <Library class="h-5 w-5" />
          </div>
          <div class="flex flex-col">
            <span class="text-base font-bold tracking-tight text-foreground leading-tight">
              LibraryRevamp
            </span>
            <span class="text-[11px] font-medium text-muted-foreground leading-none">
              Sistem Perpustakaan Modern
            </span>
          </div>
        </Link>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-1">
          <a
            v-for="item in navLinks"
            :key="item.name"
            :href="item.href"
            class="flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium rounded-lg text-muted-foreground hover:text-foreground hover:bg-muted/80 transition-colors"
          >
            <component :is="item.icon" class="h-4 w-4" />
            <span>{{ item.name }}</span>
          </a>
        </nav>

        <!-- Action Buttons (Desktop) -->
        <div class="hidden md:flex items-center gap-2.5">
          <a href="#katalog">
            <Button variant="ghost" size="sm" class="gap-1.5 text-muted-foreground hover:text-foreground">
              <Search class="h-4 w-4" />
              <span>Cari Buku</span>
            </Button>
          </a>
          <div class="h-4 w-px bg-border mx-0.5"></div>
          <Link href="/dashboard">
            <Button variant="outline" size="sm">
              Dashboard
            </Button>
          </Link>
          <Button size="sm">
            Daftar Anggota
          </Button>
        </div>

        <!-- Mobile Menu Trigger -->
        <div class="flex md:hidden items-center gap-2">
          <Button
            variant="ghost"
            size="icon"
            class="h-10 w-10"
            @click="isMobileMenuOpen = !isMobileMenuOpen"
            :aria-label="isMobileMenuOpen ? 'Tutup menu' : 'Buka menu'"
          >
            <X v-if="isMobileMenuOpen" class="h-5 w-5" />
            <Menu v-else class="h-5 w-5" />
          </Button>
        </div>
      </div>

      <!-- Mobile Navigation Drawer / Dropdown -->
      <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 -translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-2"
      >
        <div
          v-if="isMobileMenuOpen"
          class="md:hidden border-b bg-background px-4 py-5 shadow-lg space-y-4"
        >
          <nav class="flex flex-col space-y-1">
            <a
              v-for="item in navLinks"
              :key="item.name"
              :href="item.href"
              @click="isMobileMenuOpen = false"
              class="flex items-center gap-3 px-4 py-3 text-base font-medium rounded-lg text-foreground hover:bg-muted active:bg-muted/80 transition-colors"
            >
              <component :is="item.icon" class="h-5 w-5 text-muted-foreground" />
              <span>{{ item.name }}</span>
            </a>
          </nav>

          <div class="pt-3 border-t border-border flex flex-col gap-2.5">
            <Link href="/dashboard" @click="isMobileMenuOpen = false">
              <Button variant="outline" class="w-full h-11 text-base font-medium justify-center">
                Dashboard
              </Button>
            </Link>
            <Button class="w-full h-11 text-base font-medium justify-center">
              Daftar Anggota Baru
            </Button>
          </div>
        </div>
      </transition>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="border-t bg-muted/40 text-muted-foreground">
      <div class="container mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
          <!-- Brand & About -->
          <div class="space-y-3 md:col-span-1">
            <div class="flex items-center gap-2.5">
              <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-primary-foreground">
                <Library class="h-4 w-4" />
              </div>
              <span class="text-base font-bold text-foreground">
                LibraryRevamp
              </span>
            </div>
            <p class="text-sm leading-relaxed">
              Pusat referensi dan sumber belajar digital terintegrasi untuk mendukung kegiatan riset, literasi, dan pengembangan pengetahuan.
            </p>
          </div>

          <!-- Jam Operasional -->
          <div class="space-y-3">
            <h4 class="text-sm font-semibold text-foreground tracking-wide uppercase">
              Jam Layanan
            </h4>
            <ul class="space-y-2 text-sm">
              <li class="flex items-start gap-2">
                <Clock class="h-4 w-4 mt-0.5 text-primary shrink-0" />
                <div>
                  <p class="font-medium text-foreground">Senin - Jumat</p>
                  <p class="text-xs">08:00 - 17:00 WIB</p>
                </div>
              </li>
              <li class="flex items-start gap-2">
                <Clock class="h-4 w-4 mt-0.5 text-primary shrink-0" />
                <div>
                  <p class="font-medium text-foreground">Sabtu</p>
                  <p class="text-xs">09:00 - 14:00 WIB</p>
                </div>
              </li>
              <li class="text-xs text-muted-foreground pt-1">
                Minggu dan Libur Nasional: Tutup
              </li>
            </ul>
          </div>

          <!-- Navigasi Cepat -->
          <div class="space-y-3">
            <h4 class="text-sm font-semibold text-foreground tracking-wide uppercase">
              Navigasi Cepat
            </h4>
            <ul class="space-y-2 text-sm">
              <li>
                <a href="#katalog" class="hover:text-foreground transition-colors">
                  Pencarian Koleksi
                </a>
              </li>
              <li>
                <a href="#kategori" class="hover:text-foreground transition-colors">
                  Daftar Kategori
                </a>
              </li>
              <li>
                <a href="#layanan" class="hover:text-foreground transition-colors">
                  Ketentuan Peminjaman
                </a>
              </li>
              <li>
                <a href="#panduan" class="hover:text-foreground transition-colors">
                  Panduan Keanggotaan
                </a>
              </li>
            </ul>
          </div>

          <!-- Kontak & Alamat -->
          <div class="space-y-3">
            <h4 class="text-sm font-semibold text-foreground tracking-wide uppercase">
              Kontak & Lokasi
            </h4>
            <ul class="space-y-2.5 text-sm">
              <li class="flex items-start gap-2">
                <MapPin class="h-4 w-4 mt-0.5 text-primary shrink-0" />
                <span>Gedung Perpustakaan Pusat, Lantai 1-3</span>
              </li>
              <li class="flex items-center gap-2">
                <Phone class="h-4 w-4 text-primary shrink-0" />
                <span>(021) 555-0192</span>
              </li>
              <li class="flex items-center gap-2">
                <Mail class="h-4 w-4 text-primary shrink-0" />
                <span>layanan@libraryrevamp.local</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-10 border-t pt-6 text-center text-xs text-muted-foreground flex flex-col sm:flex-row items-center justify-between gap-4">
          <p>&copy; {{ new Date().getFullYear() }} LibraryRevamp. Seluruh hak cipta dilindungi undang-undang.</p>
          <div class="flex items-center gap-4">
            <a href="#" class="hover:text-foreground transition-colors">Kebijakan Privasi</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-foreground transition-colors">Syarat & Ketentuan</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
