<script setup>
import { Head } from '@inertiajs/vue3';
import { Card, CardHeader, CardTitle, CardDescription, CardContent, CardFooter } from '@/components/ui/card';
import { Button } from '@/components/ui/button';

defineProps({
  title: {
    type: String,
    default: 'Hello World',
  },
});
</script>

<template>
  <Head title="Welcome" />

  <div class="min-h-screen flex items-center justify-center p-6 bg-background">
    <Card class="w-full max-w-md shadow-lg border">
      <CardHeader class="space-y-1">
        <CardTitle class="text-2xl font-bold tracking-tight">
          {{ title }}
        </CardTitle>
        <CardDescription>
          Library Revamp application base setup
        </CardDescription>
      </CardHeader>
      <CardContent class="space-y-4 text-sm text-muted-foreground">
        <div class="rounded-md bg-muted p-4 space-y-2">
          <div class="flex justify-between font-mono text-xs">
            <span class="text-foreground font-medium">Framework:</span>
            <span>Laravel 13</span>
          </div>
          <div class="flex justify-between font-mono text-xs">
            <span class="text-foreground font-medium">Frontend:</span>
            <span>Inertia.js + Vue 3</span>
          </div>
          <div class="flex justify-between font-mono text-xs">
            <span class="text-foreground font-medium">UI Components:</span>
            <span>shadcn-vue</span>
          </div>
          <div class="flex justify-between font-mono text-xs">
            <span class="text-foreground font-medium">Runtime:</span>
            <span>FrankenPHP</span>
          </div>
        </div>
      </CardContent>
      <CardFooter class="flex justify-between">
        <Button variant="outline" size="sm">
          Documentation
        </Button>
        <Button size="sm">
          Get Started
        </Button>
      </CardFooter>
    </Card>
  </div>
</template>
