<script lang="ts" setup>
import { computed } from 'vue';

interface Props {
    sticky?: boolean;
    variant?: 'default' | 'muted';
}

const props = withDefaults(defineProps<Props>(), {
    sticky: false,
    variant: 'default'
});

const classes = computed(() => [
    'border-b',
    {
        'bg-muted/50': props.variant === 'muted',
        'bg-background': props.variant === 'default',
        'sticky top-0 z-10': props.sticky
    }
]);
</script>

<template>
    <thead :class="classes">
    <slot />
    </thead>
</template>
