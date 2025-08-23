<script lang="ts" setup>
import { ChevronUp, ChevronDown, ArrowUpDown } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Props {
    orderby?: string;
    sortable?: boolean;
    align?: 'left' | 'center' | 'right';
    width?: string;
}

const props = withDefaults(defineProps<Props>(), {
    sortable: true,
    align: 'left'
});

const route = computed(() => {
    if (typeof window === 'undefined') return {};
    const url = new URL(window.location.href);
    return {
        sort: url.searchParams.get('sort'),
        direction: url.searchParams.get('direction') || 'asc'
    };
});

const currentSort = computed(() => route.value.sort);
const currentDirection = computed(() => route.value.direction);

const isActive = computed(() => props.orderby && currentSort.value === props.orderby);
const nextDirection = computed(() => {
    if (!isActive.value) return 'asc';
    return currentDirection.value === 'asc' ? 'desc' : 'asc';
});

const handleSort = () => {
    if (!props.orderby || !props.sortable) return;

    const currentUrl = new URL(window.location.href);
    const params = new URLSearchParams(currentUrl.search);

    params.set('sort', props.orderby);
    params.set('direction', nextDirection.value);

    router.get(currentUrl.pathname + '?' + params.toString(), {}, {
        preserveState: true,
        preserveScroll: true
    });
};

const classes = computed(() => [
    'px-4 py-3 text-sm font-medium text-left',
    {
        'text-left': props.align === 'left',
        'text-center': props.align === 'center',
        'text-right': props.align === 'right',
        'cursor-pointer hover:bg-muted/50 transition-colors': props.sortable && props.orderby,
        'select-none': props.sortable && props.orderby
    }
]);

const iconComponent = computed(() => {
    if (!props.orderby || !props.sortable) return null;
    if (!isActive.value) return ArrowUpDown;
    return currentDirection.value === 'asc' ? ChevronUp : ChevronDown;
});
</script>

<template>
    <th
        :class="classes"
        :style="{ width: width }"
        @click="handleSort"
    >
        <div class="flex items-center gap-2">
            <span><slot /></span>
            <component
                :is="iconComponent"
                v-if="iconComponent"
                class="h-4 w-4 text-muted-foreground"
                :class="{ 'text-foreground': isActive }"
            />
        </div>
    </th>
</template>
