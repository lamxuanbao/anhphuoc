import Vue from 'vue'

import { VLazyImagePlugin } from 'v-lazy-image'

import VueCurrencyInput from 'vue-currency-input'

import Accordion from '@/components/core/accordion/index'
import AccordionGroup from '@/components/core/accordion/group'
import AccordionItem from '@/components/core/accordion/item'

Vue.use(VLazyImagePlugin)

const pluginOptions = {
  globalOptions: { currency: 'VND', locale: 'vi' }
}
Vue.use(VueCurrencyInput, pluginOptions);

[Accordion, AccordionGroup, AccordionItem].forEach((Component) => {
  Vue.component(Component.name, Component)
})


