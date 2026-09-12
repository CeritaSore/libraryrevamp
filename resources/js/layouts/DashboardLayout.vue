<script setup>
import { ref, computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import {
  Library,
  LayoutDashboard,
  BookOpen,
  ArrowLeftRight,
  Users,
  Menu,
  X,
  ArrowLeft,
} from 'lucide-vue-next';

const isMobileSidebarOpen = ref(false);
const page = usePage();

const navigation = [
  { name: 'Overview', href: '/dashboard', icon: LayoutDashboard },
  { name: 'Books', href: '/dashboard/books', icon: BookOpen },
  { name: 'Borrowed', href: '/dashboard/borrowed', icon: ArrowLeftRight },
  { name: 'Manage User', href: '/dashboard/manage-user', icon: Users },
];

const isActive = (href) => {
  if (href === '/dashboard') {
    return page.url === '/dashboard' || page.url === '/dashboard/';
  }
  return page.url.startsWith(href);
};

const currentTitle = computed(() => {
  const current = navigation.find((item) => isActive(item.href));
  return current ? current.name : 'Overview';
});
</script>

<template>
  <div class="min-h-screen flex bg-background text-foreground">
    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex w-64 flex-col border-r bg-muted/20 shrink-0 select-none">
      <!-- Sidebar Header / Brand -->
      <div class="h-16 flex items-center gap-2.5 px-6 border-b">
        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-primary-foreground shadow-sm">
          <Library class="h-5 w-5" />
        </div>
        <div class="flex flex-col">
          <span class="text-sm font-bold tracking-tight text-foreground leading-tight">
            LibraryRevamp
          </span>
          <span class="text-[11px] font-medium text-muted-foreground leading-none">
            Dashboard Panel
          </span>
        </div>
      </div>

      <!-- Navigation Menu -->
      <div class="flex-1 py-6 px-4 space-y-1">
        <p class="px-2 pb-2 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">
          Menu Utama
        </p>

        <!-- Navigation Links -->
        <Link
          v-for="item in navigation"
          :key="item.name"
          :href="item.href"
          :class="[
            'flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors cursor-pointer',
            isActive(item.href)
              ? 'bg-primary text-primary-foreground shadow-sm'
              : 'text-muted-foreground hover:text-foreground hover:bg-muted/80'
          ]"
        >
          <component :is="item.icon" class="h-4 w-4" />
          <span>{{ item.name }}</span>
        </Link>
      </div>

      <!-- Sidebar Footer -->
      <div class="p-4 border-t">
        <Link
          href="/"
          class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-muted-foreground hover:text-foreground hover:bg-muted/80 rounded-lg transition-colors"
        >
          <ArrowLeft class="h-3.5 w-3.5" />
          <span>Kembali ke Beranda</span>
        </Link>
      </div>
    </aside>

    <!-- Mobile Drawer Overlay -->
    <div
      v-if="isMobileSidebarOpen"
      class="fixed inset-0 z-50 bg-black/50 lg:hidden"
      @click="isMobileSidebarOpen = false"
    />

    <!-- Mobile Drawer Sidebar -->
    <aside
      :class="[
        'fixed inset-y-0 left-0 z-50 w-72 bg-background border-r shadow-xl flex flex-col transition-transform duration-200 lg:hidden',
        isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'
      ]"
    >
      <div class="h-16 flex items-center justify-between px-6 border-b">
        <div class="flex items-center gap-2.5">
          <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary text-primary-foreground shadow-sm">
            <Library class="h-5 w-5" />
          </div>
          <span class="text-sm font-bold tracking-tight text-foreground">
            LibraryRevamp
          </span>
        </div>
        <Button
          variant="ghost"
          size="icon"
          class="h-9 w-9"
          @click="isMobileSidebarOpen = false"
          aria-label="Tutup sidebar"
        >
          <X class="h-5 w-5" />
        </Button>
      </div>

      <div class="flex-1 py-6 px-4 space-y-1">
        <p class="px-2 pb-2 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">
          Menu Utama
        </p>

        <Link
          v-for="item in navigation"
          :key="item.name"
          :href="item.href"
          @click="isMobileSidebarOpen = false"
          :class="[
            'flex items-center gap-3 px-4 py-3 rounded-lg text-base font-medium transition-colors cursor-pointer',
            isActive(item.href)
              ? 'bg-primary text-primary-foreground shadow-sm'
              : 'text-muted-foreground hover:text-foreground hover:bg-muted/80'
          ]"
        >
          <component :is="item.icon" class="h-5 w-5" />
          <span>{{ item.name }}</span>
        </Link>
      </div>

      <div class="p-4 border-t">
        <Link
          href="/"
          @click="isMobileSidebarOpen = false"
          class="flex items-center gap-2 px-3 py-2.5 text-sm font-medium text-muted-foreground hover:text-foreground hover:bg-muted/80 rounded-lg transition-colors"
        >
          <ArrowLeft class="h-4 w-4" />
          <span>Kembali ke Beranda</span>
        </Link>
      </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
      <!-- Top Bar -->
      <header class="h-16 border-b bg-background/95 backdrop-blur flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
        <div class="flex items-center gap-3">
          <Button
            variant="ghost"
            size="icon"
            class="lg:hidden h-10 w-10"
            @click="isMobileSidebarOpen = true"
            aria-label="Buka sidebar"
          >
            <Menu class="h-5 w-5" />
          </Button>
          <div class="flex items-center gap-2 text-sm">
            <span class="text-muted-foreground">Dashboard</span>
            <span class="text-muted-foreground">/</span>
            <span class="font-medium text-foreground">{{ currentTitle }}</span>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <Link href="/">
            <Button variant="outline" size="sm" class="hidden sm:inline-flex gap-1.5 text-xs">
              <ArrowLeft class="h-3.5 w-3.5" />
              <span>Halaman Depan</span>
            </Button>
          </Link>
        </div>
      </header>

      <!-- Page Canvas Content -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>
