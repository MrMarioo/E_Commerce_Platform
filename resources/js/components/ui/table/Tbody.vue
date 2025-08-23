
<script lang="ts" setup>
interface Props {
    striped?: boolean;
    hoverable?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    striped: false,
    hoverable: true
});
</script>

<template>
    <tbody>
    <slot />
    </tbody>
</template>
