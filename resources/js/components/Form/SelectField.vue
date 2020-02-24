<template>
  <select
    class="w-full form-control form-select"
    v-bind:value="value"
    v-on:input="$emit('input', $event.target.value)"
  >
    <option
      v-for="option in field.options"
      :value="option.value"
      v-text="option.label"
    />
  </select>
</template>

<script>
export default {
  props: ['value', 'field']
}
</script>
