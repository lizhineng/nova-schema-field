Nova.booting((Vue, router, store) => {
  Vue.component('detail-schema-field', require('./components/DetailField'))
  Vue.component('form-schema-field', require('./components/FormField'))

  Vue.component('schema-detail-text-field', require('./components/Detail/TextField'))
  Vue.component('schema-form-text-field', require('./components/Form/TextField'))

  Vue.component('schema-detail-select-field', require('./components/Detail/TextField'))
  Vue.component('schema-form-select-field', require('./components/Form/SelectField'))
})
