<template>
  <panel-item :field="field">
    <template slot="value">
      <table class="table w-full">
        <thead>
          <tr>
            <th
              class="text-left"
              v-for="field in field.fields"
              v-text="field.name"
            />
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in field.value">
            <td class="text-left" v-for="field in field.fields">
              <component
                :is="resolveComponentName(field)"
                v-model="item[field.attribute]"
                :field="field"
              />
            </td>
          </tr>
        </tbody>
      </table>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'resourceId', 'field'],

  methods: {
    resolveComponentName(field) {
      return 'schema-detail-' + field.component
    }
  }
}
</script>
