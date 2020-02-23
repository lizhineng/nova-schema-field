<template>
  <select
    class="w-full form-control form-select"
    v-bind:value="value"
    v-on:input="$emit('input', $event.target.value)"
  >
    <option
      v-for="(value, label) in field.options"
      :value="value"
      v-text="label"
    />
  </select>
</template>

<script>
export default {
  props: ['value', 'field']
}
</script>
