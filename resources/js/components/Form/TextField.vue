<template>
  <input
    class="w-full form-control form-input form-input-bordered"
    v-bind:value="value"
    v-on:input="$emit('input', $event.target.value)"
  />
</template>

<script>
export default {
  props: ['value', 'field']
}
</script>
