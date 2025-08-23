<!-- resources/js/components/ui/table/Td.vue -->
<script lang="ts" setup>
import { computed } from 'vue';

interface Props {
    label?: string;
    align?: 'left' | 'center' | 'right';
    truncate?: boolean;
    width?: string;
}

const props = withDefaults(defineProps<Props>(), {
    align: 'left',
    truncate: false
});

const classes = computed(() => [
    'px-4 py-3 text-sm',
    {
        'text-left': props.align === 'left',
        'text-center': props.align === 'center',
        'text-right': props.align === 'right',
        'truncate': props.truncate
    }
]);
</script>

<template>
    <td
        :class="classes"
        :style="{ width: width }"
        :data-label="label"
    >
        <slot />
    </td>
</template>
