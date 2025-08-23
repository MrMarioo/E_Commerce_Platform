<script lang="ts" setup>
import { CategoryProps } from '@/types/models';
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Button } from '@/components/ui/button';
import { Plus, Search, MoreHorizontal, Edit, Trash2, Eye } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

const props = defineProps<CategoryProps>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: route('category.index').toString(),
    },
];

const deleteCategory = (id: number) => {
    if (confirm('Are you sure you want to delete this category?')) {
        router.delete(route('category.destroy', id), {
            preserveScroll: true,
        });
    }
};
</script>
<template>
    <Head title="Categories" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6">
            <!--            Header Section-->
            <div class="m-2 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Categories</h1>
                    <p class="text-muted-foreground">Manage your product categories and organize your inventory</p>
                </div>
                <Button as-child>
                    <Link :href="route('category.create')">
                        <Plus class="mr-2 h-4 w-4" />
                        Add Category
                    </Link>
                </Button>
            </div>
            <!-- Stats Cards -->
            <div class="m-4 grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Total Categories</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ categories.meta.total }}</div>
                        <p class="text-xs text-muted-foreground">{{ categories.data.filter((c) => !c.parent_id).length }} parent categories</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Active Categories</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ categories.data.filter((c) => c.status === 'active').length }}
                        </div>
                        <p class="text-xs text-muted-foreground">Currently available</p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Subcategories</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ categories.data.filter((c) => c.parent_id).length }}
                        </div>
                        <p class="text-xs text-muted-foreground">Nested categories</p>
                    </CardContent>
                </Card>
            </div>
            <!--            List Section-->
            <Card class="m-4">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-800 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium">#</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-4 py-3 text-center text-sm font-medium">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium">Created At</th>
                            <th class="px-4 py-3 text-center text-sm font-medium">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="category in categories.data"
                            :key="category.id"
                            class="border-b hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                        >
                            <td class="px-4 py-3 text-sm">
                                <span class="font-mono text-xs">{{ category.id }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="font-medium">{{ category.name }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                    <span
                                        :class="{
                                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium': true,
                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': category.status === 'active',
                                            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': category.status === 'inactive'
                                        }"
                                    >
                                        {{ category.status }}
                                    </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                                {{ category.created_at}}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <div class="flex items-center justify-center gap-1">
                                    <Button size="sm" variant="ghost" as-child>
                                        <Link :href="route('category.show', category.id)" class="h-8 w-8 p-0">
                                            <Eye class="h-4 w-4" />
                                        </Link>
                                    </Button>
                                    <Button size="sm" variant="ghost" as-child>
                                        <Link :href="route('category.edit', category.id)" class="h-8 w-8 p-0">
                                            <Edit class="h-4 w-4" />
                                        </Link>
                                    </Button>
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        class="h-8 w-8 p-0 text-red-600 hover:text-red-700 dark:text-red-400"
                                        @click="deleteCategory(category.id)"
                                    >
                                        <Trash2 class="h-4 w-4" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Simple pagination -->
                <div
                    v-if="categories.links && categories.links.length > 0"
                    class="flex items-center justify-between px-4 py-3 border-t"
                >
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Showing {{ categories.data.length }} of {{ categories.meta.total }} categories
                    </div>

                    <div class="flex items-center space-x-1">
                        <template v-for="(link, index) in categories.links" :key="index">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                :class="{
                                    'px-3 py-2 text-sm rounded-md transition-colors': true,
                                    'bg-blue-600 text-white': link.active,
                                    'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-100 dark:hover:bg-gray-800': !link.active
                                }"
                                v-html="link.label"
                            />
                            <span
                                v-else
                                class="px-3 py-2 text-sm rounded-md text-gray-400 cursor-not-allowed opacity-50"
                                v-html="link.label"
                            />
                        </template>
                    </div>
                </div>
            </Card>
        </div>
    </AppLayout>
</template>
