<template>
  <default-field :field="field" :errors="errors" :full-width-content="true">
    <template slot="field">
      <table class="table w-full">
        <thead>
          <tr>
            <th
              class="text-left"
              v-for="field in field.fields"
              v-text="field.name"
            />
            <!-- Buttons -->
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, itemIndex) in field.data">
            <td class="text-left" v-for="field in item">
              <component
                :is="resolveComponentName(field)"
                v-model="field.value"
                :field="field"
              />
            </td>
            <td class="text-right">
              <button
                @click="removeRow(itemIndex)"
                type="button"
                tabindex="-1"
                class="inline-flex mr-3 appearance-none cursor-pointer text-70 hover:text-primary active:outline-none active:shadow-outline focus:outline-none focus:shadow-outline"
                title="Delete"
              >
                <icon />
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="mr-11">
        <button
          class="btn btn-link dim cursor-pointer rounded-lg mx-auto text-primary mt-3 px-3 rounded-b-lg flex items-center"
          type="button"
          @click="addRow"
        >
          <icon
            type="add"
            width="24"
            height="24"
            view-box="0 0 24 24"
          />
          <span class="ml-1">{{ field.actionText }}</span>
        </button>
      </div>
    </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  computed: {
    payload () {
      return _(this.field.data)
        .map(row => _(row).map(column => [column.attribute, column.value]).fromPairs().value())
        .value()
    }
  },

  methods: {
    /**
     * Fill the given FormData object with the field's internal value.
     */
     fill(formData) {
      formData.append(this.field.attribute, JSON.stringify(this.payload))
    },

    resolveComponentName (field) {
      return 'schema-form-' + field.component
    },

    removeRow (index) {
      return this.field.data.splice(index, 1)
    },

    newRow () {
       return JSON.parse(JSON.stringify(this.field.fields))
    },

    addRow () {
      this.field.data = [...this.field.data, this.newRow()]
    },
  },
}
</script>
