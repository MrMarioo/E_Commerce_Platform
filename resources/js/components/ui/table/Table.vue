<script lang="ts" setup>
interface PaginationLink {
    url?: string;
    label: string;
    active: boolean;
}

interface Props {
    links?: PaginationLink[] | string | any;
    total?: number;
    loading?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    links: () => [],
    total: 0,
    loading: false
});
</script>

<template>
    <div class="relative overflow-hidden">
        <!-- Loading overlay -->
        <div
            v-if="loading"
            class="absolute inset-0 bg-background/50 backdrop-blur-sm z-10 flex items-center justify-center"
        >
            <div class="animate-spin h-6 w-6 border-2 border-primary border-t-transparent rounded-full"></div>
        </div>

        <!-- Table container -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <slot />
            </table>
        </div>

        <!-- Pagination -->
        <div
            v-if="links && links.length > 0"
            class="flex items-center justify-between px-4 py-3 border-t bg-muted/20"
        >
            <div class="text-sm text-muted-foreground">
                <slot name="pagination-info">
                    Total: {{ total }} items
                </slot>
            </div>

            <div class="flex items-center space-x-1">
                <template v-for="(link, index) in links" :key="index">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        :class="{
              'px-3 py-2 text-sm rounded-md transition-colors': true,
              'bg-primary text-primary-foreground': link.active,
              'text-muted-foreground hover:text-foreground hover:bg-muted': !link.active
            }"
                        v-html="link.label"
                    />
                    <span
                        v-else
                        :class="{
              'px-3 py-2 text-sm rounded-md': true,
              'text-muted-foreground cursor-not-allowed opacity-50': true
            }"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>
    </div>
</template>
