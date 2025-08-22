<script lang="ts" setup>
    import { Category } from '@/types/models';
    import { Head } from '@inertiajs/vue3';
    import AppLayout from '@/layouts/AppLayout.vue';
    import type { BreadcrumbItem } from '@/types';
    import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
    import { onMounted } from 'vue';

    const props = defineProps<{ categories: Category }>();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Categories',
            href: route('category.index').toString(),
        },
    ];
    onMounted(()=>{
        console.log(props.categories)
    })

</script>
<template>
    <Head title="Categories" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>

</template>
